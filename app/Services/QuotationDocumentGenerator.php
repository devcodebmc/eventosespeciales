<?php

namespace App\Services;

use App\Models\Quotation;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory as WordIOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Illuminate\Support\Facades\Log;

class QuotationDocumentGenerator
{
    protected string $storagePath;
    protected string $tempPath;
    protected bool $hasLibreOffice;

    public function __construct()
    {
        $this->storagePath = storage_path('app/public/quotations');
        $this->tempPath    = storage_path('app/mpdf-temp');

        if (!is_dir($this->storagePath)) {
            mkdir($this->storagePath, 0755, true);
        }
        if (!is_dir($this->tempPath)) {
            mkdir($this->tempPath, 0755, true);
        }

        $this->hasLibreOffice = $this->checkLibreOffice();
    }

    protected function checkLibreOffice(): bool
    {
        $cmd = PHP_OS_FAMILY === 'Windows' ? 'where soffice' : 'which libreoffice';
        exec($cmd . ' 2>&1', $output, $code);
        return $code === 0;
    }

    public function generateAll(Quotation $quotation): Quotation
    {
        $img1 = public_path('images/cotizacion/header-1.png');
        $img2 = public_path('images/cotizacion/header-2.png');
        $img3 = public_path('images/cotizacion/header-3.png');

        $pdfRelative = $this->generatePdf($quotation, $img1, $img2, $img3);
        $quotation->pdf_path = $pdfRelative;

        $pdfAbsolute = storage_path("app/public/{$pdfRelative}");

        $quotation->word_path = $this->convertPdfToWord($pdfAbsolute, $quotation);
        $quotation->image_path = $this->convertPdfToImage($pdfAbsolute, $quotation->folio);
        $quotation->excel_path = $this->generateExcel($quotation);

        $quotation->save();

        return $quotation;
    }

    protected function generatePdf(Quotation $quotation, string $img1, string $img2, string $img3): string
    {
        $img1Data = $this->imageToBase64($img1);
        $img2Data = $this->imageToBase64($img2);
        $img3Data = $this->imageToBase64($img3);

        $html = view('quotations.master', [
            'quotation' => $quotation,
            'img1' => $img1Data,
            'img2' => $img2Data,
            'img3' => $img3Data,
        ])->render();

        $mpdf = new Mpdf([
            'mode'              => 'utf-8',
            'format'            => 'Letter',
            'margin_top'        => 0,     // ← SIN margen arriba para que el banner toque el borde
            'margin_bottom'     => 14,
            'margin_left'       => 0,     // ← SIN margen lateral
            'margin_right'      => 0,     // ← SIN margen lateral
            'margin_footer'     => 0,
            'default_font'      => 'dejavusans',
            'default_font_size' => 11,
            'tempDir'           => $this->tempPath,
        ]);

        $footerHtml = '
            <table width="100%" style="border-collapse:collapse; background-color:#7a6a4f; color:#ffffff; font-size:7.5pt; margin:0; padding:0;">
                <tr>
                    <td style="padding:5px 15px; text-align:left; width:30%; font-weight:normal;">729-373-88-30</td>
                    <td style="padding:5px 15px; text-align:center; width:40%; font-weight:normal;">Av. Circunvalación No. 15, Col. Agricola Analco, Lerma, Méx.</td>
                    <td style="padding:5px 15px; text-align:right; width:30%; font-weight:normal;">Página {PAGENO} de {nbpg}</td>
                </tr>
            </table>
        ';
        $mpdf->SetHTMLFooter($footerHtml);

        $mpdf->WriteHTML($html);

        $filename = "{$quotation->folio}.pdf";
        $path     = "{$this->storagePath}/{$filename}";
        $mpdf->Output($path, Destination::FILE);

        return "quotations/{$filename}";
    }

    protected function imageToBase64(string $path): string
    {
        if (!file_exists($path)) {
            return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=';
        }
        $mime = mime_content_type($path);
        $data = base64_encode(file_get_contents($path));
        return "data:{$mime};base64,{$data}";
    }

    protected function convertPdfToWord(string $pdfAbsolute, Quotation $quotation): string
    {
        if ($this->hasLibreOffice) {
            $outDir = $this->storagePath;
            $cmd = sprintf(
                'libreoffice --headless --convert-to docx --outdir %s %s 2>&1',
                escapeshellarg($outDir),
                escapeshellarg($pdfAbsolute)
            );
            exec($cmd, $output, $code);

            $expected = "{$outDir}/{$quotation->folio}.docx";
            if ($code === 0 && file_exists($expected)) {
                return "quotations/{$quotation->folio}.docx";
            }
            Log::warning('LibreOffice PDF→DOCX falló', ['output' => $output, 'code' => $code]);
        }
        return $this->generateWordFallback($quotation);
    }

    protected function convertPdfToImage(string $pdfAbsolute, string $folio): ?string
    {
        $pngPath = "{$this->storagePath}/{$folio}.png";

        $cmd = sprintf(
            'pdftoppm -png -r 150 -singlefile %s %s 2>&1',
            escapeshellarg($pdfAbsolute),
            escapeshellarg("{$this->storagePath}/{$folio}")
        );
        exec($cmd, $output, $code);
        if ($code === 0 && file_exists($pngPath)) {
            return "quotations/{$folio}.png";
        }

        $cmd = sprintf(
            'magick -density 150 %s -quality 90 %s 2>&1',
            escapeshellarg($pdfAbsolute),
            escapeshellarg($pngPath)
        );
        exec($cmd, $output, $code);
        if ($code === 0 && file_exists($pngPath)) {
            return "quotations/{$folio}.png";
        }

        Log::warning('No se pudo convertir PDF a imagen', ['output' => $output ?? []]);
        return null;
    }

    protected function generateWordFallback(Quotation $quotation): string
    {
        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Calibri');
        $phpWord->setDefaultFontSize(10);

        $section = $phpWord->addSection([
            'marginTop' => 600,
            'marginBottom' => 600,
            'marginLeft' => 900,
            'marginRight' => 900,
        ]);

        $section->addText(
            '"EVENTOS ESPECIALES LERMA"',
            ['bold' => true, 'size' => 20, 'color' => 'B8860B'],
            ['alignment' => 'center', 'spaceAfter' => 100]
        );

        $headerImages = array_filter([
            public_path('images/cotizacion/header-1.png'),
            public_path('images/cotizacion/header-2.png'),
            public_path('images/cotizacion/header-3.png'),
        ], 'file_exists');

        if (count($headerImages) > 0) {
            $imgTable = $section->addTable(['borderSize' => 0, 'cellMargin' => 0]);
            $imgTable->addRow(900);
            foreach ($headerImages as $img) {
                $cell = $imgTable->addCell(3000);
                $cell->addImage($img, ['width' => 90, 'height' => 60, 'alignment' => 'center']);
            }
        }

        $section->addTextBreak(1);

        $infoTable = $section->addTable(['borderSize' => 0, 'cellMargin' => 0]);
        $infoTable->addRow();
        $left = $infoTable->addCell(5000);
        $left->addText('COTIZACIÓN PARA:', ['size' => 8, 'color' => 'B8860B', 'bold' => true]);
        $left->addText($quotation->client_name, ['size' => 11, 'bold' => true, 'color' => '333333']);
        $left->addText('Fecha: ' . $quotation->quotation_date->format('d/m/Y'), ['size' => 9, 'color' => '666666']);

        $right = $infoTable->addCell(4000);
        $right->addText('ELABORÓ:', ['size' => 8, 'color' => 'B8860B', 'bold' => true], ['alignment' => 'right']);
        $right->addText('Eventos Especiales Lerma', ['size' => 11, 'bold' => true, 'color' => '333333'], ['alignment' => 'right']);
        $right->addText('Tel. 728-284-9074 · Cel. 729-373 88-30', ['size' => 8, 'color' => '666666'], ['alignment' => 'right']);
        $right->addText('Folio: ' . $quotation->folio, ['size' => 9, 'bold' => true, 'color' => '333333'], ['alignment' => 'right']);

        $section->addTextBreak(1);

        $section->addText(
            'C O T I Z A C I Ó N',
            ['bold' => true, 'size' => 16, 'color' => 'B8860B'],
            ['alignment' => 'center', 'spaceAfter' => 200]
        );

        $grupos = [];
        foreach ($quotation->items as $item) {
            $seccion = $item['seccion'] ?? 'SERVICIOS';
            $grupos[$seccion][] = $item;
        }

        foreach ($grupos as $seccion => $items) {
            $section->addText(
                strtoupper($seccion),
                ['bold' => true, 'size' => 10, 'color' => '8B6914'],
                ['spaceBefore' => 100, 'spaceAfter' => 60]
            );

            $table = $section->addTable([
                'borderSize' => 6,
                'borderColor' => 'E5DCC8',
                'cellMargin' => 60,
            ]);

            $hdrStyle = ['bgColor' => 'FAF8F3'];
            $hdrFont = ['bold' => true, 'size' => 8, 'color' => '8B6914'];
            $table->addRow(280, $hdrStyle);
            $table->addCell(5500, $hdrStyle)->addText('Descripción', $hdrFont);
            $table->addCell(1000, $hdrStyle)->addText('Cant.', $hdrFont, ['alignment' => 'center']);
            $table->addCell(1500, $hdrStyle)->addText('P. Unitario', $hdrFont, ['alignment' => 'right']);
            $table->addCell(1500, $hdrStyle)->addText('Total', $hdrFont, ['alignment' => 'right']);

            foreach ($items as $i => $item) {
                $rowStyle = $i % 2 === 1 ? ['bgColor' => 'FAFAFA'] : [];
                $table->addRow(260, $rowStyle);
                $table->addCell(5500)->addText($item['descripcion'], ['size' => 9]);
                $table->addCell(1000)->addText($item['cantidad'], ['size' => 9], ['alignment' => 'center']);
                $table->addCell(1500)->addText('$' . number_format($item['precio_unitario'], 2), ['size' => 9], ['alignment' => 'right']);
                $table->addCell(1500)->addText('$' . number_format($item['total'], 2), ['size' => 9], ['alignment' => 'right']);
            }
        }

        $section->addTextBreak(1);
        $totals = $section->addTable(['borderSize' => 0, 'cellMargin' => 0]);
        $totals->addRow();
        $totals->addCell(6500)->addText('');
        $tc = $totals->addCell(2000);
        $tc->addText('Subtotal: $' . number_format($quotation->subtotal, 2), ['size' => 10, 'color' => '666666'], ['alignment' => 'right']);
        $tc->addText('IVA (0%): $' . number_format($quotation->iva, 2), ['size' => 10, 'color' => '666666'], ['alignment' => 'right']);
        $tc->addText('TOTAL: $' . number_format($quotation->total, 2), ['bold' => true, 'size' => 12, 'color' => '8B6914'], ['alignment' => 'right']);

        $section->addTextBreak(2);
        $section->addText(
            'Gracias por su preferencia · Eventos Especiales Lerma · ' . now()->year,
            ['size' => 8, 'color' => '999999'],
            ['alignment' => 'center']
        );

        $filename = "{$quotation->folio}.docx";
        $path = "{$this->storagePath}/{$filename}";
        WordIOFactory::createWriter($phpWord, 'Word2007')->save($path);

        return "quotations/{$filename}";
    }

    protected function generateExcel(Quotation $quotation): string
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Cotización');

        $sheet->getColumnDimension('A')->setWidth(55);
        $sheet->getColumnDimension('B')->setWidth(8);
        $sheet->getColumnDimension('C')->setWidth(14);
        $sheet->getColumnDimension('D')->setWidth(14);

        $gold = 'B8860B';
        $lightGold = 'F5F0E6';
        $headerBg = 'FAF8F3';
        $darkGold = '8B6914';

        $sheet->mergeCells('A1:D1');
        $sheet->setCellValue('A1', '"EVENTOS ESPECIALES LERMA"');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(18)->getColor()->setARGB($gold);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getRowDimension(1)->setRowHeight(30);

        $sheet->setCellValue('A3', 'COTIZACIÓN PARA:');
        $sheet->getStyle('A3')->getFont()->setBold(true)->setSize(8)->getColor()->setARGB($gold);
        $sheet->setCellValue('A4', $quotation->client_name);
        $sheet->getStyle('A4')->getFont()->setBold(true)->setSize(11);
        $sheet->setCellValue('A5', 'Fecha: ' . $quotation->quotation_date->format('d/m/Y'));

        $sheet->setCellValue('C3', 'ELABORÓ:');
        $sheet->getStyle('C3')->getFont()->setBold(true)->setSize(8)->getColor()->setARGB($gold);
        $sheet->setCellValue('C4', 'Eventos Especiales Lerma');
        $sheet->getStyle('C4')->getFont()->setBold(true)->setSize(11);
        $sheet->setCellValue('C5', 'Tel. 728-284-9074');
        $sheet->setCellValue('C6', 'Folio: ' . $quotation->folio);
        $sheet->getStyle('C6')->getFont()->setBold(true);

        $sheet->mergeCells('A8:D8');
        $sheet->setCellValue('A8', 'C O T I Z A C I Ó N');
        $sheet->getStyle('A8')->getFont()->setBold(true)->setSize(14)->getColor()->setARGB($gold);
        $sheet->getStyle('A8')->getAlignment()->setHorizontal('center');
        $sheet->getRowDimension(8)->setRowHeight(25);

        $grupos = [];
        foreach ($quotation->items as $item) {
            $seccion = $item['seccion'] ?? 'SERVICIOS';
            $grupos[$seccion][] = $item;
        }

        $row = 10;
        foreach ($grupos as $seccion => $items) {
            $sheet->mergeCells("A{$row}:D{$row}");
            $sheet->setCellValue("A{$row}", strtoupper($seccion));
            $sheet->getStyle("A{$row}")->getFont()->setBold(true)->setSize(10)->getColor()->setARGB($darkGold);
            $sheet->getStyle("A{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($lightGold);
            $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal('left')->setIndent(1);
            $sheet->getStyle("A{$row}")->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THICK)->getColor()->setARGB($gold);
            $row++;

            $headers = ['Descripción', 'Cant.', 'P. Unitario', 'Total'];
            foreach (['A', 'B', 'C', 'D'] as $i => $col) {
                $cell = "{$col}{$row}";
                $sheet->setCellValue($cell, $headers[$i]);
                $sheet->getStyle($cell)->getFont()->setBold(true)->setSize(9)->getColor()->setARGB($darkGold);
                $sheet->getStyle($cell)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($headerBg);
                $sheet->getStyle($cell)->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('E5DCC8');
                $sheet->getStyle($cell)->getAlignment()->setHorizontal($i === 0 ? 'left' : ($i === 1 ? 'center' : 'right'));
            }
            $row++;

            foreach ($items as $i => $item) {
                $sheet->setCellValue("A{$row}", $item['descripcion']);
                $sheet->setCellValue("B{$row}", $item['cantidad']);
                $sheet->setCellValue("C{$row}", '$' . number_format($item['precio_unitario'], 2));
                $sheet->setCellValue("D{$row}", '$' . number_format($item['total'], 2));

                $sheet->getStyle("A{$row}:D{$row}")->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('F0F0F0');
                $sheet->getStyle("B{$row}")->getAlignment()->setHorizontal('center');
                $sheet->getStyle("C{$row}:D{$row}")->getAlignment()->setHorizontal('right');

                if ($i % 2 === 1) {
                    $sheet->getStyle("A{$row}:D{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FAFAFA');
                }
                $row++;
            }
            $row++;
        }

        $sheet->setCellValue("C{$row}", 'Subtotal:');
        $sheet->setCellValue("D{$row}", '$' . number_format($quotation->subtotal, 2));
        $sheet->getStyle("C{$row}:D{$row}")->getFont()->setSize(10)->getColor()->setARGB('666666');
        $sheet->getStyle("D{$row}")->getAlignment()->setHorizontal('right');
        $row++;

        $sheet->setCellValue("C{$row}", 'IVA (0%):');
        $sheet->setCellValue("D{$row}", '$' . number_format($quotation->iva, 2));
        $sheet->getStyle("C{$row}:D{$row}")->getFont()->setSize(10)->getColor()->setARGB('666666');
        $sheet->getStyle("D{$row}")->getAlignment()->setHorizontal('right');
        $row++;

        $sheet->setCellValue("C{$row}", 'TOTAL:');
        $sheet->setCellValue("D{$row}", '$' . number_format($quotation->total, 2));
        $sheet->getStyle("C{$row}:D{$row}")->getFont()->setBold(true)->setSize(12)->getColor()->setARGB($darkGold);
        $sheet->getStyle("C{$row}:D{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($lightGold);
        $sheet->getStyle("D{$row}")->getAlignment()->setHorizontal('right');
        $sheet->getStyle("C{$row}:D{$row}")->getBorders()->getTop()->setBorderStyle(Border::BORDER_THICK)->getColor()->setARGB($gold);
        $sheet->getStyle("C{$row}:D{$row}")->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THICK)->getColor()->setARGB($gold);
        $row += 2;

        $sheet->mergeCells("A{$row}:D{$row}");
        $sheet->setCellValue("A{$row}", 'Gracias por su preferencia · Eventos Especiales Lerma · ' . now()->year);
        $sheet->getStyle("A{$row}")->getFont()->setSize(8)->getColor()->setARGB('999999');
        $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal('center');

        $filename = "{$quotation->folio}.xlsx";
        $path = "{$this->storagePath}/{$filename}";
        (new Xlsx($spreadsheet))->save($path);

        return "quotations/{$filename}";
    }
}
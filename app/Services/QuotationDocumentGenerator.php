<?php

namespace App\Services;

use App\Models\Quotation;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\JcTable;
use PhpOffice\PhpWord\IOFactory as WordIOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use Illuminate\Support\Facades\Log;

class QuotationDocumentGenerator
{
    protected string $storagePath;
    protected string $tempPath;

    // Paleta compartida
    protected const GOLD        = 'b8956a';
    protected const DARK_BROWN  = '7a6a4f';
    protected const CREAM_BG    = 'faf6ee';
    protected const LIGHT_TABLE = 'f5f0e4';
    protected const BORDER_SOFT = 'e5dcc8';
    protected const BORDER_ROW  = 'f0ece2';
    protected const TEXT_DARK   = '2c2c2c';
    protected const TEXT_MUTED  = '888888';
    protected const TEXT_LABEL  = 'b8956a';

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
    }

    public function generateAll(Quotation $quotation): Quotation
    {
        $img1 = public_path('images/cotizacion/header-1.png');
        $img2 = public_path('images/cotizacion/header-2.png');
        $img3 = public_path('images/cotizacion/header-3.png');

        $pdfRelative = $this->generatePdf($quotation, $img1, $img2, $img3);
        $quotation->pdf_path = $pdfRelative;

        $quotation->word_path  = $this->generateWord($quotation, $img1, $img2, $img3);

        $pdfAbsolute = storage_path("app/public/{$pdfRelative}");
        $quotation->image_path = $this->convertPdfToImage($pdfAbsolute, $quotation->folio);

        $quotation->excel_path = $this->generateExcel($quotation, $img1, $img2, $img3);

        $quotation->save();

        return $quotation;
    }

    // PDF 
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
            'margin_top'        => 0,
            'margin_bottom'     => 14,
            'margin_left'       => 0,
            'margin_right'      => 0,
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

    // WORD 
    protected function generateWord(Quotation $quotation, string $img1, string $img2, string $img3): string
    {
        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('DejaVu Sans');
        $phpWord->setDefaultFontSize(10);

        $PAGE_W  = 12240;
        $PAGE_H  = 15840;
        $PAD_LAT = 200;
        $INNER_W = $PAGE_W - ($PAD_LAT * 2);

        // Columnas tabla items (50 / 8 / 20 / 22)
        $COL_DESC  = (int) round($INNER_W * 0.50);
        $COL_CANT  = (int) round($INNER_W * 0.08);
        $COL_PRICE = (int) round($INNER_W * 0.20);
        $COL_TOTAL = $INNER_W - $COL_DESC - $COL_CANT - $COL_PRICE;

        // Columnas banner (20 / 60 / 20)
        $BAN_L = (int) round($PAGE_W * 0.20);
        $BAN_C = (int) round($PAGE_W * 0.60);
        $BAN_R = $PAGE_W - $BAN_L - $BAN_C;

        $section = $phpWord->addSection([
            'pageSizeW'   => $PAGE_W,
            'pageSizeH'   => $PAGE_H,
            'marginTop'   => 0,
            'marginBottom' => 240,  
            'marginLeft'  => 0,
            'marginRight' => 0,
            'marginHeader' => 0,
            'marginFooter' => 60,   
        ]);

        // FOOTER — una sola fila, sin tabla, para que no empuje nada
        $footer = $section->addFooter();
        $footer->addText(
            '729-373-88-30                              Av. Circunvalación No. 15, Col. Agricola Analco, Lerma, Méx.                              eventosespecialeslerma.com',
            ['size' => 7, 'color' => 'FFFFFF', 'bgColor' => self::DARK_BROWN],
            ['alignment' => Jc::CENTER, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 1.0]
        );

        // BANNER — altura 1200 twips (≈80px), imágenes más chicas
        $bannerTable = $section->addTable([
            'borderSize' => 0,
            'cellMargin' => 0,
            'width'      => $PAGE_W,
            'unit'       => 'dxa',
        ]);
        $bannerTable->addRow(1300);   // ← 1300 twips ≈ 87px (banner compacto)

        // ---- Círculo izquierdo (150px→~85pt) ----
        $cellL = $bannerTable->addCell($BAN_L, [
            'valign' => 'center', 'bgColor' => self::CREAM_BG, 'borderSize' => 0, 'cellMargin' => 0,
        ]);
        if (file_exists($img1)) {
            $cellL->addImage($img1, ['width' => 85, 'height' => 85, 'alignment' => Jc::CENTER]);
        }

        // ---- Título + rectángulo central ----
        $cellC = $bannerTable->addCell($BAN_C, [
            'valign' => 'center', 'bgColor' => self::CREAM_BG, 'borderSize' => 0, 'cellMargin' => 0,
        ]);
        $cellC->addText(
            '"EVENTOS ESPECIALES LERMA"',
            ['name' => 'DejaVu Serif', 'size' => 15, 'color' => self::GOLD, 'spacing' => 40],
            ['alignment' => Jc::CENTER, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 1.0]
        );
        if (file_exists($img2)) {
            // 440x160 px → 330x120 pt, pero comprimido a ~240x85 pt
            $cellC->addImage($img2, ['width' => 240, 'height' => 85, 'alignment' => Jc::CENTER]);
        }

        // ---- Círculo derecho ----
        $cellR = $bannerTable->addCell($BAN_R, [
            'valign' => 'center', 'bgColor' => self::CREAM_BG, 'borderSize' => 0, 'cellMargin' => 0,
        ]);
        if (file_exists($img3)) {
            $cellR->addImage($img3, ['width' => 85, 'height' => 85, 'alignment' => Jc::CENTER]);
        }

        // CONTENEDOR PADDING (outer table, una sola celda)
        $outerTable = $section->addTable([
            'borderSize' => 0,
            'cellMargin' => $PAD_LAT,
            'width'      => $PAGE_W,
            'unit'       => 'dxa',
        ]);
        $outerTable->addRow();
        $outerCell = $outerTable->addCell($PAGE_W, ['borderSize' => 0, 'cellMargin' => $PAD_LAT]);

        // INFO BAR — TODO en una tabla compacta
        $infoTable = $outerCell->addTable([
            'borderSize' => 0,
            'cellMargin' => 0,
            'width'      => $INNER_W,
            'unit'       => 'dxa',
        ]);
        $colHalf = (int) ($INNER_W / 2);

        // Fila 1: label cliente + label elaboró
        $infoTable->addRow(180);
        $infoTable->addCell($colHalf, ['valign' => 'bottom', 'borderSize' => 0])
            ->addText('COTIZACIÓN PARA:', ['size' => 7, 'color' => self::TEXT_LABEL, 'allCaps' => true],
                ['spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);
        $infoTable->addCell($colHalf, ['valign' => 'bottom', 'borderSize' => 0])
            ->addText('ELABORÓ:', ['size' => 7, 'color' => self::TEXT_LABEL],
                ['alignment' => Jc::RIGHT, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);

        // Fila 2: valor cliente + valor elaboró
        $infoTable->addRow(280);
        $infoTable->addCell($colHalf, ['valign' => 'top', 'borderSize' => 0])
            ->addText($quotation->client_name, ['name' => 'DejaVu Serif', 'size' => 12, 'color' => self::TEXT_DARK],
                ['spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);
        $infoTable->addCell($colHalf, ['valign' => 'top', 'borderSize' => 0])
            ->addText('Eventos Especiales Lerma', ['name' => 'DejaVu Serif', 'size' => 12, 'color' => self::TEXT_DARK],
                ['alignment' => Jc::RIGHT, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);

        // Separador punteado (muy chico)
        $infoTable->addRow(60);
        $infoTable->addCell($INNER_W, ['borderSize' => 0, 'gridSpan' => 2])
            ->addText('', [], [
                'borderTopSize'  => 4, 'borderTopColor' => self::BORDER_SOFT, 'borderTopStyle' => 'dashed',
                'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.1,
            ]);

        // Fila 3: label folio + label fecha
        $infoTable->addRow(180);
        $infoTable->addCell($colHalf, ['valign' => 'bottom', 'borderSize' => 0])
            ->addText('FOLIO:', ['size' => 7, 'color' => self::TEXT_LABEL],
                ['spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);
        $infoTable->addCell($colHalf, ['valign' => 'bottom', 'borderSize' => 0])
            ->addText('FECHA:', ['size' => 7, 'color' => self::TEXT_LABEL],
                ['alignment' => Jc::RIGHT, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);

        // Fila 4: valor folio + valor fecha
        $infoTable->addRow(280);
        $infoTable->addCell($colHalf, ['valign' => 'top', 'borderSize' => 0])
            ->addText($quotation->folio, ['name' => 'DejaVu Serif', 'size' => 12, 'color' => self::TEXT_DARK],
                ['spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);
        $infoTable->addCell($colHalf, ['valign' => 'top', 'borderSize' => 0])
            ->addText($quotation->quotation_date->format('d/m/Y'), ['name' => 'DejaVu Serif', 'size' => 12, 'color' => self::TEXT_DARK],
                ['alignment' => Jc::RIGHT, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);

        // Separador punteado
        $infoTable->addRow(60);
        $infoTable->addCell($INNER_W, ['borderSize' => 0, 'gridSpan' => 2])
            ->addText('', [], [
                'borderTopSize'  => 4, 'borderTopColor' => self::BORDER_SOFT, 'borderTopStyle' => 'dashed',
                'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.1,
            ]);

        // Fila 5: contacto centrado
        $infoTable->addRow(200);
        $infoTable->addCell($INNER_W, ['borderSize' => 0, 'gridSpan' => 2])
            ->addText('Tel. 728-284-9074  ·  Cel. 729-373-88-30  ·  eventosespecialeslerma.com',
                ['size' => 8, 'color' => self::TEXT_MUTED],
                ['alignment' => Jc::CENTER, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);

        // TÍTULO "COTIZACIÓN" — SIN párrafos vacíos alrededor
        $outerCell->addText(
            'COTIZACIÓN',
            ['name' => 'DejaVu Serif', 'size' => 14, 'color' => self::GOLD, 'spacing' => 160],
            ['alignment' => Jc::CENTER, 'spaceAfter' => 120, 'spaceBefore' => 120, 'lineHeight' => 1.0]
        );

        // SECCIONES + ITEMS
        $grupos = [];
        foreach ($quotation->items as $item) {
            $seccion = strtoupper($item['seccion'] ?? 'SERVICIOS');
            $grupos[$seccion][] = $item;
        }

        foreach ($grupos as $seccion => $items) {

            // ---- Section header ----
            $shTable = $outerCell->addTable([
                'borderSize' => 0, 'cellMargin' => 100,
                'width' => $INNER_W, 'unit' => 'dxa',
            ]);
            $shTable->addRow(280);   // ← 280 twips ≈ 18px, compacto
            $shTable->addCell($INNER_W, ['bgColor' => self::DARK_BROWN, 'valign' => 'center', 'borderSize' => 0, 'cellMargin' => 100])
                ->addText($seccion, ['size' => 9, 'color' => 'FFFFFF', 'allCaps' => true, 'spacing' => 30],
                    ['spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);

            // ---- Tabla de items ----
            $itemsTable = $outerCell->addTable([
                'borderSize' => 0, 'cellMargin' => 0,
                'width' => $INNER_W, 'unit' => 'dxa',
            ]);

            // Encabezado
            $itemsTable->addRow(260, ['bgColor' => self::LIGHT_TABLE]);
            $itemsTable->addCell($COL_DESC, ['bgColor' => self::LIGHT_TABLE, 'valign' => 'center', 'borderSize' => 0, 'cellMargin' => 100])
                ->addText('DESCRIPCIÓN', ['size' => 8, 'color' => self::DARK_BROWN, 'allCaps' => true],
                    ['spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);
            $itemsTable->addCell($COL_CANT, ['bgColor' => self::LIGHT_TABLE, 'valign' => 'center', 'borderSize' => 0, 'cellMargin' => 100])
                ->addText('CANT.', ['size' => 8, 'color' => self::DARK_BROWN],
                    ['alignment' => Jc::CENTER, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);
            $itemsTable->addCell($COL_PRICE, ['bgColor' => self::LIGHT_TABLE, 'valign' => 'center', 'borderSize' => 0, 'cellMargin' => 100])
                ->addText('P. UNITARIO', ['size' => 8, 'color' => self::DARK_BROWN],
                    ['alignment' => Jc::RIGHT, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);
            $itemsTable->addCell($COL_TOTAL, ['bgColor' => self::LIGHT_TABLE, 'valign' => 'center', 'borderSize' => 0, 'cellMargin' => 100])
                ->addText('TOTAL', ['size' => 8, 'color' => self::DARK_BROWN],
                    ['alignment' => Jc::RIGHT, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);

            // Filas — 300 twips ≈ 20px (compacto)
            foreach ($items as $item) {
                $itemsTable->addRow(300);
                $itemsTable->addCell($COL_DESC, ['valign' => 'center', 'borderSize' => 0, 'cellMargin' => 100, 'borderBottomSize' => 4, 'borderBottomColor' => self::BORDER_ROW])
                    ->addText($item['descripcion'], ['size' => 9, 'color' => self::TEXT_DARK],
                        ['spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);
                $itemsTable->addCell($COL_CANT, ['valign' => 'center', 'borderSize' => 0, 'cellMargin' => 100, 'borderBottomSize' => 4, 'borderBottomColor' => self::BORDER_ROW])
                    ->addText((string) $item['cantidad'], ['size' => 9, 'color' => self::TEXT_DARK],
                        ['alignment' => Jc::CENTER, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);
                $itemsTable->addCell($COL_PRICE, ['valign' => 'center', 'borderSize' => 0, 'cellMargin' => 100, 'borderBottomSize' => 4, 'borderBottomColor' => self::BORDER_ROW])
                    ->addText('$' . number_format($item['precio_unitario'], 2), ['size' => 9, 'color' => self::TEXT_DARK],
                        ['alignment' => Jc::RIGHT, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);
                $itemsTable->addCell($COL_TOTAL, ['valign' => 'center', 'borderSize' => 0, 'cellMargin' => 100, 'borderBottomSize' => 4, 'borderBottomColor' => self::BORDER_ROW])
                    ->addText('$' . number_format($item['total'], 2), ['size' => 9, 'color' => self::TEXT_DARK],
                        ['alignment' => Jc::RIGHT, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);
            }
        }

        // NOTAS + TOTALES
        $outerCell->addText('', [], ['size' => 4, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.5]);

        $bottomTable = $outerCell->addTable([
            'borderSize' => 0, 'cellMargin' => 0,
            'width' => $INNER_W, 'unit' => 'dxa',
        ]);
        $bottomTable->addRow();

        // Notas (izq, 55%)
        $notesW = (int) round($INNER_W * 0.55);
        $notesCell = $bottomTable->addCell($notesW, ['valign' => 'top', 'borderSize' => 0, 'cellMargin' => 0]);
        $notesCell->addText('', [], [
            'borderTopSize' => 4, 'borderTopColor' => self::BORDER_ROW,
            'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.5,
        ]);
        $notas = [
            'La presente cotización tiene una vigencia de 30 días naturales a partir de la fecha de emisión.',
            'Los precios indicados en esta cotización no incluyen IVA.',
            'Para confirmar la reserva, se requiere un anticipo del 50% del total.',
            'El 50% restante deberá liquidarse previo al día del evento.',
            'El montaje y la logística se coordinarán una semana previa al evento.',
        ];
        foreach ($notas as $nota) {
            $notesCell->addText('• ' . $nota, ['size' => 8, 'color' => self::TEXT_MUTED],
                ['spaceAfter' => 10, 'spaceBefore' => 0, 'lineHeight' => 0.95]);
        }

        // Totales (der, 45%)
        $totalsW = $INNER_W - $notesW;
        $totalsCell = $bottomTable->addCell($totalsW, ['valign' => 'bottom', 'borderSize' => 0, 'cellMargin' => 0]);

        $totalsInner = $totalsCell->addTable([
            'borderSize' => 0, 'cellMargin' => 0,
            'width' => $totalsW, 'unit' => 'dxa',
        ]);
        $halfTotalsW = (int) ($totalsW / 2);

        // Subtotal
        $totalsInner->addRow(220);
        $totalsInner->addCell($halfTotalsW, ['valign' => 'center', 'borderSize' => 0, 'cellMargin' => 80])
            ->addText('Subtotal:', ['size' => 9, 'color' => self::TEXT_MUTED],
                ['alignment' => Jc::RIGHT, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);
        $totalsInner->addCell($halfTotalsW, ['valign' => 'center', 'borderSize' => 0, 'cellMargin' => 80])
            ->addText('$' . number_format($quotation->subtotal, 2), ['size' => 9, 'color' => self::TEXT_DARK],
                ['alignment' => Jc::RIGHT, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);

        // IVA
        $totalsInner->addRow(220);
        $totalsInner->addCell($halfTotalsW, ['valign' => 'center', 'borderSize' => 0, 'cellMargin' => 80])
            ->addText('IVA (0%):', ['size' => 9, 'color' => self::TEXT_MUTED],
                ['alignment' => Jc::RIGHT, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);
        $totalsInner->addCell($halfTotalsW, ['valign' => 'center', 'borderSize' => 0, 'cellMargin' => 80])
            ->addText('$' . number_format($quotation->iva, 2), ['size' => 9, 'color' => self::TEXT_DARK],
                ['alignment' => Jc::RIGHT, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);

        // TOTAL destacado
        $totalsInner->addRow(340, ['bgColor' => self::DARK_BROWN]);
        $totalsInner->addCell($halfTotalsW, ['bgColor' => self::DARK_BROWN, 'valign' => 'center', 'borderSize' => 0, 'cellMargin' => 80])
            ->addText('TOTAL:', ['size' => 11, 'color' => 'FFFFFF', 'spacing' => 20],
                ['alignment' => Jc::RIGHT, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);
        $totalsInner->addCell($halfTotalsW, ['bgColor' => self::DARK_BROWN, 'valign' => 'center', 'borderSize' => 0, 'cellMargin' => 80])
            ->addText('$' . number_format($quotation->total, 2), ['size' => 11, 'color' => 'FFFFFF'],
                ['alignment' => Jc::RIGHT, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]);

        // PIE
        $outerCell->addText('', [], ['size' => 4, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.5]);
        $outerCell->addText(
            'Gracias por su preferencia · Eventos Especiales Lerma · ' . now()->year,
            ['size' => 7, 'color' => '999999'],
            ['alignment' => Jc::CENTER, 'spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 0.9]
        );

        $filename = "{$quotation->folio}.docx";
        $path = "{$this->storagePath}/{$filename}";
        WordIOFactory::createWriter($phpWord, 'Word2007')->save($path);

        return "quotations/{$filename}";
    }

    // PDF → IMAGEN 
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

    // EXCEL — con imágenes del banner + footer
    protected function generateExcel(Quotation $quotation, string $img1 = '', string $img2 = '', string $img3 = ''): string
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Cotización');

        // === Anchos de columna (para imitar 50/8/20/22) ===
        $sheet->getColumnDimension('A')->setWidth(52);
        $sheet->getColumnDimension('B')->setWidth(10);
        $sheet->getColumnDimension('C')->setWidth(16);
        $sheet->getColumnDimension('D')->setWidth(16);

        // Paleta
        $gold       = self::GOLD;
        $darkBrown  = self::DARK_BROWN;
        $creamBg    = self::CREAM_BG;
        $lightTable = self::LIGHT_TABLE;
        $borderSoft = self::BORDER_SOFT;
        $borderRow  = self::BORDER_ROW;
        $textDark   = self::TEXT_DARK;
        $textMuted  = self::TEXT_MUTED;
        $textLabel  = self::TEXT_LABEL;

        // BANNER — 3 filas y NO 4.
        // Fila 1: título (altura 30)
        // Fila 2: imágenes (altura 90)
        // Fila 3: separación (altura 10)
        $sheet->mergeCells('A1:D1');
        $sheet->getStyle('A1')->getFill()
            ->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($creamBg);
        $sheet->setCellValue('A1', '"EVENTOS ESPECIALES LERMA"');
        $sheet->getStyle('A1')->getFont()
            ->setSize(18)->getColor()->setARGB($gold);
        $sheet->getStyle('A1')->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getRowDimension(1)->setRowHeight(30);

        // Fila 2: sólo para que floten las imágenes (fondo crema)
        $sheet->mergeCells('A2:D2');
        $sheet->getStyle('A2:D2')->getFill()
            ->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($creamBg);
        $sheet->getRowDimension(2)->setRowHeight(85);

        // Fila 3: separador visual
        $sheet->mergeCells('A3:D3');
        $sheet->getStyle('A3:D3')->getFill()
            ->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($creamBg);
        $sheet->getRowDimension(3)->setRowHeight(8);

        // ---- Imágenes flotantes del banner ----
        // header-1: círculo izq → sobre A2 con ancho Y alto exactos
        if ($img1 && file_exists($img1)) {
            $d1 = new Drawing();
            $d1->setName('header1');
            $d1->setPath($img1);
            $d1->setWidth(65);   // ← FIJO en px
            $d1->setHeight(65);  // ← FIJO en px (cuadrado)
            $d1->setCoordinates('A2');
            $d1->setOffsetX(25);
            $d1->setOffsetY(10);
            $d1->setWorksheet($sheet);
        }

        // header-2: rect centro → sobre B2-C2 con proporción correcta
        if ($img2 && file_exists($img2)) {
            $d2 = new Drawing();
            $d2->setName('header2');
            $d2->setPath($img2);
            $d2->setWidth(175);  // ← ancho razonable (no 330)
            $d2->setHeight(85);  // ← alto equivalente
            $d2->setCoordinates('B2');
            $d2->setOffsetX(20);
            $d2->setOffsetY(0);
            $d2->setWorksheet($sheet);
        }

        // header-3: círculo der → sobre D2
        if ($img3 && file_exists($img3)) {
            $d3 = new Drawing();
            $d3->setName('header3');
            $d3->setPath($img3);
            $d3->setWidth(65);
            $d3->setHeight(65);
            $d3->setCoordinates('D2');
            $d3->setOffsetX(15);
            $d3->setOffsetY(10);
            $d3->setWorksheet($sheet);
        }

        $row = 4;

        // INFO BAR (igual que antes)
        $sheet->setCellValue("A{$row}", 'COTIZACIÓN PARA:');
        $sheet->getStyle("A{$row}")->getFont()->setSize(8)->getColor()->setARGB($textLabel);
        $sheet->setCellValue("C{$row}", 'ELABORÓ:');
        $sheet->getStyle("C{$row}")->getFont()->setSize(8)->getColor()->setARGB($textLabel);
        $sheet->getStyle("C{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $row++;

        $sheet->mergeCells("A{$row}:B{$row}");
        $sheet->setCellValue("A{$row}", $quotation->client_name);
        $sheet->getStyle("A{$row}")->getFont()->setBold(true)->setSize(12)->getColor()->setARGB($textDark);
        $sheet->mergeCells("C{$row}:D{$row}");
        $sheet->setCellValue("C{$row}", 'Eventos Especiales Lerma');
        $sheet->getStyle("C{$row}")->getFont()->setBold(true)->setSize(12)->getColor()->setARGB($textDark);
        $sheet->getStyle("C{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $row++;

        $sheet->setCellValue("A{$row}", 'FOLIO:');
        $sheet->getStyle("A{$row}")->getFont()->setSize(8)->getColor()->setARGB($textLabel);
        $sheet->setCellValue("C{$row}", 'FECHA:');
        $sheet->getStyle("C{$row}")->getFont()->setSize(8)->getColor()->setARGB($textLabel);
        $sheet->getStyle("C{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $row++;

        $sheet->mergeCells("A{$row}:B{$row}");
        $sheet->setCellValue("A{$row}", $quotation->folio);
        $sheet->getStyle("A{$row}")->getFont()->setBold(true)->setSize(12)->getColor()->setARGB($textDark);
        $sheet->mergeCells("C{$row}:D{$row}");
        $sheet->setCellValue("C{$row}", $quotation->quotation_date->format('d/m/Y'));
        $sheet->getStyle("C{$row}")->getFont()->setBold(true)->setSize(12)->getColor()->setARGB($textDark);
        $sheet->getStyle("C{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $row++;

        $sheet->mergeCells("A{$row}:D{$row}");
        $sheet->setCellValue("A{$row}", 'Tel. 728-284-9074  ·  Cel. 729-373-88-30  ·  eventosespecialeslerma.com');
        $sheet->getStyle("A{$row}")->getFont()->setSize(9)->getColor()->setARGB($textMuted);
        $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $row += 2;

        // TÍTULO "COTIZACIÓN"
        $sheet->mergeCells("A{$row}:D{$row}");
        $sheet->setCellValue("A{$row}", 'C O T I Z A C I Ó N');
        $sheet->getStyle("A{$row}")->getFont()->setSize(16)->getColor()->setARGB($gold);
        $sheet->getStyle("A{$row}")->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getRowDimension($row)->setRowHeight(26);
        $row += 2;

        // SECCIONES + ITEMS
        $grupos = [];
        foreach ($quotation->items as $item) {
            $seccion = strtoupper($item['seccion'] ?? 'SERVICIOS');
            $grupos[$seccion][] = $item;
        }

        foreach ($grupos as $seccion => $items) {
            // Section header
            $sheet->mergeCells("A{$row}:D{$row}");
            $sheet->setCellValue("A{$row}", $seccion);
            $sheet->getStyle("A{$row}")->getFont()->setSize(10)->getColor()->setARGB('FFFFFF');
            $sheet->getStyle("A{$row}")->getFill()
                ->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($darkBrown);
            $sheet->getStyle("A{$row}")->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT)
                ->setVertical(Alignment::VERTICAL_CENTER)
                ->setIndent(1);
            $sheet->getRowDimension($row)->setRowHeight(22);
            $row++;

            // Encabezado tabla
            $headers = ['DESCRIPCIÓN', 'CANT.', 'P. UNITARIO', 'TOTAL'];
            foreach (['A', 'B', 'C', 'D'] as $i => $col) {
                $cell = "{$col}{$row}";
                $sheet->setCellValue($cell, $headers[$i]);
                $sheet->getStyle($cell)->getFont()->setSize(9)->getColor()->setARGB($darkBrown);
                $sheet->getStyle($cell)->getFill()
                    ->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($lightTable);
                $sheet->getStyle($cell)->getBorders()->getBottom()
                    ->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB($borderSoft);
                $sheet->getStyle($cell)->getAlignment()
                    ->setHorizontal($i === 0 ? Alignment::HORIZONTAL_LEFT : ($i === 1 ? Alignment::HORIZONTAL_CENTER : Alignment::HORIZONTAL_RIGHT))
                    ->setVertical(Alignment::VERTICAL_CENTER);
            }
            $sheet->getRowDimension($row)->setRowHeight(20);
            $row++;

            foreach ($items as $item) {
                $sheet->setCellValue("A{$row}", $item['descripcion']);
                $sheet->getStyle("A{$row}")->getFont()->setSize(10)->getColor()->setARGB($textDark);
                $sheet->getStyle("A{$row}")->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_LEFT)
                    ->setVertical(Alignment::VERTICAL_CENTER)
                    ->setWrapText(true);

                $sheet->setCellValue("B{$row}", (string) $item['cantidad']);
                $sheet->getStyle("B{$row}")->getFont()->setSize(10)->getColor()->setARGB($textDark);
                $sheet->getStyle("B{$row}")->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

                $sheet->setCellValue("C{$row}", '$' . number_format($item['precio_unitario'], 2));
                $sheet->getStyle("C{$row}")->getFont()->setSize(10)->getColor()->setARGB($textDark);
                $sheet->getStyle("C{$row}")->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

                $sheet->setCellValue("D{$row}", '$' . number_format($item['total'], 2));
                $sheet->getStyle("D{$row}")->getFont()->setSize(10)->getColor()->setARGB($textDark);
                $sheet->getStyle("D{$row}")->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

                $sheet->getStyle("A{$row}:D{$row}")->getBorders()->getBottom()
                    ->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB($borderRow);

                $sheet->getRowDimension($row)->setRowHeight(24);
                $row++;
            }

            $row++;
        }

        // NOTAS + TOTALES
        $notasRowStart = $row;
        $notas = [
            'La presente cotización tiene una vigencia de 30 días naturales a partir de la fecha de emisión.',
            'Los precios indicados en esta cotización no incluyen IVA.',
            'Para confirmar la reserva, se requiere un anticipo del 50% del total.',
            'El 50% restante deberá liquidarse previo al día del evento.',
            'El montaje y la logística se coordinarán una semana previa al evento.',
        ];
        foreach ($notas as $nota) {
            $sheet->mergeCells("A{$row}:B{$row}");
            $sheet->setCellValue("A{$row}", '• ' . $nota);
            $sheet->getStyle("A{$row}")->getFont()->setSize(9)->getColor()->setARGB($textMuted);
            $sheet->getStyle("A{$row}")->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT)
                ->setVertical(Alignment::VERTICAL_TOP)
                ->setWrapText(true);
            $sheet->getRowDimension($row)->setRowHeight(18);
            $row++;
        }

        $totalRow = $notasRowStart;
        $sheet->setCellValue("C{$totalRow}", 'Subtotal:');
        $sheet->getStyle("C{$totalRow}")->getFont()->setSize(10)->getColor()->setARGB($textMuted);
        $sheet->getStyle("C{$totalRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->setCellValue("D{$totalRow}", '$' . number_format($quotation->subtotal, 2));
        $sheet->getStyle("D{$totalRow}")->getFont()->setSize(10)->getColor()->setARGB($textDark);
        $sheet->getStyle("D{$totalRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $totalRow++;

        $sheet->setCellValue("C{$totalRow}", 'IVA (0%):');
        $sheet->getStyle("C{$totalRow}")->getFont()->setSize(10)->getColor()->setARGB($textMuted);
        $sheet->getStyle("C{$totalRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->setCellValue("D{$totalRow}", '$' . number_format($quotation->iva, 2));
        $sheet->getStyle("D{$totalRow}")->getFont()->setSize(10)->getColor()->setARGB($textDark);
        $sheet->getStyle("D{$totalRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $totalRow++;

        // TOTAL destacado
        $sheet->setCellValue("C{$totalRow}", 'TOTAL:');
        $sheet->getStyle("C{$totalRow}")->getFont()->setSize(13)->getColor()->setARGB('FFFFFF');
        $sheet->getStyle("C{$totalRow}")->getFill()
            ->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($darkBrown);
        $sheet->getStyle("C{$totalRow}")->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->setCellValue("D{$totalRow}", '$' . number_format($quotation->total, 2));
        $sheet->getStyle("D{$totalRow}")->getFont()->setSize(13)->getColor()->setARGB('FFFFFF');
        $sheet->getStyle("D{$totalRow}")->getFill()
            ->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($darkBrown);
        $sheet->getStyle("D{$totalRow}")->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getRowDimension($totalRow)->setRowHeight(24);

        $row = max($row, $totalRow) + 2;

        // Pie "gracias"
        $sheet->mergeCells("A{$row}:D{$row}");
        $sheet->setCellValue("A{$row}", 'Gracias por su preferencia · Eventos Especiales Lerma · ' . now()->year);
        $sheet->getStyle("A{$row}")->getFont()->setSize(8)->getColor()->setARGB('999999');
        $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $row++;

        // ---- Fila visual footer (barra café con datos) ----
        $sheet->mergeCells("A{$row}:D{$row}");
        $sheet->setCellValue("A{$row}", '729-373-88-30        ·        Av. Circunvalación No. 15, Col. Agricola Analco, Lerma, Méx.        ·        eventosespecialeslerma.com');
        $sheet->getStyle("A{$row}")->getFont()->setSize(8)->getColor()->setARGB('FFFFFF');
        $sheet->getStyle("A{$row}")->getFill()
            ->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($darkBrown);
        $sheet->getStyle("A{$row}")->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getRowDimension($row)->setRowHeight(20);

        // CONFIGURACIÓN DE IMPRESIÓN
        $sheet->setShowGridlines(false);
        $sheet->getPageSetup()
            ->setOrientation(PageSetup::ORIENTATION_PORTRAIT)
            ->setPaperSize(PageSetup::PAPERSIZE_LETTER)
            ->setFitToWidth(1)
            ->setFitToHeight(0)
            ->setHorizontalCentered(true);

        $sheet->getPageMargins()
            ->setTop(0.3)->setBottom(0.4)
            ->setLeft(0.4)->setRight(0.4)
            ->setHeader(0.2)->setFooter(0.2);

        // Footer nativo 
        $sheet->getHeaderFooter()->setOddFooter(
            '&L&8&K595959729-373-88-30' .
            '&C&8&K595959Av. Circunvalación No. 15, Col. Agricola Analco, Lerma, Méx.' .
            '&R&8&K595959Página &P de &N'
        );

        $filename = "{$quotation->folio}.xlsx";
        $path = "{$this->storagePath}/{$filename}";
        (new Xlsx($spreadsheet))->save($path);

        return "quotations/{$filename}";
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Services\QuotationAiExtractor;
use App\Services\QuotationDocumentGenerator;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    /**
     * Lista todas las cotizaciones.
     */
    public function index()
    {
        $quotations = Quotation::orderByDesc('created_at')->paginate(10);
        return view('quotations.index', compact('quotations'));
    }

    /**
     * Crea una nueva cotización a partir del texto pegado por el usuario.
     */
    public function store(Request $request, QuotationAiExtractor $extractor, QuotationDocumentGenerator $generator)
    {
        $request->validate([
            'raw_input' => 'required|string|min:10',
            'client_name' => 'nullable|string|max:255',
        ]);

        try {
            $data = $extractor->extract($request->input('raw_input'));
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        $subtotal = collect($data['items'])->sum('total');
        $total = $data['total'] ?? $subtotal;

        $quotation = Quotation::create([
            'folio' => Quotation::generateFolio(),
            'client_name' => $request->input('client_name') ?: 'A quien corresponda',
            'quotation_date' => now()->toDateString(),
            'items' => $data['items'],
            'subtotal' => $subtotal,
            'iva' => 0,
            'total' => $total,
            'raw_input' => $request->input('raw_input'),
        ]);

        try {
            $generator->generateAll($quotation);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al generar documentos: ' . $e->getMessage(),
            ], 500);
        }

        // Recargar el historial paginado para devolverlo al frontend
        $quotations = Quotation::orderByDesc('created_at')->paginate(10);
        $history = view('quotations._history', compact('quotations'))->render();

        return response()->json([
            'quotation' => [
                'folio' => $quotation->folio,
                'client_name' => $quotation->client_name,
                'total' => $quotation->total,
            ],
            'history' => $history,
        ]);
    }

    /**
     * Regenera los documentos SIEMPRE y descarga el archivo solicitado.
     * Los 3 formatos (PDF, Word, Excel) se descargan directamente.
     */
    public function download(Quotation $quotation, string $format, QuotationDocumentGenerator $generator)
    {
        $allowed = ['pdf', 'word', 'excel'];
        if (!in_array($format, $allowed, true)) {
            return response()->json(['message' => 'Formato no válido'], 400);
        }

        try {
            $generator->generateAll($quotation);
            $quotation->refresh();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al generar el documento: ' . $e->getMessage(),
            ], 500);
        }

        $pathColumn = "{$format}_path";
        $relativePath = $quotation->$pathColumn;

        if (!$relativePath) {
            return response()->json([
                'message' => 'Ruta del archivo no definida en la base de datos',
            ], 500);
        }

        $absolutePath = storage_path("app/public/{$relativePath}");

        if (!file_exists($absolutePath) || !is_readable($absolutePath)) {
            return response()->json([
                'message' => 'El archivo no existe o no es legible',
            ], 500);
        }

        $filename = basename($absolutePath);

        // Tipos MIME por formato
        $mimeTypes = [
            'pdf'   => 'application/pdf',
            'word'  => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'excel' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];

        return response()->download($absolutePath, $filename, [
            'Content-Type' => $mimeTypes[$format] ?? 'application/octet-stream',
        ]);
    }

    /**
     * Elimina una cotización.
     */
    public function destroy(Quotation $quotation)
    {
        $quotation->delete();

        return redirect()->route('quotations.index')
            ->with('success', 'Cotización eliminada.');
    }
}
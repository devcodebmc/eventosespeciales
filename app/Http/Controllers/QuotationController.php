<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Services\QuotationAiExtractor;
use App\Services\QuotationDocumentGenerator;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    /**
     * Cuántas cotizaciones se muestran por tanda en el historial.
     */
    private const PER_PAGE = 9;

    /**
     * Lista la vista principal con la primera tanda de cotizaciones.
     */
    public function index()
    {
        $quotations = Quotation::orderByDesc('created_at')
            ->take(self::PER_PAGE)
            ->get();

        $hasMore = Quotation::count() > self::PER_PAGE;

        return view('quotations.index', [
            'quotations' => $quotations,
            'hasMore' => $hasMore,
            'nextOffset' => self::PER_PAGE,
        ]);
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

        // Recargamos solo la primera tanda del historial (no todo el listado)
        $quotations = Quotation::orderByDesc('created_at')
            ->take(self::PER_PAGE)
            ->get();

        $hasMore = Quotation::count() > self::PER_PAGE;

        $history = view('quotations._history', [
            'quotations' => $quotations,
            'hasMore' => $hasMore,
            'nextOffset' => self::PER_PAGE,
        ])->render();

        return response()->json([
            'quotation' => [
                'id' => $quotation->id,
                'folio' => $quotation->folio,
                'client_name' => $quotation->client_name,
                'total' => $quotation->total,
            ],
            'history' => $history,
        ]);
    }

    /**
     * Devuelve la siguiente tanda de cotizaciones para el botón "Cargar más".
     * Responde solo con las tarjetas nuevas (no el contenedor completo) para
     * que el JS pueda insertarlas sin reconstruir el grid existente.
     */
    public function loadMore(Request $request)
    {
        $request->validate([
            'offset' => 'required|integer|min:0',
        ]);

        $offset = (int) $request->input('offset');

        $quotations = Quotation::orderByDesc('created_at')
            ->skip($offset)
            ->take(self::PER_PAGE)
            ->get();

        $hasMore = Quotation::count() > ($offset + self::PER_PAGE);

        $html = view('quotations._quotation_cards', compact('quotations'))->render();

        return response()->json([
            'html' => $html,
            'hasMore' => $hasMore,
            'nextOffset' => $offset + self::PER_PAGE,
            'count' => $quotations->count(),
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
            return response()->json(['message' => 'Error al generar: ' . $e->getMessage()], 500);
        }

        $pathColumn = "{$format}_path";
        $relativePath = $quotation->$pathColumn;

        if (!$relativePath) {
            return response()->json(['message' => 'Ruta no definida'], 500);
        }

        $absolutePath = storage_path("app/public/{$relativePath}");

        if (!file_exists($absolutePath) || !is_readable($absolutePath)) {
            return response()->json(['message' => 'Archivo no legible'], 500);
        }

        return response()->download($absolutePath, basename($absolutePath), [
            'Content-Type' => $format === 'pdf'
                ? 'application/pdf'
                : ($format === 'word'
                    ? 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                    : 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'),
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
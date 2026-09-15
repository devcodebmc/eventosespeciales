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
        $total = $subtotal;

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
     * Devuelve los datos de la cotización para el modal de edición.
     */
    public function edit(Quotation $quotation)
    {
        return response()->json([
            'id'             => $quotation->id,
            'folio'          => $quotation->folio,
            'client_name'    => $quotation->client_name,
            'quotation_date' => $quotation->quotation_date->format('Y-m-d'),
            'items'          => $quotation->items,
            'subtotal'       => $quotation->subtotal,
            'total'          => $quotation->total,
        ]);
    }

    /**
     * Actualiza la cotización y regenera los documentos.
     */
    public function update(Request $request, Quotation $quotation, QuotationDocumentGenerator $generator)
    {
        $request->validate([
            'client_name'        => 'required|string|max:255',
            'quotation_date'     => 'required|date',
            'items'              => 'required|array|min:1',
            'items.*.seccion'    => 'required|string',
            'items.*.descripcion'=> 'required|string',
            'items.*.cantidad'   => 'required|numeric|min:0',
            'items.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        $items = collect($request->items)->map(function ($item) {
            $cantidad = (float) $item['cantidad'];
            $precio   = (float) $item['precio_unitario'];
            return [
                'seccion'         => strtoupper(trim($item['seccion'])),
                'descripcion'     => trim($item['descripcion']),
                'cantidad'        => $cantidad,
                'precio_unitario' => $precio,
                'total'           => $cantidad * $precio,
            ];
        })->values()->all();

        $subtotal = collect($items)->sum('total');

        $quotation->update([
            'client_name'    => $request->client_name,
            'quotation_date' => $request->quotation_date,
            'items'          => $items,
            'subtotal'       => $subtotal,
            'iva'            => 0,
            'total'          => $subtotal,
        ]);

        try {
            $generator->generateAll($quotation->fresh());
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al regenerar documentos: ' . $e->getMessage()], 500);
        }

        // HTML actualizado del historial
        $quotations = Quotation::orderByDesc('created_at')->take(self::PER_PAGE)->get();
        $hasMore    = Quotation::count() > self::PER_PAGE;

        $history = view('quotations._history', [
            'quotations'  => $quotations,
            'hasMore'     => $hasMore,
            'nextOffset'  => self::PER_PAGE,
        ])->render();

        return response()->json([
            'message' => 'Cotización actualizada.',
            'history' => $history,
        ]);
    }

    /**
     * Elimina una cotización.
     */
    public function destroy(Quotation $quotation)
    {
        $quotation->deleteFiles();
        $quotation->delete();

        return response()->json(['message' => 'Cotización eliminada.']);
    }
}
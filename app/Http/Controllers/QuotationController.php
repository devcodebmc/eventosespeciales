<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Services\QuotationAiExtractor;
use App\Services\QuotationDocumentGenerator;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::orderByDesc('created_at')->paginate(10);
        return view('quotations.index', compact('quotations'));
    }

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
     * Regenera los documentos SIEMPRE y devuelve el archivo solicitado.
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
        $filePath = $quotation->$pathColumn;

        if (!$filePath || !file_exists(storage_path("app/public/{$filePath}"))) {
            return response()->json(['message' => 'El archivo no pudo generarse'], 500);
        }

        return response()->download(
            storage_path("app/public/{$filePath}"),
            basename($filePath)
        );
    }

    public function destroy(Quotation $quotation)
    {
        $quotation->delete();
        return redirect()->route('quotations.index')
            ->with('success', 'Cotización eliminada.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Services\QuotationAiExtractor;
use App\Services\QuotationDocumentGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            return response()->json(['message' => 'Error al generar documentos: ' . $e->getMessage()], 500);
        }

        // Recargar historial paginado
        $quotations = Quotation::orderByDesc('created_at')->paginate(10);
        $history = view('quotations._history', compact('quotations'))->render();

        $stats = [
            'total' => Quotation::count(),
            'month' => '$' . number_format(
                Quotation::where('created_at', '>=', now()->startOfMonth())->sum('total'),
                0
            ),
        ];

        return response()->json([
            'quotation' => [
                'folio' => $quotation->folio,
                'client_name' => $quotation->client_name,
                'total' => $quotation->total,
            ],
            'history' => $history,
            'stats' => $stats,
        ]);
    }
}
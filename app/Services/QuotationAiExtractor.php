<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class QuotationAiExtractor
{
    /**
     * Extrae ítems y precios de un texto desordenado usando Gemini.
     *
     * @param string $rawText
     * @return array{items: array, total: float|null}
     * @throws \Exception
     */
    public function extract(string $rawText): array
    {
        $apiKey = config('services.gemini.key');

        $prompt = <<<PROMPT
        Eres un asistente que extrae información de cotizaciones de eventos.
        El usuario te dará un texto desordenado con descripciones de servicios y sus precios.
        Debes devolver ÚNICAMENTE un JSON con esta estructura:

        {
        "items": [
            {
            "seccion": "PISOS Y TARIMAS",
            "descripcion": "texto limpio del servicio",
            "cantidad": 1,
            "precio_unitario": 10080
            }
        ],
        "total": 24880
        }

        Reglas:
        - "seccion" debe ser un título corto en mayúsculas que agrupe los ítems relacionados. 
        Ejemplos: "PISOS Y TARIMAS", "MOBILIARIO", "FLETE", "DECORACIÓN", "VAJILLA".
        - Si no puedes inferir una sección, usa "SERVICIOS".
        - Si un ítem no tiene cantidad explícita, asume 1.
        - Limpia la descripción: quita viñetas, signos de pesos y texto innecesario.
        - Los precios deben ser números sin comas ni signos.
        - Responde SOLO con el JSON.

        Texto del usuario:
        {$rawText}
        PROMPT;

        // Enviar la solicitud a la API
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-3.5-flash-lite:generateContent";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-goog-api-key' => $apiKey, // Pasar la clave a través del encabezado de solicitud
        ])->post($url, [
            'contents' => [
                ['parts' => [['text' => $prompt]]],
            ],
            'generationConfig' => [
                'responseMimeType' => 'application/json',
            ],
        ]);

        if ($response->failed()) {
            Log::error('Gemini API error', ['response' => $response->body()]);
            throw new \Exception('No se pudo conectar con el servicio de IA.');
        }

        $body = $response->json();
        $text = $body['candidates'][0]['content']['parts'][0]['text'] ?? null;

        if (!$text) {
            throw new \Exception('La IA no devolvió una respuesta válida.');
        }

        $data = json_decode($text, true);

        if (!isset($data['items']) || !is_array($data['items'])) {
            throw new \Exception('La IA no pudo interpretar el texto. Intenta con un formato más claro.');
        }

        // Normalizar ítems
        $items = [];
        $subtotal = 0;
        foreach ($data['items'] as $item) {
            $cantidad = (int) ($item['cantidad'] ?? 1);
            $precio = (float) ($item['precio_unitario'] ?? 0);
            $totalItem = $cantidad * $precio;

            $items[] = [
                'seccion' => strtoupper(trim($item['seccion'] ?? 'SERVICIOS')),
                'descripcion' => trim($item['descripcion'] ?? ''),
                'cantidad' => $cantidad,
                'precio_unitario' => $precio,
                'total' => $totalItem,
            ];
            $subtotal += $totalItem;
        }

        $total = $subtotal;

        return [
            'items' => $items,
            'total' => $total,
        ];
    }
}
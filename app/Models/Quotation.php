<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'folio',
        'client_name',
        'quotation_date',
        'items',
        'subtotal',
        'iva',
        'total',
        'raw_input',
        'pdf_path',
        'word_path',
        'excel_path',
        'image_path',
    ];

    protected $casts = [
        'items' => 'array',
        'quotation_date' => 'date',
        'subtotal' => 'decimal:2',
        'iva' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    // Genera el siguiente folio disponible
    public static function generateFolio(): string
    {
        $year = now()->year;
        $prefix = "EEL-{$year}-";
        $last = self::where('folio', 'like', $prefix . '%')
            ->orderByDesc('folio')
            ->first();

        if ($last) {
            $number = (int) substr($last->folio, strlen($prefix)) + 1;
        } else {
            $number = 1;
        }

        return $prefix . str_pad($number, 3, '0', STR_PAD_LEFT);
    }
}
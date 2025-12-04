<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path', 'type', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Auto-generate slug if not set
    public static function boot()
    {
        parent::boot();
        static::creating(function ($file) {
            if (empty($file->slug)) {
                $file->slug = Str::slug($file->name);
            }
        });

        static::updating(function ($file) {
            if (empty($file->slug)) {
                $file->slug = Str::slug($file->name);
            }
        });
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                     ->orWhereRaw('LOWER(name) like ?', ['%' . strtolower($search) . '%']);
    }
}
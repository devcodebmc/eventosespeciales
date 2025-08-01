<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory, SoftDeletes; // Agregamos SoftDeletes

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'category_id',
        'event_date',
        'location',
        'organizer',
        'client',
        'image',
        'video_url',
        'status',
        'type',
        'user_id', // Agregamos el campo user_id para la relación con el usuario
    ];
    
    /**
     * Genera automáticamente el slug al crear una receta.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($recipe) {
            $recipe->slug = Str::slug($recipe->title);
        });
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', "%{$search}%")
                     ->orWhereRaw('LOWER(title) like ?', ['%' . strtolower($search) . '%']);
    }

    /**
     * Relación con la categoría (Muchas recetas pertenecen a una categoría).
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relación con el usuario (Muchas recetas pertenecen a un usuario).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con etiquetas (Muchos a muchos).
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'event_tags');
    }

    /**
     * Relación con imágenes de la receta (Una receta tiene muchas imágenes).
     */
    public function images()
    {
        return $this->hasMany(EventImage::class);
    }
}

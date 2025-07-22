<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'image', 'status', 'order'];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($service) {
            $service->slug = Str::slug($service->name);
            // Asignar el siguiente número de orden al crear
            $service->order = static::max('order') + 1;
        });

        static::updating(function ($service) {
            $service->slug = Str::slug($service->name);
        });
    }
  
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                     ->orWhereRaw('LOWER(name) like ?', ['%' . strtolower($search) . '%']);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
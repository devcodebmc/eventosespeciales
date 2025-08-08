<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Furniture extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'image', 'status', 'order', 'service_id'];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($furniture) {
            $furniture->slug = Str::slug($furniture->name);
            // Asignar el siguiente número de orden al crear
            $furniture->order = static::max('order') + 1;
        });

        static::updating(function ($furniture) {
            $furniture->slug = Str::slug($furniture->name);
        });
    }

    public function service()    
    {
        return $this->belongsTo(Service::class);
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
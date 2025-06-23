<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($service) {
            $service->slug = Str::slug($service->name);
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

}

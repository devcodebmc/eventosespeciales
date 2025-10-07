<?php

namespace App\Traits;

use App\Models\Service;
use App\Models\Event;
use App\Models\EventImage;
use App\Models\Furniture;
use App\Models\Promotion;

trait FrontDataTrait
{
    protected function getServices()
    {
        return Service::where('status', 'published')
            ->orderBy('order', 'ASC')
            ->get();
    }

    protected function getPackages()
    {
        return Event::select('id', 'title', 'summary', 'content', 'image', 'slug')
            ->where('type', 'Package')
            ->where('status', 'published')
            ->get();
    }

    protected function getPromotions()
    {
        return Promotion::where('is_active', true)
            ->where(function($query) {
                $query->whereNull('starts_at')
                      ->orWhere('starts_at', '<=', now());
            })
            ->where(function($query) {
                $query->whereNull('ends_at')
                      ->orWhere('ends_at', '>=', now());
            })
            ->orderBy('order', 'asc')
            ->get();
    }

    protected function getCards($limit = 6)
    {
        return Event::with(['category:id,name,slug'])
            ->where('type', 'Event')
            ->where('status', 'published')
            ->select('id', 'title', 'summary', 'event_date', 'image', 'slug', 'category_id')
            ->orderBy('event_date', 'desc')
            ->limit($limit)
            ->get();
    }

    protected function getFurnitures()
    {
        return Furniture::query()
            ->select('id', 'name', 'slug', 'description', 'image', 'status', 'order', 'service_id')
            ->where('status', 'published')
            ->with(['service:id,name'])
            ->orderBy('order', 'asc')
            ->get()
            ->groupBy(function ($item) {
                return optional($item->service)->name;
            });
    }

    protected function getSmallGallery($limit = 6)
    {
        return EventImage::query()
            ->select(
                'event_images.id',
                'event_images.image_path',
                'event_images.event_id',
                'event_images.order'
            )
            ->join('events as e', function($join) {
                $join->on('event_images.event_id', '=', 'e.id')
                     ->where('e.type', 'Gallery')
                     ->where('e.status', 'published');
            })
            ->with(['event:id,title'])
            ->orderBy('event_images.order')
            ->limit($limit)
            ->get();
    }

    protected function getEvents($limit = 4)
    {
        return Event::with([
                'category:id,name',
                'tags:id,name',
                'images:id,image_path,order,event_id' 
            ])
            ->where([
                ['type', '=', 'Event'],
                ['status', '=', 'published']
            ])
            ->select('id', 'title', 'slug', 'category_id', 'image', 'event_date')
            ->orderByDesc('event_date')
            ->limit($limit)
            ->get();
    }
}
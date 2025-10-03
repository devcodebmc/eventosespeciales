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
        $furnitures = Furniture::with(['service:id,name,slug'])
            ->where('status', 'published')
            ->select('id', 'name', 'slug', 'description', 'image', 'status', 'order', 'service_id')
            ->orderBy('order', 'asc')
            ->get();

        return $furnitures->groupBy('service.name');
    }

    protected function getSmallGallery($limit = 6)
    {
        return EventImage::select('id', 'image_path', 'event_id', 'order')
            ->whereHas('event', function($query) {
                $query->where('type', 'Gallery')
                    ->where('status', 'published');
            })
            ->with(['event:id,title'])
            ->orderBy('order')
            ->limit($limit)
            ->get();
    }

    protected function getEvents($limit = 4)
    {
        return Event::with([
            'category:id,name', 
            'tags:id,name',
            'images' => function($query) {
                $query->select('id', 'image_path', 'order', 'event_id')
                      ->orderBy('order');
            }
            ])
            ->where('type', 'Event')
            ->where('status', 'published')
            ->select('id', 'title', 'slug', 'category_id', 'image')
            ->orderBy('event_date', 'desc')
            ->limit($limit)
            ->get();
    }
}
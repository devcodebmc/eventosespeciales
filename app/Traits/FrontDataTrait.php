<?php

namespace App\Traits;

use App\Models\Service;
use App\Models\Event;
use App\Models\EventImage;
use App\Models\Furniture;

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

    protected function getCards($limit = 6)
    {
        return Event::with(['category:id,name,slug'])
            ->where('type', 'Event')
            ->where('status', 'published')
            ->select('id', 'title', 'summary', 'event_date', 'image', 'slug', 'category_id')
            ->orderBy('event_date', 'asc')
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
}
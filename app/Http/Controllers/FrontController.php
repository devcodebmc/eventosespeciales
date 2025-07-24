<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;
use App\Models\Event;
use App\Models\Tag;
use App\Models\EventImage;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::where('status', 'published')
                    ->orderBy('order', 'ASC')
                    ->get();

        $packages = Event::select('id', 'title', 'summary', 'content', 'image', 'slug')
                    ->where('type', 'Package')
                    ->where('status', 'published')
                    ->get();

        $cards = Event::with(['category:id,name,slug'])
                    ->where('type', 'Event')
                    ->where('status', 'published')
                    ->select('id', 'title', 'summary', 'event_date', 'image', 'slug', 'category_id')
                    ->limit(5)
                    ->get();

        $smallGallery = EventImage::select('id', 'image_path', 'event_id', 'order')
                ->whereHas('event', function($query) {
                    $query->where('type', 'Gallery')
                          ->where('status', 'published');
                })
                ->with(['event:id,title']) // Carga mínima de datos del evento
                ->orderBy('order')
                ->limit(3)
                ->get();

        return view('welcome', compact('services', 'packages', 'cards', 'smallGallery'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $services = Service::where('status', 'published')
                    ->orderBy('order', 'ASC')
                    ->get();

        $packages = Event::select('id', 'title', 'summary', 'content', 'image', 'slug')
                    ->where('type', 'Package')
                    ->where('status', 'published')
                    ->get();

        $cards = Event::with(['category:id,name,slug'])
                    ->where('type', 'Event')
                    ->where('status', 'published')
                    ->select('id', 'title', 'summary', 'event_date', 'image', 'slug', 'category_id')
                    ->limit(5)
                    ->get();

        $smallGallery = EventImage::select('id', 'image_path', 'event_id', 'order')
                ->whereHas('event', function($query) {
                    $query->where('type', 'Gallery')
                          ->where('status', 'published');
                })
                ->with(['event:id,title']) // Carga mínima de datos del evento
                ->orderBy('order')
                ->limit(7)
                ->get();

        $events = Event::with(['category:id,name,slug'])
                    ->where('type', 'Event')
                    ->where('status', 'published')
                    ->select('id', 'title', 'summary', 'event_date', 'image', 'slug', 'location', 'category_id')
                    ->limit(10)
                    ->get();
                
        return view('frontend.pages.'. $slug, compact('category', 'services', 'packages', 'cards', 'smallGallery', 'events'));
    }

    public function showService($slug)
    {
        // Obtener l aimagen del servicio por slug
        $serviceImage = Service::where('slug', $slug)
                    ->where('status', 'published')
                    ->select('image')
                    ->firstOrFail();

        // Obtener el post
        $post = Event::where('slug', $slug)
                ->with([
                'category:id,name,slug',
                'images' => function($query) {
                    $query->select('id', 'image_path', 'order', 'event_id')
                      ->orderBy('order');
                }
                ])
                ->where('type', 'Service')
                ->where('status', 'published')
                ->firstOrFail();

        $smallGallery = EventImage::select('id', 'image_path', 'event_id', 'order')
                ->whereHas('event', function($query) {
                    $query->where('type', 'Gallery')
                          ->where('status', 'published');
                })
                ->with(['event:id,title']) // Carga mínima de datos del evento
                ->orderBy('order')
                ->limit(7)
                ->get();

        return view('frontend.posts.service', compact('serviceImage', 'post', 'smallGallery'));
    }

   
}

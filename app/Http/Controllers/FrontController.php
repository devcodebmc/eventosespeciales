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
        $services = Service::all();

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
                
        return view('frontend.pages.'. $slug, compact('category', 'cards', 'smallGallery'));
    }

   
}

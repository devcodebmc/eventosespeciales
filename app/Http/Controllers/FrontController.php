<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category;
use App\Models\Event;
use App\Traits\FrontDataTrait;

class FrontController extends Controller
{
    use FrontDataTrait;

    public function index(Request $request)
    {
        return view('welcome', [
            'services' => $this->getServices(),
            'packages' => $this->getPackages(),
            'cards' => $this->getCards(),
            'smallGallery' => $this->getSmallGallery(),
            'moments' => $this->getEvents()
        ]);
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $events = Event::with(['category:id,name,slug'])
                    ->where('type', 'Event')
                    ->where('status', 'published')
                    ->select('id', 'title', 'summary', 'event_date', 'image', 'slug', 'location', 'category_id')
                    ->orderBy('event_date', 'desc')
                    ->limit(10)
                    ->get();

        return view('frontend.pages.'.$slug, [
            'category' => $category,
            'events' => $events,
            'services' => $this->getServices(),
            'packages' => $this->getPackages(),
            'cards' => $this->getCards(),
            'furnitures' => $this->getFurnitures(),
            'smallGallery' => $this->getSmallGallery()
        ]);
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
                'tags:id,name,slug',
                'images' => function($query) {
                    $query->select('id', 'image_path', 'order', 'event_id')
                      ->orderBy('order');
                }
                ])
                ->where('type', 'Service')
                ->where('status', 'published')
                ->firstOrFail();

        return view('frontend.posts.service', [
            'serviceImage' => $serviceImage,
            'post' => $post,
            'smallGallery' => $this->getSmallGallery()
        ]);
    }

    public function showEvent($slug)
    {
        $post = Event::where('slug', $slug)
                ->with([
                'category:id,name,slug',
                'tags:id,name,slug',
                'images' => function($query) {
                    $query->select('id', 'image_path', 'order', 'event_id')
                      ->orderBy('order');
                }
                ])
                ->where('type', 'Event')
                ->where('status', 'published')
                ->firstOrFail();
                
        return view('frontend.posts.event', [
            'post' => $post,
            'packages' => $this->getPackages(),
            'cards' => $this->getCards(),
            'smallGallery' => $this->getSmallGallery()
        ]);
    }
   
}

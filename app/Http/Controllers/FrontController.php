<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;
use App\Models\Event;
use App\Models\Tag;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::all();
        return view('welcome', compact('services'));
    }

   
}

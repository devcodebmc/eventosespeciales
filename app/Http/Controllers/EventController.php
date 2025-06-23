<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\Tag;

class EventController extends Controller
{
    public function index(Request $request)
    {
        return view('welcome');
    }

   
}

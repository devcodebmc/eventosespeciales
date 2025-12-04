<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventImageController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FurnitureController;
use App\Http\Controllers\FetchTagController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\RecyclebinController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontController::class, 'index'])->name('welcome');

Route::get('/{slug}', [FrontController::class, 'category'])->name('category');

// Event route
Route::get('/eventos/{slug}', [FrontController::class, 'showEvent'])->name('events.showEvent');

// Service route
Route::get('/servicios/{slug}', [FrontController::class, 'showService'])->name('services.showService');

// Contact form route
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Subscription route
Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('categories', CategoryController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('furnitures', FurnitureController::class);
    Route::resource('tags', TagController::class);
    Route::resource('promotions', PromotionController::class);
    Route::resource('files', FileController::class);

    Route::resource('events', EventController::class);
    Route::patch('/events/{event}/update-status', [EventController::class, 'updateStatus'])
    ->name('events.update-status');
    Route::get('/fetch-tags', [FetchTagController::class, 'index'])->name('fetch-tags.index');
    Route::delete('/events/images/{eventImage}', [EventImageController::class, 'destroy'])->name('event.images.destroy');
  
    // Recyclebin routes
    Route::get('/recyclebin', [RecyclebinController::class, 'index'])->name('recyclebin.index');
    Route::patch('/recyclebin/{id}/restore', [RecyclebinController::class, 'restore'])->name('recyclebin.restore');
    Route::delete('/recyclebin/{id}/destroy', [RecyclebinController::class, 'destroy'])->name('recyclebin.destroy');
});

require __DIR__.'/auth.php';



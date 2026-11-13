<?php

declare(strict_types=1);

use App\Http\Controllers\PublicPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicPageController::class, 'home'])->name('home');
Route::get('/about', [PublicPageController::class, 'about'])->name('about');
Route::get('/services', [PublicPageController::class, 'services'])->name('services');
Route::get('/campaigns', [PublicPageController::class, 'campaigns'])->name('campaigns');
Route::get('/projects', [PublicPageController::class, 'projects'])->name('projects');
Route::get('/blog', [PublicPageController::class, 'blog'])->name('blog');

// Stage 1 Named Routes (built one page at a time per project workflow)
Route::get('/publications', [PublicPageController::class, 'pendingPage'])->name('publications');
Route::get('/events-gallery', [PublicPageController::class, 'pendingPage'])->name('events-gallery');
Route::get('/partners-careers', [PublicPageController::class, 'pendingPage'])->name('partners-careers');
Route::get('/contact', [PublicPageController::class, 'pendingPage'])->name('contact');

Route::post('/newsletter/subscribe', [PublicPageController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');

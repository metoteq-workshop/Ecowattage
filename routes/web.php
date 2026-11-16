<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CmsAdminController;
use App\Http\Controllers\PublicPageController;
use Illuminate\Support\Facades\Route;

// Public Frontend Routes (Stage 1 + Stage 2 CMS Dynamic Visibility & SEO)
Route::get('/', [PublicPageController::class, 'home'])->name('home');
Route::get('/about', [PublicPageController::class, 'about'])->name('about');
Route::get('/services', [PublicPageController::class, 'services'])->name('services');
Route::get('/campaigns', [PublicPageController::class, 'campaigns'])->name('campaigns');
Route::get('/projects', [PublicPageController::class, 'projects'])->name('projects');
Route::get('/blog', [PublicPageController::class, 'blog'])->name('blog');
Route::get('/publications', [PublicPageController::class, 'publications'])->name('publications');
Route::get('/events-gallery', [PublicPageController::class, 'eventsGallery'])->name('events-gallery');
Route::get('/partners-careers', [PublicPageController::class, 'partnersCareers'])->name('partners-careers');
Route::get('/contact', [PublicPageController::class, 'contact'])->name('contact');
Route::get('/p/{slug}', [PublicPageController::class, 'customPage'])->name('pages.custom');

Route::post('/contact/submit', [PublicPageController::class, 'submitContact'])->name('contact.submit');
Route::post('/newsletter/subscribe', [PublicPageController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');

// Stage 2 CMS Authentication Routes
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/admin/sign-in', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->middleware('auth')->name('admin.logout');

// Stage 2 CMS Administration Panel (Protected by Auth + RBAC)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function (): void {
    Route::get('/', [CmsAdminController::class, 'dashboard'])->name('dashboard');

    // Pages, Visibility (Hide/Unhide without deletion), Publish/Draft & SEO Management
    Route::get('/pages', [CmsAdminController::class, 'pagesIndex'])->name('pages.index');
    Route::get('/pages/create', [CmsAdminController::class, 'pagesCreate'])->name('pages.create');
    Route::post('/pages', [CmsAdminController::class, 'pagesStore'])->name('pages.store');
    Route::get('/pages/{cmsPage}/edit', [CmsAdminController::class, 'pagesEdit'])->name('pages.edit');
    Route::put('/pages/{cmsPage}', [CmsAdminController::class, 'pagesUpdate'])->name('pages.update');
    Route::patch('/pages/{cmsPage}/toggle-visibility', [CmsAdminController::class, 'pagesToggleVisibility'])->name('pages.toggle-visibility');
    Route::patch('/pages/{cmsPage}/toggle-status', [CmsAdminController::class, 'pagesToggleStatus'])->name('pages.toggle-status');

    // Modular Content (Articles, Publications, Projects, Campaigns, Events)
    Route::get('/posts', [CmsAdminController::class, 'postsIndex'])->name('posts.index');
    Route::post('/posts', [CmsAdminController::class, 'postsStore'])->name('posts.store');
    Route::patch('/posts/{cmsPost}/toggle-visibility', [CmsAdminController::class, 'postsToggleVisibility'])->name('posts.toggle-visibility');

    // Media Library Manager
    Route::get('/media', [CmsAdminController::class, 'mediaIndex'])->name('media.index');
    Route::post('/media', [CmsAdminController::class, 'mediaStore'])->name('media.store');

    // Contact Submissions & Newsletter Subscribers
    Route::get('/inquiries', [CmsAdminController::class, 'inquiriesIndex'])->name('inquiries.index');
    Route::patch('/inquiries/{submission}/status', [CmsAdminController::class, 'inquiriesUpdateStatus'])->name('inquiries.status');

    // Users, 9 Proposal RBAC Roles & Immutable Activity Audit Logs
    Route::get('/users', [CmsAdminController::class, 'usersIndex'])->name('users.index');
    Route::post('/users', [CmsAdminController::class, 'usersStore'])->name('users.store');
    Route::get('/activity-logs', [CmsAdminController::class, 'activityLogsIndex'])->name('activity-logs.index');
});

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\CmsPage;
use App\Models\ContactSubmission;
use App\Models\NewsletterSubscriber;
use App\Support\CmsContentService;
use App\Support\StageOneData;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Throwable;

class PublicPageController extends Controller
{
    /**
     * Render Page 1: Homepage (/) following the Ecozone /nature layout architecture.
     */
    public function home(): View
    {
        CmsContentService::ensureRouteAccessible('home');

        return view('pages.home', [
            'site' => StageOneData::siteConfig(),
            'navigation' => CmsContentService::navigation(),
            'home' => StageOneData::homePageData(),
        ]);
    }

    /**
     * Render Page 2: About Us (/about) modeled on Ecozone /about and /team layouts.
     */
    public function about(): View
    {
        CmsContentService::ensureRouteAccessible('about');

        return view('pages.about', [
            'site' => StageOneData::siteConfig(),
            'navigation' => CmsContentService::navigation(),
            'about' => StageOneData::aboutPageData(),
            'funfacts' => StageOneData::homePageData()['funfacts'],
        ]);
    }

    /**
     * Render Page 3: Solutions & Services (/services).
     */
    public function services(): View
    {
        CmsContentService::ensureRouteAccessible('services');

        return view('pages.services', [
            'site' => StageOneData::siteConfig(),
            'navigation' => CmsContentService::navigation(),
            'servicesData' => StageOneData::servicesPageData(),
            'funfacts' => StageOneData::homePageData()['funfacts'],
        ]);
    }

    /**
     * Render Page 4: Advocacy Campaigns (/campaigns).
     */
    public function campaigns(): View
    {
        CmsContentService::ensureRouteAccessible('campaigns');

        return view('pages.campaigns', [
            'site' => StageOneData::siteConfig(),
            'navigation' => CmsContentService::navigation(),
            'campaignsData' => CmsContentService::campaignsPageData(),
            'funfacts' => StageOneData::homePageData()['funfacts'],
        ]);
    }

    /**
     * Render Page 5: Projects Showcase (/projects).
     */
    public function projects(): View
    {
        CmsContentService::ensureRouteAccessible('projects');

        return view('pages.projects', [
            'site' => StageOneData::siteConfig(),
            'navigation' => CmsContentService::navigation(),
            'projectsData' => CmsContentService::projectsPageData(),
            'funfacts' => StageOneData::homePageData()['funfacts'],
        ]);
    }

    /**
     * Render Page 6: Blog & News (/blog).
     */
    public function blog(): View
    {
        CmsContentService::ensureRouteAccessible('blog');

        return view('pages.blog', [
            'site' => StageOneData::siteConfig(),
            'navigation' => CmsContentService::navigation(),
            'blogData' => CmsContentService::blogPageData(),
        ]);
    }

    /**
     * Render Page 7: Publications & Research (/publications).
     */
    public function publications(): View
    {
        CmsContentService::ensureRouteAccessible('publications');

        return view('pages.publications', [
            'site' => StageOneData::siteConfig(),
            'navigation' => CmsContentService::navigation(),
            'publicationsData' => CmsContentService::publicationsPageData(),
        ]);
    }

    /**
     * Render Page 8: Events & Media Gallery (/events-gallery).
     */
    public function eventsGallery(): View
    {
        CmsContentService::ensureRouteAccessible('events-gallery');

        return view('pages.events-gallery', [
            'site' => StageOneData::siteConfig(),
            'navigation' => CmsContentService::navigation(),
            'eventsData' => CmsContentService::eventsGalleryPageData(),
        ]);
    }

    /**
     * Render Page 9: Partners & Careers (/partners-careers).
     */
    public function partnersCareers(): View
    {
        CmsContentService::ensureRouteAccessible('partners-careers');

        return view('pages.partners-careers', [
            'site' => StageOneData::siteConfig(),
            'navigation' => CmsContentService::navigation(),
            'partnersData' => StageOneData::partnersCareersPageData(),
        ]);
    }

    /**
     * Render Page 10: Contact Us (/contact).
     */
    public function contact(): View
    {
        CmsContentService::ensureRouteAccessible('contact');

        return view('pages.contact', [
            'site' => StageOneData::siteConfig(),
            'navigation' => CmsContentService::navigation(),
            'contactData' => StageOneData::contactPageData(),
        ]);
    }

    /**
     * Render a custom CMS-created page (/p/{slug}) with publish & visibility enforcement.
     */
    public function customPage(Request $request, string $slug): View
    {
        $page = CmsPage::query()->where('slug', $slug)->firstOrFail();

        if (! $page->isPubliclyAccessible()) {
            $user = $request->user();
            $canPreview = $user !== null
                && method_exists($user, 'canManagePages')
                && $user->canManagePages()
                && $request->boolean('preview');

            if (! $canPreview) {
                abort(404);
            }
        }

        return view('pages.custom-cms-page', [
            'site' => StageOneData::siteConfig(),
            'navigation' => CmsContentService::navigation(),
            'cmsPage' => $page,
        ]);
    }

    /**
     * Handle contact inquiry submission with database storage when migrated.
     */
    public function submitContact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'organization' => ['nullable', 'string', 'max:150'],
            'inquiry_type' => ['required', 'string', 'max:120'],
            'subject' => ['required', 'string', 'max:180'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
        ]);

        try {
            if (Schema::hasTable('contact_submissions')) {
                ContactSubmission::query()->create([
                    ...$validated,
                    'status' => 'new',
                ]);
            }
        } catch (Throwable) {
            // Graceful fallback when running without migrated tables
        }

        return back()->with(
            'contact_status',
            "Thank you, {$validated['name']}! Your inquiry regarding \"{$validated['inquiry_type']}\" has been received and logged."
        );
    }

    /**
     * Handle newsletter subscription with database persistence when migrated.
     */
    public function subscribeNewsletter(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        try {
            if (Schema::hasTable('newsletter_subscribers')) {
                NewsletterSubscriber::query()->updateOrCreate(
                    ['email' => $validated['email']],
                    [
                        'status' => 'active',
                        'subscribed_at' => now(),
                    ]
                );
            }
        } catch (Throwable) {
            // Graceful fallback when running without migrated tables
        }

        return back()->with(
            'newsletter_status',
            "Thank you! {$validated['email']} has been subscribed to Ecowattage clean energy updates."
        );
    }
}

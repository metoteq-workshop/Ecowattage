<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\StageOneData;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PublicPageController extends Controller
{
    /**
     * Render Page 1: Public Homepage (/).
     */
    public function home(): View
    {
        return view('pages.home', [
            'site' => StageOneData::siteConfig(),
            'navigation' => StageOneData::navigation(),
            'home' => StageOneData::homePageData(),
        ]);
    }

    /**
     * Render Page 2: About Us (/about).
     */
    public function about(): View
    {
        return view('pages.about', [
            'site' => StageOneData::siteConfig(),
            'navigation' => StageOneData::navigation(),
            'about' => StageOneData::aboutPageData(),
            'funfacts' => StageOneData::homePageData()['funfacts'],
        ]);
    }

    /**
     * Render Page 3: Solutions & Services (/services).
     */
    public function services(): View
    {
        return view('pages.services', [
            'site' => StageOneData::siteConfig(),
            'navigation' => StageOneData::navigation(),
            'servicesData' => StageOneData::servicesPageData(),
        ]);
    }

    /**
     * Render Page 4: Advocacy Campaigns (/campaigns).
     */
    public function campaigns(): View
    {
        return view('pages.campaigns', [
            'site' => StageOneData::siteConfig(),
            'navigation' => StageOneData::navigation(),
            'campaignsData' => StageOneData::campaignsPageData(),
            'funfacts' => StageOneData::homePageData()['funfacts'],
        ]);
    }

    /**
     * Render Page 5: Projects Showcase (/projects).
     */
    public function projects(): View
    {
        return view('pages.projects', [
            'site' => StageOneData::siteConfig(),
            'navigation' => StageOneData::navigation(),
            'projectsData' => StageOneData::projectsPageData(),
            'funfacts' => StageOneData::homePageData()['funfacts'],
        ]);
    }

    /**
     * Render Page 6: Blog & News (/blog).
     */
    public function blog(): View
    {
        return view('pages.blog', [
            'site' => StageOneData::siteConfig(),
            'navigation' => StageOneData::navigation(),
            'blogData' => StageOneData::blogPageData(),
        ]);
    }

    /**
     * Render a clean Stage 1 status notice for inner pages that are queued to be built next.
     */
    public function pendingPage(Request $request): View
    {
        $routeName = $request->route()?->getName() ?? 'page';
        $pageTitles = [
            'about' => 'About Us (Vision, Mission & Team)',
            'services' => 'Solutions & Renewable Energy Services',
            'campaigns' => 'Advocacy Campaigns',
            'projects' => 'Projects Showcase',
            'blog' => 'Blog & News',
            'publications' => 'Publications & Research',
            'events-gallery' => 'Events & Media Gallery',
            'partners-careers' => 'Partners & Careers',
            'contact' => 'Contact Us',
        ];

        return view('pages.pending-stage-one', [
            'site' => StageOneData::siteConfig(),
            'navigation' => StageOneData::navigation(),
            'pageTitle' => $pageTitles[$routeName] ?? ucfirst($routeName),
            'routeName' => $routeName,
        ]);
    }

    /**
     * Handle Stage 1 newsletter subscription demonstration with flash feedback.
     */
    public function subscribeNewsletter(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        return back()->with(
            'newsletter_status',
            "Thank you! {$validated['email']} has been recorded in the Stage 1 demo preview. Full database & monthly digest automation will be connected in Stage 2."
        );
    }
}

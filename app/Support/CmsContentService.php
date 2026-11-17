<?php

declare(strict_types=1);

namespace App\Support;

use App\Models\CmsPage;
use App\Models\CmsPost;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Throwable;

class CmsContentService
{
    /**
     * Safely check whether the cms_pages table exists and has records.
     */
    public static function hasDatabasePages(): bool
    {
        try {
            return Schema::hasTable('cms_pages') && CmsPage::query()->exists();
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * Safely check whether the cms_posts table exists and has records for the given type.
     */
    public static function hasDatabasePosts(string $type): bool
    {
        try {
            return Schema::hasTable('cms_posts') && CmsPost::query()->where('type', $type)->exists();
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * Retrieve the CmsPage record for the active route if available.
     */
    public static function currentRoutePage(?string $routeName = null): ?CmsPage
    {
        $route = $routeName ?? request()?->route()?->getName();
        if ($route === null || ! self::hasDatabasePages()) {
            return null;
        }

        return CmsPage::query()->where('route_name', $route)->first();
    }

    /**
     * Enforce public visibility and publish status for a named route.
     * Hidden or draft pages return 404 to the public without deleting any data,
     * while authenticated CMS managers can preview them via ?preview=1.
     */
    public static function ensureRouteAccessible(string $routeName): ?CmsPage
    {
        if (! self::hasDatabasePages()) {
            return null;
        }

        $page = CmsPage::query()->where('route_name', $routeName)->first();
        if ($page === null) {
            return null;
        }

        if (! $page->isPubliclyAccessible()) {
            $user = Auth::user();
            $canPreview = $user !== null
                && method_exists($user, 'canManagePages')
                && $user->canManagePages()
                && request()->boolean('preview');

            if (! $canPreview) {
                abort(404);
            }
        }

        return $page;
    }

    /**
     * Build the dynamic header/footer navigation array, filtering out hidden or draft pages.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function navigation(): array
    {
        $baseNavigation = StageOneData::navigation();
        if (! self::hasDatabasePages()) {
            return $baseNavigation;
        }

        /** @var Collection<string, CmsPage> $pagesByRoute */
        $pagesByRoute = CmsPage::query()
            ->whereNotNull('route_name')
            ->get()
            ->keyBy('route_name');

        $filtered = [];

        foreach ($baseNavigation as $item) {
            if (isset($item['children']) && is_array($item['children'])) {
                $visibleChildren = [];
                foreach ($item['children'] as $child) {
                    $childRoute = (string) ($child['route'] ?? '');
                    $cmsChild = $pagesByRoute->get($childRoute);

                    if ($cmsChild !== null) {
                        if (! $cmsChild->isPubliclyAccessible() || ! $cmsChild->show_in_header_nav) {
                            continue;
                        }
                        $child['label'] = $cmsChild->nav_label ?: $cmsChild->title;
                        if ($cmsChild->nav_description) {
                            $child['description'] = $cmsChild->nav_description;
                        }
                    }

                    $visibleChildren[] = $child;
                }

                if ($visibleChildren === []) {
                    continue;
                }

                $item['children'] = $visibleChildren;
                $item['route'] = $visibleChildren[0]['route'];
                $filtered[] = $item;

                continue;
            }

            $route = (string) ($item['route'] ?? '');
            $cmsPage = $pagesByRoute->get($route);

            if ($cmsPage !== null) {
                if (! $cmsPage->isPubliclyAccessible() || ! $cmsPage->show_in_header_nav) {
                    continue;
                }
                $item['label'] = $cmsPage->nav_label ?: $cmsPage->title;
            }

            $filtered[] = $item;
        }

        return $filtered;
    }

    /**
     * Split stored body text into non-empty paragraph/bullet strings.
     *
     * @return array<int, string>
     */
    private static function splitParagraphs(?string $body, string $fallback): array
    {
        $raw = trim((string) $body);
        if ($raw === '') {
            return [$fallback];
        }

        $parts = preg_split('/\R{2,}|\R/', $raw) ?: [];
        $cleaned = array_values(array_filter(array_map('trim', $parts), fn (string $line): bool => $line !== ''));

        return $cleaned !== [] ? $cleaned : [$fallback];
    }

    /**
     * Resolve Blog & News page data merged with live CmsPost('article') records.
     *
     * @return array<string, mixed>
     */
    public static function blogPageData(): array
    {
        $data = StageOneData::blogPageData();
        if (! self::hasDatabasePosts('article')) {
            return $data;
        }

        $posts = CmsPost::query()
            ->where('type', 'article')
            ->publiclyAccessible()
            ->orderByDesc('featured')
            ->orderBy('id')
            ->get();

        $articles = [];
        foreach ($posts as $post) {
            $meta = is_array($post->meta_json) ? $post->meta_json : [];
            $paragraphs = self::splitParagraphs($post->body, (string) $post->summary);

            $articles[] = [
                'slug' => $post->slug,
                'featured' => (bool) $post->featured,
                'category' => $post->category ?: 'Clean Energy Advocacy',
                'date' => 'Editorial Preview',
                'read_time' => (string) ($meta['read_time'] ?? '5 min read'),
                'author' => $post->author_name ?: 'Ecowattage Editorial Team',
                'title' => $post->title,
                'excerpt' => (string) $post->summary,
                'image' => $post->featured_image ?: '/images/illustrative/blog-energy-forum.jpg',
                'tags' => is_array($meta['tags'] ?? null) ? $meta['tags'] : ['Solar PV', 'Energy Literacy'],
                'body' => $paragraphs,
                'key_takeaways' => is_array($meta['key_takeaways'] ?? null) ? $meta['key_takeaways'] : $paragraphs,
            ];
        }

        $data['articles'] = $articles;

        return $data;
    }

    /**
     * Resolve Publications & Research page data merged with live CmsPost('publication') records.
     *
     * @return array<string, mixed>
     */
    public static function publicationsPageData(): array
    {
        $data = StageOneData::publicationsPageData();
        if (! self::hasDatabasePosts('publication')) {
            return $data;
        }

        $posts = CmsPost::query()
            ->where('type', 'publication')
            ->publiclyAccessible()
            ->orderBy('id')
            ->get();

        $list = [];
        foreach ($posts as $post) {
            $meta = is_array($post->meta_json) ? $post->meta_json : [];
            $list[] = [
                'id' => $post->slug,
                'title' => $post->title,
                'type' => $post->category ?: 'Policy Brief',
                'topic' => (string) ($meta['topic'] ?? 'Renewable Energy Research'),
                'audience' => (string) ($meta['audience'] ?? 'Policymakers & Engineers'),
                'status' => 'CMS Template Ready',
                'file_status' => (string) ($meta['file_status'] ?? '[PDF Pending Upload]'),
                'image' => $post->featured_image ?: '/images/illustrative/publications-research-desk.jpg',
                'abstract' => (string) $post->summary,
                'key_findings' => self::splitParagraphs($post->body, (string) $post->summary),
            ];
        }

        $data['publications_list'] = $list;

        return $data;
    }

    /**
     * Resolve Projects Showcase page data merged with live CmsPost('project') records.
     *
     * @return array<string, mixed>
     */
    public static function projectsPageData(): array
    {
        $data = StageOneData::projectsPageData();
        if (! self::hasDatabasePosts('project')) {
            return $data;
        }

        $posts = CmsPost::query()
            ->where('type', 'project')
            ->publiclyAccessible()
            ->orderBy('id')
            ->get();

        $list = [];
        foreach ($posts as $post) {
            $meta = is_array($post->meta_json) ? $post->meta_json : [];
            $list[] = [
                'id' => $post->slug,
                'title' => $post->title,
                'category' => $post->category ?: 'Solar Microgrid',
                'status' => (string) ($meta['project_status'] ?? 'Proposed Pilot'),
                'location' => (string) ($meta['location'] ?? '[Target Location: Supply via CMS]'),
                'capacity' => (string) ($meta['capacity'] ?? '[Capacity Spec Pending]'),
                'image' => $post->featured_image ?: '/images/illustrative/hero-solar-microgrid.jpg',
                'summary' => (string) $post->summary,
                'objectives' => self::splitParagraphs($post->body, (string) $post->summary),
            ];
        }

        $data['projects_list'] = $list;

        return $data;
    }

    /**
     * Resolve Advocacy Campaigns page data merged with live CmsPost('campaign') records.
     *
     * @return array<string, mixed>
     */
    public static function campaignsPageData(): array
    {
        $data = StageOneData::campaignsPageData();
        if (! self::hasDatabasePosts('campaign')) {
            return $data;
        }

        $posts = CmsPost::query()
            ->where('type', 'campaign')
            ->publiclyAccessible()
            ->orderBy('id')
            ->get();

        $list = [];
        foreach ($posts as $post) {
            $meta = is_array($post->meta_json) ? $post->meta_json : [];
            $list[] = [
                'id' => $post->slug,
                'title' => $post->title,
                'category' => $post->category ?: 'Public Energy Literacy',
                'status' => (string) ($meta['campaign_status'] ?? 'Active Drive'),
                'milestone_label' => (string) ($meta['milestone_label'] ?? 'Campaign Scope Mapping'),
                'progress_percent' => (int) ($meta['progress_percent'] ?? 60),
                'target_note' => (string) ($meta['target_note'] ?? '[Official Campaign Target Metrics Managed via CMS]'),
                'cta_label' => (string) ($meta['cta_label'] ?? 'Support This Campaign'),
                'image' => $post->featured_image ?: '/images/illustrative/hero-energy-education.jpg',
                'summary' => (string) $post->summary,
                'achievements' => self::splitParagraphs($post->body, (string) $post->summary),
            ];
        }

        $data['campaigns_list'] = $list;

        return $data;
    }

    /**
     * Resolve Events & Media Gallery page data merged with live CmsPost('event') records.
     *
     * @return array<string, mixed>
     */
    public static function eventsGalleryPageData(): array
    {
        $data = StageOneData::eventsGalleryPageData();
        if (! self::hasDatabasePosts('event')) {
            return $data;
        }

        $posts = CmsPost::query()
            ->where('type', 'event')
            ->publiclyAccessible()
            ->orderBy('id')
            ->get();

        $list = [];
        foreach ($posts as $post) {
            $meta = is_array($post->meta_json) ? $post->meta_json : [];
            $list[] = [
                'id' => $post->slug,
                'title' => $post->title,
                'category' => $post->category ?: 'Workshops & Training',
                'schedule' => (string) ($meta['schedule'] ?? '[Schedule Date & Venue: Confirm via CMS]'),
                'format' => (string) ($meta['format'] ?? 'In-Person Workshop'),
                'location' => (string) ($meta['location'] ?? 'Freetown [Host Venue Pending]'),
                'image' => $post->featured_image ?: '/images/illustrative/events-energy-conference.jpg',
                'summary' => (string) $post->summary,
                'highlights' => self::splitParagraphs($post->body, (string) $post->summary),
            ];
        }

        $data['events_list'] = $list;

        return $data;
    }
}

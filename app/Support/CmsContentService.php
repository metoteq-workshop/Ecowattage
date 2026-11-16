<?php

declare(strict_types=1);

namespace App\Support;

use App\Models\CmsPage;
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
}

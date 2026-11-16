<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\CmsPage;
use App\Models\CmsPost;
use App\Models\ContactSubmission;
use App\Models\MediaItem;
use App\Models\NewsletterSubscriber;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CmsAdminController extends Controller
{
    /**
     * Render the Stage 2 CMS Overview Dashboard.
     */
    public function dashboard(Request $request): View
    {
        abort_unless($request->user()?->is_active === true, 403);

        return view('admin.dashboard', [
            'stats' => [
                'total_pages' => CmsPage::query()->count(),
                'published_visible_pages' => CmsPage::query()->publiclyAccessible()->count(),
                'hidden_or_draft_pages' => CmsPage::query()
                    ->where(function ($query): void {
                        $query->where('status', '!=', 'published')
                            ->orWhere('is_visible', false);
                    })
                    ->count(),
                'total_posts' => CmsPost::query()->count(),
                'media_count' => MediaItem::query()->count(),
                'new_inquiries' => ContactSubmission::query()->where('status', 'new')->count(),
                'total_inquiries' => ContactSubmission::query()->count(),
                'subscribers_count' => NewsletterSubscriber::query()->where('status', 'active')->count(),
            ],
            'pages' => CmsPage::query()->orderBy('nav_order')->get(),
            'recentLogs' => ActivityLog::query()->with('user')->latest()->limit(8)->get(),
            'recentInquiries' => ContactSubmission::query()->latest()->limit(5)->get(),
        ]);
    }

    /**
     * List all CMS pages with Publish / Draft and Hide / Unhide controls.
     */
    public function pagesIndex(Request $request): View
    {
        abort_unless($request->user()?->canManagePages() === true, 403);

        return view('admin.pages.index', [
            'pages' => CmsPage::query()->orderBy('nav_order')->orderBy('id')->get(),
        ]);
    }

    /**
     * Show form to create a new custom CMS page.
     */
    public function pagesCreate(Request $request): View
    {
        abort_unless($request->user()?->canManagePages() === true, 403);

        return view('admin.pages.form', [
            'cmsPage' => new CmsPage([
                'status' => 'published',
                'is_visible' => true,
                'show_in_header_nav' => true,
                'show_in_footer_nav' => true,
                'nav_group' => 'root',
                'nav_order' => 20,
                'robots' => 'index, follow',
            ]),
            'isEdit' => false,
        ]);
    }

    /**
     * Store a new custom CMS page.
     */
    public function pagesStore(Request $request): RedirectResponse
    {
        abort_unless($request->user()?->canManagePages() === true, 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:180', 'unique:cms_pages,slug'],
            'nav_group' => ['required', 'string', Rule::in(['root', 'initiatives', 'resources', 'none'])],
            'nav_label' => ['nullable', 'string', 'max:100'],
            'nav_description' => ['nullable', 'string', 'max:255'],
            'nav_order' => ['required', 'integer', 'min:1', 'max:999'],
            'summary' => ['nullable', 'string', 'max:1000'],
            'content' => ['nullable', 'string'],
            'featured_image' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'string', Rule::in(['draft', 'published'])],
            'meta_title' => ['nullable', 'string', 'max:180'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'robots' => ['required', 'string', 'max:50'],
        ]);

        $slug = Str::slug($validated['slug'] ?: $validated['title']);

        $page = CmsPage::query()->create([
            ...$validated,
            'slug' => $slug,
            'is_visible' => $request->boolean('is_visible', true),
            'show_in_header_nav' => $request->boolean('show_in_header_nav', true),
            'show_in_footer_nav' => $request->boolean('show_in_footer_nav', true),
            'published_at' => $validated['status'] === 'published' ? now() : null,
            'created_by' => $request->user()?->id,
            'updated_by' => $request->user()?->id,
        ]);

        ActivityLog::record(
            'page.created',
            "Created CMS page \"{$page->title}\" ({$page->slug}).",
            $page,
            ['status' => $page->status, 'is_visible' => $page->is_visible]
        );

        return redirect()
            ->route('admin.pages.index')
            ->with('cms_notice', "Page \"{$page->title}\" has been created.");
    }

    /**
     * Show form to edit an existing CMS page (including SEO and navigation settings).
     */
    public function pagesEdit(Request $request, CmsPage $cmsPage): View
    {
        abort_unless($request->user()?->canManagePages() === true, 403);

        return view('admin.pages.form', [
            'cmsPage' => $cmsPage,
            'isEdit' => true,
        ]);
    }

    /**
     * Update an existing CMS page's content, visibility, navigation, and SEO metadata.
     */
    public function pagesUpdate(Request $request, CmsPage $cmsPage): RedirectResponse
    {
        abort_unless($request->user()?->canManagePages() === true, 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['required', 'string', 'max:180', Rule::unique('cms_pages', 'slug')->ignore($cmsPage->id)],
            'nav_group' => ['required', 'string', Rule::in(['root', 'initiatives', 'resources', 'none'])],
            'nav_label' => ['nullable', 'string', 'max:100'],
            'nav_description' => ['nullable', 'string', 'max:255'],
            'nav_order' => ['required', 'integer', 'min:1', 'max:999'],
            'summary' => ['nullable', 'string', 'max:1000'],
            'content' => ['nullable', 'string'],
            'featured_image' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'string', Rule::in(['draft', 'published'])],
            'meta_title' => ['nullable', 'string', 'max:180'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'robots' => ['required', 'string', 'max:50'],
        ]);

        $cmsPage->update([
            ...$validated,
            'slug' => Str::slug($validated['slug']),
            'is_visible' => $request->boolean('is_visible'),
            'show_in_header_nav' => $request->boolean('show_in_header_nav'),
            'show_in_footer_nav' => $request->boolean('show_in_footer_nav'),
            'published_at' => $validated['status'] === 'published' ? ($cmsPage->published_at ?? now()) : null,
            'updated_by' => $request->user()?->id,
        ]);

        ActivityLog::record(
            'page.updated',
            "Updated CMS page \"{$cmsPage->title}\".",
            $cmsPage,
            [
                'status' => $cmsPage->status,
                'is_visible' => $cmsPage->is_visible,
                'meta_title' => $cmsPage->meta_title,
            ]
        );

        return redirect()
            ->route('admin.pages.index')
            ->with('cms_notice', "Page \"{$cmsPage->title}\" has been updated.");
    }

    /**
     * Hide or unhide a CMS page without deleting its content or database record.
     */
    public function pagesToggleVisibility(Request $request, CmsPage $cmsPage): RedirectResponse
    {
        abort_unless($request->user()?->canPublish() === true, 403);

        $previous = $cmsPage->is_visible;
        $cmsPage->update([
            'is_visible' => ! $previous,
            'updated_by' => $request->user()?->id,
        ]);

        $action = $cmsPage->is_visible ? 'page.unhidden' : 'page.hidden';
        $stateLabel = $cmsPage->is_visible ? 'visible (unhidden)' : 'hidden from public';

        ActivityLog::record(
            $action,
            "Changed visibility of page \"{$cmsPage->title}\" to {$stateLabel} without deleting content.",
            $cmsPage,
            ['before' => $previous, 'after' => $cmsPage->is_visible]
        );

        return back()->with(
            'cms_notice',
            "Page \"{$cmsPage->title}\" is now {$stateLabel}. All page content remains safely preserved."
        );
    }

    /**
     * Toggle a CMS page between published and draft status without deleting content.
     */
    public function pagesToggleStatus(Request $request, CmsPage $cmsPage): RedirectResponse
    {
        abort_unless($request->user()?->canPublish() === true, 403);

        $previous = $cmsPage->status;
        $nextStatus = $previous === 'published' ? 'draft' : 'published';

        $cmsPage->update([
            'status' => $nextStatus,
            'published_at' => $nextStatus === 'published' ? now() : $cmsPage->published_at,
            'updated_by' => $request->user()?->id,
        ]);

        ActivityLog::record(
            $nextStatus === 'published' ? 'page.published' : 'page.drafted',
            "Changed status of page \"{$cmsPage->title}\" from {$previous} to {$nextStatus}.",
            $cmsPage,
            ['before' => $previous, 'after' => $nextStatus]
        );

        return back()->with(
            'cms_notice',
            "Page \"{$cmsPage->title}\" status changed to ".ucfirst($nextStatus).'.'
        );
    }

    /**
     * List and manage modular content items (articles, publications, projects, campaigns, events).
     */
    public function postsIndex(Request $request): View
    {
        abort_unless($request->user()?->canManageContent() === true, 403);

        $type = $request->query('type');
        $query = CmsPost::query()->latest();
        if (is_string($type) && $type !== '') {
            $query->where('type', $type);
        }

        return view('admin.posts.index', [
            'posts' => $query->get(),
            'activeType' => (string) ($type ?? ''),
        ]);
    }

    /**
     * Create a new modular content item (article, publication, project, campaign, or event).
     */
    public function postsStore(Request $request): RedirectResponse
    {
        abort_unless($request->user()?->canManageContent() === true, 403);

        $validated = $request->validate([
            'type' => ['required', 'string', Rule::in(['article', 'publication', 'project', 'campaign', 'event'])],
            'title' => ['required', 'string', 'max:200'],
            'category' => ['required', 'string', 'max:120'],
            'summary' => ['required', 'string', 'max:1000'],
            'body' => ['nullable', 'string'],
            'featured_image' => ['nullable', 'string', 'max:255'],
            'author_name' => ['nullable', 'string', 'max:120'],
            'status' => ['required', 'string', Rule::in(['draft', 'published'])],
        ]);

        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $counter = 1;
        while (CmsPost::query()->where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        $post = CmsPost::query()->create([
            ...$validated,
            'slug' => $slug,
            'is_visible' => $request->boolean('is_visible', true),
            'featured' => $request->boolean('featured', false),
            'published_at' => $validated['status'] === 'published' ? now() : null,
            'created_by' => $request->user()?->id,
        ]);

        ActivityLog::record(
            'post.created',
            "Created {$post->type} \"{$post->title}\".",
            $post,
            ['type' => $post->type, 'status' => $post->status]
        );

        return back()->with('cms_notice', ucfirst($post->type)." \"{$post->title}\" has been created.");
    }

    /**
     * Hide or unhide a modular content item without deleting it.
     */
    public function postsToggleVisibility(Request $request, CmsPost $cmsPost): RedirectResponse
    {
        abort_unless($request->user()?->canPublish() === true, 403);

        $cmsPost->update([
            'is_visible' => ! $cmsPost->is_visible,
        ]);

        ActivityLog::record(
            $cmsPost->is_visible ? 'post.unhidden' : 'post.hidden',
            "Toggled visibility of {$cmsPost->type} \"{$cmsPost->title}\".",
            $cmsPost,
            ['is_visible' => $cmsPost->is_visible]
        );

        return back()->with('cms_notice', "Visibility updated for \"{$cmsPost->title}\".");
    }

    /**
     * Display the Media Library Manager.
     */
    public function mediaIndex(Request $request): View
    {
        abort_unless($request->user()?->canManageMedia() === true, 403);

        return view('admin.media.index', [
            'mediaItems' => MediaItem::query()->latest()->get(),
        ]);
    }

    /**
     * Register or upload a media item in the Media Library.
     */
    public function mediaStore(Request $request): RedirectResponse
    {
        abort_unless($request->user()?->canManageMedia() === true, 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'category' => ['required', 'string', 'max:80'],
            'alt_text' => ['nullable', 'string', 'max:180'],
            'caption' => ['nullable', 'string', 'max:500'],
            'file_path' => ['nullable', 'string', 'max:255'],
            'file' => ['nullable', 'file', 'max:10240'],
        ]);

        $filePath = $validated['file_path'] ?? '/images/illustrative/hero-solar-microgrid.jpg';
        $mimeType = 'image/jpeg';
        $fileSize = 0;

        if ($request->hasFile('file')) {
            $uploaded = $request->file('file');
            $storedPath = $uploaded->store('cms-media', 'public');
            $filePath = '/storage/'.$storedPath;
            $mimeType = (string) $uploaded->getClientMimeType();
            $fileSize = (int) $uploaded->getSize();
        }

        $media = MediaItem::query()->create([
            'title' => $validated['title'],
            'file_path' => $filePath,
            'disk' => 'public',
            'mime_type' => $mimeType,
            'file_size' => $fileSize,
            'category' => $validated['category'],
            'alt_text' => $validated['alt_text'] ?? $validated['title'],
            'caption' => $validated['caption'] ?? '',
            'is_illustrative' => $request->boolean('is_illustrative'),
            'uploaded_by' => $request->user()?->id,
        ]);

        ActivityLog::record(
            'media.created',
            "Added media asset \"{$media->title}\" to library.",
            $media
        );

        return back()->with('cms_notice', "Media asset \"{$media->title}\" added to library.");
    }

    /**
     * Display contact submissions and newsletter subscribers.
     */
    public function inquiriesIndex(Request $request): View
    {
        abort_unless($request->user()?->is_active === true, 403);

        return view('admin.inquiries.index', [
            'inquiries' => ContactSubmission::query()->latest()->get(),
            'subscribers' => NewsletterSubscriber::query()->latest()->get(),
        ]);
    }

    /**
     * Update the status and notes of a contact submission.
     */
    public function inquiriesUpdateStatus(Request $request, ContactSubmission $submission): RedirectResponse
    {
        abort_unless($request->user()?->canManageContent() === true, 403);

        $validated = $request->validate([
            'status' => ['required', 'string', Rule::in(['new', 'in_review', 'resolved'])],
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $submission->update($validated);

        ActivityLog::record(
            'inquiry.updated',
            "Updated inquiry #{$submission->id} ({$submission->subject}) status to {$submission->status}.",
            $submission
        );

        return back()->with('cms_notice', "Inquiry from {$submission->name} marked as {$submission->status}.");
    }

    /**
     * List CMS users and RBAC roles.
     */
    public function usersIndex(Request $request): View
    {
        abort_unless($request->user()?->canManageUsers() === true, 403);

        return view('admin.users.index', [
            'users' => User::query()->orderBy('name')->get(),
            'roles' => UserRole::cases(),
        ]);
    }

    /**
     * Create a new CMS user with one of the 9 proposal RBAC roles.
     */
    public function usersStore(Request $request): RedirectResponse
    {
        abort_unless($request->user()?->canManageUsers() === true, 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', Rule::enum(UserRole::class)],
        ]);

        $newUser = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        ActivityLog::record(
            'user.created',
            "Created CMS user {$newUser->email} with role {$newUser->roleEnum()->label()}.",
            $newUser
        );

        return back()->with('cms_notice', "User {$newUser->name} ({$newUser->roleEnum()->label()}) created.");
    }

    /**
     * Display the immutable administrative Activity Audit Logs.
     */
    public function activityLogsIndex(Request $request): View
    {
        abort_unless($request->user()?->canManageUsers() === true, 403);

        return view('admin.activity-logs.index', [
            'logs' => ActivityLog::query()->with('user')->latest()->limit(100)->get(),
        ]);
    }
}

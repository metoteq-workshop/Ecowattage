<x-layouts.admin title="CMS Overview Dashboard">
    <!-- KPI Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="p-6 rounded-3xl bg-white border border-eco-border shadow-2xs">
            <span class="text-xs font-heading font-bold uppercase tracking-wider text-eco-green">Public Pages</span>
            <div class="mt-2 text-3xl font-heading font-extrabold text-eco-heading">
                {{ $stats['published_visible_pages'] }} / {{ $stats['total_pages'] }}
            </div>
            <p class="mt-1 text-xs text-eco-body">
                {{ $stats['hidden_or_draft_pages'] }} page(s) currently hidden or draft
            </p>
        </div>

        <div class="p-6 rounded-3xl bg-white border border-eco-border shadow-2xs">
            <span class="text-xs font-heading font-bold uppercase tracking-wider text-eco-green">Modular Content</span>
            <div class="mt-2 text-3xl font-heading font-extrabold text-eco-heading">
                {{ $stats['total_posts'] }}
            </div>
            <p class="mt-1 text-xs text-eco-body">Articles, publications, blueprints &amp; events</p>
        </div>

        <div class="p-6 rounded-3xl bg-white border border-eco-border shadow-2xs">
            <span class="text-xs font-heading font-bold uppercase tracking-wider text-eco-green">Media Assets</span>
            <div class="mt-2 text-3xl font-heading font-extrabold text-eco-heading">
                {{ $stats['media_count'] }}
            </div>
            <p class="mt-1 text-xs text-eco-body">Documentary &amp; brand media files</p>
        </div>

        <div class="p-6 rounded-3xl bg-white border border-eco-border shadow-2xs">
            <span class="text-xs font-heading font-bold uppercase tracking-wider text-eco-green">Inquiries &amp; Subscribers</span>
            <div class="mt-2 text-3xl font-heading font-extrabold text-eco-heading">
                {{ $stats['new_inquiries'] }} New
            </div>
            <p class="mt-1 text-xs text-eco-body">
                {{ $stats['total_inquiries'] }} total inquiries • {{ $stats['subscribers_count'] }} subscribers
            </p>
        </div>
    </div>

    <!-- Quick Page Visibility & Publish Matrix -->
    <div class="bg-white rounded-3xl border border-eco-border p-7 shadow-2xs space-y-5">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-heading font-bold text-eco-heading">
                    Site Pages — Instant Publish / Hide / Unhide Matrix
                </h2>
                <p class="text-xs sm:text-sm text-eco-body">
                    Hiding or drafting any page removes it from public navigation and blocks public access (404) without deleting any page content.
                </p>
            </div>
            <a href="{{ route('admin.pages.index') }}" class="btn-eco-primary !py-2.5 !px-5 text-xs">
                <span>Manage All Pages &amp; SEO</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="border-b border-eco-border text-xs font-heading font-bold uppercase text-eco-body">
                        <th class="py-3 pr-4">Page Title</th>
                        <th class="py-3 px-4">Slug / Route</th>
                        <th class="py-3 px-4">Publish Status</th>
                        <th class="py-3 px-4">Public Visibility</th>
                        <th class="py-3 pl-4 text-right">Quick Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-eco-border/60">
                    @foreach ($pages as $page)
                        <tr>
                            <td class="py-3.5 pr-4 font-heading font-bold text-eco-heading">
                                {{ $page->title }}
                            </td>
                            <td class="py-3.5 px-4 text-xs text-eco-body">
                                /{{ $page->slug === 'home' ? '' : $page->slug }}
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-heading font-bold {{ $page->status === 'published' ? 'bg-eco-mint-soft text-eco-forest' : 'bg-amber-100 text-amber-900' }}">
                                    {{ ucfirst($page->status) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-heading font-bold {{ $page->is_visible ? 'bg-eco-green text-white' : 'bg-red-100 text-red-800' }}">
                                    {{ $page->is_visible ? 'Visible' : 'Hidden' }}
                                </span>
                            </td>
                            <td class="py-3.5 pl-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    @if (auth()->user()?->canPublish())
                                        <form action="{{ route('admin.pages.toggle-visibility', $page) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-3 py-1 rounded-lg border border-eco-border text-xs font-heading font-bold hover:border-eco-green cursor-pointer">
                                                {{ $page->is_visible ? 'Hide Page' : 'Unhide Page' }}
                                            </button>
                                        </form>
                                    @endif
                                    @if (auth()->user()?->canManagePages())
                                        <a href="{{ route('admin.pages.edit', $page) }}" class="px-3 py-1 rounded-lg bg-eco-surface text-xs font-heading font-bold text-eco-heading hover:text-eco-green">
                                            Edit SEO
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Audit Logs & Recent Inquiries -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-3xl border border-eco-border p-7 shadow-2xs space-y-4">
            <h2 class="text-lg font-heading font-bold text-eco-heading">Recent Activity Audit Logs</h2>
            <div class="space-y-3">
                @forelse ($recentLogs as $log)
                    <div class="p-3.5 rounded-2xl bg-eco-surface border border-eco-border/70 text-xs flex items-start justify-between gap-3">
                        <div>
                            <span class="font-heading font-bold text-eco-green uppercase">{{ $log->action }}</span>
                            <p class="mt-0.5 text-eco-heading font-medium">{{ $log->description }}</p>
                            <span class="text-[11px] text-eco-body">{{ $log->user?->name ?? 'System' }}</span>
                        </div>
                        <span class="text-[11px] text-eco-body shrink-0">{{ $log->created_at?->diffForHumans() }}</span>
                    </div>
                @empty
                    <p class="text-xs text-eco-body">No administrative actions logged yet.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-eco-border p-7 shadow-2xs space-y-4">
            <h2 class="text-lg font-heading font-bold text-eco-heading">Recent Contact Submissions</h2>
            <div class="space-y-3">
                @forelse ($recentInquiries as $inq)
                    <div class="p-3.5 rounded-2xl bg-eco-surface border border-eco-border/70 text-xs space-y-1">
                        <div class="flex items-center justify-between gap-2">
                            <span class="font-heading font-bold text-eco-heading">{{ $inq->subject }}</span>
                            <span class="px-2 py-0.5 rounded-full bg-eco-mint-soft text-eco-forest font-heading font-bold">{{ $inq->status }}</span>
                        </div>
                        <p class="text-eco-body">{{ $inq->name }} ({{ $inq->email }}) — {{ $inq->inquiry_type }}</p>
                    </div>
                @empty
                    <p class="text-xs text-eco-body">No contact inquiries submitted yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.admin>

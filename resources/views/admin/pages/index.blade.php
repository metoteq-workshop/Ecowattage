<x-layouts.admin title="Pages, Visibility & SEO Manager">
    <div class="bg-white rounded-3xl border border-eco-border p-7 shadow-2xs space-y-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-heading font-bold text-eco-heading">
                    Non-Destructive Page Publish, Hide &amp; Unhide Controls
                </h2>
                <p class="text-xs sm:text-sm text-eco-body">
                    Manage all 10 core pages and custom pages. Hiding a page removes it from header/footer menus and blocks public access while keeping all content intact.
                </p>
            </div>
            <a href="{{ route('admin.pages.create') }}" class="btn-eco-primary !py-2.5 !px-5 text-xs">
                <span>+ Create Custom Page</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="border-b border-eco-border text-xs font-heading font-bold uppercase text-eco-body">
                        <th class="py-3 pr-4">Order</th>
                        <th class="py-3 px-4">Title &amp; SEO</th>
                        <th class="py-3 px-4">Nav Group</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Visibility</th>
                        <th class="py-3 pl-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-eco-border/60">
                    @foreach ($pages as $page)
                        <tr>
                            <td class="py-4 pr-4 font-heading font-bold text-eco-body">
                                #{{ $page->nav_order }}
                            </td>
                            <td class="py-4 px-4">
                                <div class="font-heading font-bold text-eco-heading">{{ $page->title }}</div>
                                <div class="text-xs text-eco-body">SEO: {{ $page->meta_title ?: 'Default' }}</div>
                            </td>
                            <td class="py-4 px-4 text-xs font-heading font-semibold uppercase text-eco-forest">
                                {{ $page->nav_group }}
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-heading font-bold {{ $page->status === 'published' ? 'bg-eco-mint-soft text-eco-forest' : 'bg-amber-100 text-amber-900' }}">
                                    {{ ucfirst($page->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-heading font-bold {{ $page->is_visible ? 'bg-eco-green text-white' : 'bg-red-100 text-red-800' }}">
                                    {{ $page->is_visible ? 'Publicly Visible' : 'Hidden from Public' }}
                                </span>
                            </td>
                            <td class="py-4 pl-4 text-right">
                                <div class="inline-flex flex-wrap items-center justify-end gap-2">
                                    <form action="{{ route('admin.pages.toggle-status', $page) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-3 py-1.5 rounded-xl border border-eco-border text-xs font-heading font-bold hover:border-eco-green cursor-pointer">
                                            {{ $page->status === 'published' ? 'Set Draft' : 'Publish' }}
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.pages.toggle-visibility', $page) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-3 py-1.5 rounded-xl border border-eco-border text-xs font-heading font-bold hover:border-eco-green cursor-pointer">
                                            {{ $page->is_visible ? 'Hide' : 'Unhide' }}
                                        </button>
                                    </form>

                                    <a
                                        href="{{ $page->route_name ? route($page->route_name, ['preview' => 1]) : route('pages.custom', ['slug' => $page->slug, 'preview' => 1]) }}"
                                        target="_blank"
                                        class="px-3 py-1.5 rounded-xl bg-eco-surface text-xs font-heading font-bold text-eco-forest hover:text-eco-green"
                                    >
                                        Preview
                                    </a>

                                    <a
                                        href="{{ route('admin.pages.edit', $page) }}"
                                        class="px-3 py-1.5 rounded-xl bg-eco-green text-white text-xs font-heading font-bold hover:bg-eco-forest"
                                    >
                                        Edit Page &amp; SEO
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>

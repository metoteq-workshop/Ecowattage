<x-layouts.admin :title="$isEdit ? 'Edit Page & SEO: ' . $cmsPage->title : 'Create Custom CMS Page'">
    <div class="bg-white rounded-3xl border border-eco-border p-7 sm:p-9 shadow-2xs max-w-4xl">
        <form
            action="{{ $isEdit ? route('admin.pages.update', $cmsPage) : route('admin.pages.store') }}"
            method="POST"
            class="space-y-6"
        >
            @csrf
            @if ($isEdit)
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="page-title" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                        Page Title *
                    </label>
                    <input
                        id="page-title"
                        type="text"
                        name="title"
                        value="{{ old('title', $cmsPage->title) }}"
                        required
                        class="w-full px-4 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm"
                    >
                </div>

                <div>
                    <label for="page-slug" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                        Slug
                    </label>
                    <input
                        id="page-slug"
                        type="text"
                        name="slug"
                        value="{{ old('slug', $cmsPage->slug) }}"
                        placeholder="auto-generated-from-title"
                        class="w-full px-4 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm"
                    >
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-5">
                <div>
                    <label for="page-status" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                        Publish Status
                    </label>
                    <select id="page-status" name="status" class="w-full px-4 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm">
                        <option value="published" @selected(old('status', $cmsPage->status) === 'published')>Published</option>
                        <option value="draft" @selected(old('status', $cmsPage->status) === 'draft')>Draft</option>
                    </select>
                </div>

                <div>
                    <label for="page-nav-group" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                        Navigation Group
                    </label>
                    <select id="page-nav-group" name="nav_group" class="w-full px-4 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm">
                        <option value="root" @selected(old('nav_group', $cmsPage->nav_group) === 'root')>Top-Level Menu</option>
                        <option value="initiatives" @selected(old('nav_group', $cmsPage->nav_group) === 'initiatives')>Initiatives Dropdown</option>
                        <option value="resources" @selected(old('nav_group', $cmsPage->nav_group) === 'resources')>Resources Dropdown</option>
                        <option value="none" @selected(old('nav_group', $cmsPage->nav_group) === 'none')>Unlisted</option>
                    </select>
                </div>

                <div>
                    <label for="page-nav-label" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                        Menu Label
                    </label>
                    <input
                        id="page-nav-label"
                        type="text"
                        name="nav_label"
                        value="{{ old('nav_label', $cmsPage->nav_label) }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm"
                    >
                </div>

                <div>
                    <label for="page-nav-order" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                        Menu Order
                    </label>
                    <input
                        id="page-nav-order"
                        type="number"
                        name="nav_order"
                        value="{{ old('nav_order', $cmsPage->nav_order) }}"
                        required
                        class="w-full px-4 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm"
                    >
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-6 p-4 rounded-2xl bg-eco-surface border border-eco-border text-xs font-heading font-bold text-eco-heading">
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_visible" value="1" @checked(old('is_visible', $cmsPage->is_visible))>
                    <span>Publicly Visible (Uncheck to hide without deleting)</span>
                </label>

                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="show_in_header_nav" value="1" @checked(old('show_in_header_nav', $cmsPage->show_in_header_nav))>
                    <span>Show in Header Navigation</span>
                </label>

                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="show_in_footer_nav" value="1" @checked(old('show_in_footer_nav', $cmsPage->show_in_footer_nav))>
                    <span>Show in Footer Navigation</span>
                </label>
            </div>

            <div>
                <label for="page-summary" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                    Summary / Lead Excerpt
                </label>
                <textarea
                    id="page-summary"
                    name="summary"
                    rows="2"
                    class="w-full px-4 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm"
                >{{ old('summary', $cmsPage->summary) }}</textarea>
            </div>

            <div>
                <label for="page-content" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                    Page Body Content
                </label>
                <textarea
                    id="page-content"
                    name="content"
                    rows="5"
                    class="w-full px-4 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm"
                >{{ old('content', $cmsPage->content) }}</textarea>
            </div>

            <div class="pt-4 border-t border-eco-border space-y-4">
                <h3 class="text-base font-heading font-bold text-eco-heading">SEO &amp; Search Indexing Settings</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="page-meta-title" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                            SEO Meta Title
                        </label>
                        <input
                            id="page-meta-title"
                            type="text"
                            name="meta_title"
                            value="{{ old('meta_title', $cmsPage->meta_title) }}"
                            class="w-full px-4 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm"
                        >
                    </div>

                    <div>
                        <label for="page-robots" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                            Robots Directive
                        </label>
                        <input
                            id="page-robots"
                            type="text"
                            name="robots"
                            value="{{ old('robots', $cmsPage->robots) }}"
                            required
                            class="w-full px-4 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm"
                        >
                    </div>
                </div>

                <div>
                    <label for="page-meta-description" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                        SEO Meta Description
                    </label>
                    <textarea
                        id="page-meta-description"
                        name="meta_description"
                        rows="2"
                        class="w-full px-4 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm"
                    >{{ old('meta_description', $cmsPage->meta_description) }}</textarea>
                </div>
            </div>

            <div class="pt-4 flex items-center gap-3">
                <button type="submit" class="btn-eco-primary !py-2.5 !px-6 text-xs cursor-pointer">
                    <span>{{ $isEdit ? 'Save Page & SEO Changes' : 'Create CMS Page' }}</span>
                </button>
                <a href="{{ route('admin.pages.index') }}" class="px-5 py-2.5 rounded-full border border-eco-border text-xs font-heading font-bold text-eco-heading">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts.admin>

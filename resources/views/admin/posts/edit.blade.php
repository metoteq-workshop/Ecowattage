<x-layouts.admin :title="'Edit Content: ' . $post->title">
    <div class="max-w-4xl space-y-6">
        <div class="flex flex-wrap items-center justify-between gap-4 bg-white rounded-3xl border border-eco-border p-5 shadow-2xs">
            <a
                href="{{ route('admin.posts.show', $post) }}"
                class="inline-flex items-center gap-2 text-xs font-heading font-bold text-eco-heading hover:text-eco-green transition"
            >
                <span>&larr; Back to Content View</span>
            </a>

            <form
                action="{{ route('admin.posts.destroy', $post) }}"
                method="POST"
                onsubmit="return confirm('Are you sure you want to permanently delete this content item?');"
            >
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 rounded-xl bg-red-50 border border-red-200 text-xs font-heading font-bold text-red-700 hover:bg-red-600 hover:text-white transition cursor-pointer">
                    Delete This Content Item
                </button>
            </form>
        </div>

        <div class="bg-white rounded-3xl border border-eco-border p-7 sm:p-9 shadow-2xs">
            <form action="{{ route('admin.posts.update', $post) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label for="post-type" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                            Module Type *
                        </label>
                        <select id="post-type" name="type" required class="w-full px-4 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm">
                            <option value="article" @selected(old('type', $post->type) === 'article')>Blog / News Article</option>
                            <option value="publication" @selected(old('type', $post->type) === 'publication')>Publication / White Paper</option>
                            <option value="project" @selected(old('type', $post->type) === 'project')>Project Blueprint</option>
                            <option value="campaign" @selected(old('type', $post->type) === 'campaign')>Advocacy Campaign</option>
                            <option value="event" @selected(old('type', $post->type) === 'event')>Event / Workshop</option>
                        </select>
                    </div>

                    <div>
                        <label for="post-status" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                            Publish Status *
                        </label>
                        <select id="post-status" name="status" required class="w-full px-4 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm">
                            <option value="published" @selected(old('status', $post->status) === 'published')>Published</option>
                            <option value="draft" @selected(old('status', $post->status) === 'draft')>Draft</option>
                        </select>
                    </div>

                    <div>
                        <label for="post-category" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                            Category *
                        </label>
                        <input
                            id="post-category"
                            type="text"
                            name="category"
                            value="{{ old('category', $post->category) }}"
                            required
                            class="w-full px-4 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm"
                        >
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="post-title" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                            Title *
                        </label>
                        <input
                            id="post-title"
                            type="text"
                            name="title"
                            value="{{ old('title', $post->title) }}"
                            required
                            class="w-full px-4 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm"
                        >
                    </div>

                    <div>
                        <label for="post-slug" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                            Slug *
                        </label>
                        <input
                            id="post-slug"
                            type="text"
                            name="slug"
                            value="{{ old('slug', $post->slug) }}"
                            required
                            class="w-full px-4 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm"
                        >
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="post-author" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                            Author / Coordination Desk
                        </label>
                        <input
                            id="post-author"
                            type="text"
                            name="author_name"
                            value="{{ old('author_name', $post->author_name) }}"
                            class="w-full px-4 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm"
                        >
                    </div>

                    <div>
                        <label for="post-image" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                            Featured Image Path
                        </label>
                        <input
                            id="post-image"
                            type="text"
                            name="featured_image"
                            value="{{ old('featured_image', $post->featured_image) }}"
                            placeholder="/images/illustrative/hero-solar-microgrid.jpg"
                            class="w-full px-4 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm"
                        >
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-6 p-4 rounded-2xl bg-eco-surface border border-eco-border text-xs font-heading font-bold text-eco-heading">
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_visible" value="1" @checked(old('is_visible', $post->is_visible))>
                        <span>Publicly Visible</span>
                    </label>

                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="featured" value="1" @checked(old('featured', $post->featured))>
                        <span>Featured Spotlight Entry</span>
                    </label>
                </div>

                <div>
                    <label for="post-summary" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                        Summary / Excerpt *
                    </label>
                    <textarea
                        id="post-summary"
                        name="summary"
                        rows="3"
                        required
                        class="w-full px-4 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm"
                    >{{ old('summary', $post->summary) }}</textarea>
                </div>

                <div>
                    <label for="post-body" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-1.5">
                        Full Body / Objectives / Findings
                    </label>
                    <textarea
                        id="post-body"
                        name="body"
                        rows="7"
                        class="w-full px-4 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm"
                    >{{ old('body', $post->body) }}</textarea>
                </div>

                <div class="pt-4 flex items-center gap-3">
                    <button type="submit" class="btn-eco-primary !py-2.5 !px-6 text-xs cursor-pointer">
                        <span>Save Content Changes</span>
                    </button>
                    <a
                        href="{{ route('admin.posts.show', $post) }}"
                        class="px-5 py-2.5 rounded-full border border-eco-border text-xs font-heading font-bold text-eco-heading"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>

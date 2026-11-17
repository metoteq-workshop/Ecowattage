<x-layouts.admin title="Modular Content Manager">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Create Content Item Form -->
        <div class="lg:col-span-5 bg-white rounded-3xl border border-eco-border p-7 shadow-2xs space-y-5">
            <h2 class="text-lg font-heading font-bold text-eco-heading">Create Modular Content Entry</h2>
            <form action="{{ route('admin.posts.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-heading font-bold uppercase text-eco-heading mb-1">Module Type *</label>
                        <select name="type" required class="w-full px-3.5 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-xs">
                            <option value="article">Blog / News Article</option>
                            <option value="publication">Publication / White Paper</option>
                            <option value="project">Project Blueprint</option>
                            <option value="campaign">Advocacy Campaign</option>
                            <option value="event">Event / Workshop</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-heading font-bold uppercase text-eco-heading mb-1">Status *</label>
                        <select name="status" required class="w-full px-3.5 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-xs">
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-heading font-bold uppercase text-eco-heading mb-1">Title *</label>
                    <input type="text" name="title" required class="w-full px-3.5 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-heading font-bold uppercase text-eco-heading mb-1">Category *</label>
                        <input type="text" name="category" required placeholder="e.g. Solar Microgrid" class="w-full px-3.5 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-heading font-bold uppercase text-eco-heading mb-1">Author / Desk</label>
                        <input type="text" name="author_name" value="Ecowattage Editorial Team" class="w-full px-3.5 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-xs">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-heading font-bold uppercase text-eco-heading mb-1">Featured Image Path</label>
                    <input type="text" name="featured_image" placeholder="/images/illustrative/hero-solar-microgrid.jpg" class="w-full px-3.5 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-xs">
                </div>

                <div>
                    <label class="block text-xs font-heading font-bold uppercase text-eco-heading mb-1">Summary / Excerpt *</label>
                    <textarea name="summary" rows="3" required class="w-full px-3.5 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-xs"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-heading font-bold uppercase text-eco-heading mb-1">Body / Objectives / Findings</label>
                    <textarea name="body" rows="4" placeholder="Enter paragraphs or one objective/finding per line..." class="w-full px-3.5 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-xs"></textarea>
                </div>

                <div class="flex items-center gap-4 text-xs font-heading font-bold text-eco-heading">
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" name="is_visible" value="1" checked>
                        <span>Publicly Visible</span>
                    </label>
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" name="featured" value="1">
                        <span>Featured</span>
                    </label>
                </div>

                <button type="submit" class="btn-eco-primary w-full justify-center !py-2.5 text-xs cursor-pointer">
                    <span>Publish Content Item</span>
                </button>
            </form>
        </div>

        <!-- Existing Content Items -->
        <div class="lg:col-span-7 bg-white rounded-3xl border border-eco-border p-7 shadow-2xs space-y-5">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-lg font-heading font-bold text-eco-heading">Managed Entries ({{ $posts->count() }})</h2>
                <div class="flex flex-wrap gap-1.5 text-xs font-heading font-bold">
                    <a href="{{ route('admin.posts.index') }}" class="px-3 py-1 rounded-full {{ $activeType === '' ? 'bg-eco-green text-white' : 'bg-eco-surface text-eco-heading' }}">All</a>
                    @foreach (['article' => 'Articles', 'publication' => 'Publications', 'project' => 'Projects', 'campaign' => 'Campaigns', 'event' => 'Events'] as $typeKey => $typeLabel)
                        <a href="{{ route('admin.posts.index', ['type' => $typeKey]) }}" class="px-3 py-1 rounded-full {{ $activeType === $typeKey ? 'bg-eco-green text-white' : 'bg-eco-surface text-eco-heading' }}">
                            {{ $typeLabel }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="space-y-3.5">
                @forelse ($posts as $post)
                    <div class="p-4 sm:p-5 rounded-2xl bg-eco-surface border border-eco-border/70 flex flex-col gap-3.5">
                        <div class="flex items-start justify-between gap-4">
                            <div class="space-y-1 min-w-0">
                                <div class="flex flex-wrap items-center gap-2 text-[11px] font-heading font-bold">
                                    <span class="px-2 py-0.5 rounded bg-eco-forest text-eco-mint uppercase">{{ $post->type }}</span>
                                    <span class="text-eco-green">{{ $post->category }}</span>
                                    <span class="px-2 py-0.5 rounded-full {{ $post->status === 'published' ? 'bg-eco-mint-soft text-eco-forest' : 'bg-amber-100 text-amber-900' }}">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                    <span class="{{ $post->is_visible ? 'text-eco-forest' : 'text-red-700' }}">
                                        • {{ $post->is_visible ? 'Visible' : 'Hidden' }}
                                    </span>
                                </div>

                                <h3 class="text-sm sm:text-base font-heading font-bold text-eco-heading leading-snug">
                                    <a href="{{ route('admin.posts.show', $post) }}" class="hover:text-eco-green transition">
                                        {{ $post->title }}
                                    </a>
                                </h3>

                                @if ($post->summary)
                                    <p class="text-xs text-eco-body line-clamp-2 leading-relaxed">
                                        {{ $post->summary }}
                                    </p>
                                @endif
                            </div>

                            @if ($post->featured_image)
                                <img
                                    src="{{ asset($post->featured_image) }}"
                                    alt="{{ $post->title }}"
                                    class="w-16 h-16 rounded-xl object-cover shrink-0 border border-eco-border hidden sm:block"
                                >
                            @endif
                        </div>

                        <!-- Action Bar: View, Edit, Hide/Unhide, Delete -->
                        <div class="pt-3 border-t border-eco-border/60 flex flex-wrap items-center justify-between gap-2">
                            <span class="text-[11px] text-eco-body">
                                {{ $post->author_name ?: 'Ecowattage Editorial Desk' }} • /{{ $post->slug }}
                            </span>

                            <div class="inline-flex flex-wrap items-center gap-2">
                                <a
                                    href="{{ route('admin.posts.show', $post) }}"
                                    class="px-3 py-1.5 rounded-xl bg-white border border-eco-border text-xs font-heading font-bold text-eco-heading hover:border-eco-green hover:text-eco-green transition"
                                >
                                    View
                                </a>

                                <a
                                    href="{{ route('admin.posts.edit', $post) }}"
                                    class="px-3 py-1.5 rounded-xl bg-eco-green text-white text-xs font-heading font-bold hover:bg-eco-forest transition"
                                >
                                    Edit
                                </a>

                                @if (auth()->user()?->canPublish())
                                    <form action="{{ route('admin.posts.toggle-visibility', $post) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-3 py-1.5 rounded-xl bg-white border border-eco-border text-xs font-heading font-bold text-eco-heading hover:border-eco-green cursor-pointer">
                                            {{ $post->is_visible ? 'Hide' : 'Unhide' }}
                                        </button>
                                    </form>
                                @endif

                                <form
                                    action="{{ route('admin.posts.destroy', $post) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this content item?');"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 rounded-xl bg-red-50 border border-red-200 text-xs font-heading font-bold text-red-700 hover:bg-red-600 hover:text-white transition cursor-pointer">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-eco-body py-6 text-center">No content items found for this filter.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.admin>

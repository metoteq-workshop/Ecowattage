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
                    <label class="block text-xs font-heading font-bold uppercase text-eco-heading mb-1">Summary / Excerpt *</label>
                    <textarea name="summary" rows="3" required class="w-full px-3.5 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-xs"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-heading font-bold uppercase text-eco-heading mb-1">Body / Technical Details</label>
                    <textarea name="body" rows="4" class="w-full px-3.5 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-xs"></textarea>
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

            <div class="space-y-3">
                @foreach ($posts as $post)
                    <div class="p-4 rounded-2xl bg-eco-surface border border-eco-border/70 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="space-y-1">
                            <div class="flex flex-wrap items-center gap-2 text-[11px] font-heading font-bold">
                                <span class="px-2 py-0.5 rounded bg-eco-forest text-eco-mint uppercase">{{ $post->type }}</span>
                                <span class="text-eco-green">{{ $post->category }}</span>
                                <span class="{{ $post->is_visible ? 'text-eco-forest' : 'text-red-700' }}">• {{ $post->is_visible ? 'Visible' : 'Hidden' }}</span>
                            </div>
                            <h3 class="text-sm font-heading font-bold text-eco-heading">{{ $post->title }}</h3>
                        </div>

                        <form action="{{ route('admin.posts.toggle-visibility', $post) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="px-3 py-1.5 rounded-xl bg-white border border-eco-border text-xs font-heading font-bold hover:border-eco-green cursor-pointer shrink-0">
                                {{ $post->is_visible ? 'Hide' : 'Unhide' }}
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.admin>

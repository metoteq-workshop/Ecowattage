<x-layouts.admin :title="'View Content: ' . $post->title">
    <div class="max-w-4xl space-y-6">
        <!-- Top Action Bar -->
        <div class="flex flex-wrap items-center justify-between gap-4 bg-white rounded-3xl border border-eco-border p-5 shadow-2xs">
            <a
                href="{{ route('admin.posts.index', ['type' => $post->type]) }}"
                class="inline-flex items-center gap-2 text-xs font-heading font-bold text-eco-heading hover:text-eco-green transition"
            >
                <span>&larr; Back to Content Modules</span>
            </a>

            <div class="flex flex-wrap items-center gap-2.5">
                <a
                    href="{{ $post->publicUrl() }}"
                    target="_blank"
                    class="px-4 py-2 rounded-xl bg-eco-surface border border-eco-border text-xs font-heading font-bold text-eco-forest hover:border-eco-green transition"
                >
                    View on Live Website &nearr;
                </a>

                <a
                    href="{{ route('admin.posts.edit', $post) }}"
                    class="px-4 py-2 rounded-xl bg-eco-green text-white text-xs font-heading font-bold hover:bg-eco-forest transition"
                >
                    Edit Content
                </a>

                @if (auth()->user()?->canPublish())
                    <form action="{{ route('admin.posts.toggle-visibility', $post) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="px-4 py-2 rounded-xl bg-white border border-eco-border text-xs font-heading font-bold text-eco-heading hover:border-eco-green cursor-pointer">
                            {{ $post->is_visible ? 'Hide from Public' : 'Unhide on Public Site' }}
                        </button>
                    </form>
                @endif

                <form
                    action="{{ route('admin.posts.destroy', $post) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to permanently delete this content item?');"
                >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 rounded-xl bg-red-50 border border-red-200 text-xs font-heading font-bold text-red-700 hover:bg-red-600 hover:text-white transition cursor-pointer">
                        Delete Content
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white rounded-3xl border border-eco-border overflow-hidden shadow-2xs">
            @if ($post->featured_image)
                <div class="aspect-[16/7] bg-eco-forest/10 overflow-hidden border-b border-eco-border">
                    <img
                        src="{{ asset($post->featured_image) }}"
                        alt="{{ $post->title }}"
                        class="w-full h-full object-cover"
                    >
                </div>
            @endif

            <div class="p-7 sm:p-9 space-y-6">
                <div class="flex flex-wrap items-center gap-2.5 text-xs font-heading font-bold">
                    <span class="px-3 py-1 rounded-full bg-eco-forest text-eco-mint uppercase">
                        {{ $post->type }}
                    </span>
                    <span class="px-3 py-1 rounded-full bg-eco-mint-soft text-eco-forest">
                        {{ $post->category }}
                    </span>
                    <span class="px-3 py-1 rounded-full {{ $post->status === 'published' ? 'bg-eco-green text-white' : 'bg-amber-100 text-amber-900' }}">
                        {{ ucfirst($post->status) }}
                    </span>
                    <span class="px-3 py-1 rounded-full {{ $post->is_visible ? 'bg-eco-surface text-eco-forest border border-eco-border' : 'bg-red-100 text-red-800' }}">
                        {{ $post->is_visible ? 'Publicly Visible' : 'Hidden from Public' }}
                    </span>
                    @if ($post->featured)
                        <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-900">
                            Featured
                        </span>
                    @endif
                </div>

                <div>
                    <h2 class="text-2xl sm:text-3xl font-heading font-bold text-eco-heading leading-tight">
                        {{ $post->title }}
                    </h2>
                    <div class="mt-2 flex flex-wrap items-center gap-3 text-xs text-eco-body">
                        <span><strong>Slug:</strong> {{ $post->slug }}</span>
                        <span>•</span>
                        <span><strong>Author / Desk:</strong> {{ $post->author_name ?: 'Ecowattage Editorial Desk' }}</span>
                        <span>•</span>
                        <span><strong>Updated:</strong> {{ $post->updated_at?->format('Y-m-d H:i') }}</span>
                    </div>
                </div>

                @if ($post->summary)
                    <div class="p-5 rounded-2xl bg-eco-surface border border-eco-border space-y-1.5">
                        <span class="text-[11px] font-heading font-bold uppercase tracking-wider text-eco-green block">
                            Summary / Excerpt
                        </span>
                        <p class="text-sm sm:text-base text-eco-heading font-medium leading-relaxed">
                            {{ $post->summary }}
                        </p>
                    </div>
                @endif

                <div class="space-y-3">
                    <span class="text-xs font-heading font-bold uppercase tracking-wider text-eco-green block">
                        Full Body / Objectives / Findings
                    </span>
                    @if ($post->body)
                        <div class="prose max-w-none text-sm sm:text-base text-eco-body leading-relaxed space-y-3">
                            {!! nl2br(e($post->body)) !!}
                        </div>
                    @else
                        <p class="text-xs text-eco-body italic">No extended body text provided.</p>
                    @endif
                </div>

                @if (! empty($post->meta_json) && is_array($post->meta_json))
                    <div class="pt-5 border-t border-eco-border space-y-3">
                        <span class="text-xs font-heading font-bold uppercase tracking-wider text-eco-green block">
                            Module Metadata Attributes
                        </span>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                            @foreach ($post->meta_json as $metaKey => $metaVal)
                                <div class="p-3.5 rounded-xl bg-eco-surface border border-eco-border/70">
                                    <span class="font-heading font-bold uppercase text-eco-heading block mb-1">
                                        {{ str_replace('_', ' ', (string) $metaKey) }}
                                    </span>
                                    <span class="text-eco-body">
                                        {{ is_array($metaVal) ? implode(', ', $metaVal) : (string) $metaVal }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.admin>

<x-layouts.admin title="Media Library Manager">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <div class="lg:col-span-4 bg-white rounded-3xl border border-eco-border p-7 shadow-2xs space-y-4">
            <h2 class="text-lg font-heading font-bold text-eco-heading">Add / Upload Media Asset</h2>
            <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-heading font-bold uppercase text-eco-heading mb-1">Asset Title *</label>
                    <input type="text" name="title" required class="w-full px-3.5 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm">
                </div>
                <div>
                    <label class="block text-xs font-heading font-bold uppercase text-eco-heading mb-1">Category *</label>
                    <input type="text" name="category" required value="Field Engineering" class="w-full px-3.5 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-xs">
                </div>
                <div>
                    <label class="block text-xs font-heading font-bold uppercase text-eco-heading mb-1">Upload File (Optional)</label>
                    <input type="file" name="file" class="w-full text-xs text-eco-body">
                </div>
                <div>
                    <label class="block text-xs font-heading font-bold uppercase text-eco-heading mb-1">Or Asset Path</label>
                    <input type="text" name="file_path" placeholder="/images/illustrative/..." class="w-full px-3.5 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-xs">
                </div>
                <div>
                    <label class="block text-xs font-heading font-bold uppercase text-eco-heading mb-1">Alt Text &amp; Caption</label>
                    <input type="text" name="caption" placeholder="Documentary caption..." class="w-full px-3.5 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-xs">
                </div>
                <label class="inline-flex items-center gap-2 text-xs font-heading font-bold text-eco-heading">
                    <input type="checkbox" name="is_illustrative" value="1" checked>
                    <span>Mark as Illustrative Photography</span>
                </label>
                <button type="submit" class="btn-eco-primary w-full justify-center !py-2.5 text-xs cursor-pointer">
                    <span>Save Media Asset</span>
                </button>
            </form>
        </div>

        <div class="lg:col-span-8 bg-white rounded-3xl border border-eco-border p-7 shadow-2xs space-y-5">
            <h2 class="text-lg font-heading font-bold text-eco-heading">Registered Media Library ({{ $mediaItems->count() }})</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($mediaItems as $item)
                    <div class="rounded-2xl border border-eco-border overflow-hidden bg-eco-surface flex flex-col justify-between">
                        <div class="aspect-[16/10] bg-eco-forest/10 overflow-hidden">
                            <img src="{{ asset($item->file_path) }}" alt="{{ $item->alt_text }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4 space-y-1">
                            <span class="text-[10px] font-heading font-bold uppercase text-eco-green">{{ $item->category }}</span>
                            <h3 class="text-xs font-heading font-bold text-eco-heading">{{ $item->title }}</h3>
                            <p class="text-[11px] text-eco-body truncate">{{ $item->file_path }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.admin>

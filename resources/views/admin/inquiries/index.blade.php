<x-layouts.admin title="Inquiries & Newsletter Subscribers">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <div class="lg:col-span-8 bg-white rounded-3xl border border-eco-border p-7 shadow-2xs space-y-5">
            <h2 class="text-lg font-heading font-bold text-eco-heading">Contact &amp; Project Inquiries ({{ $inquiries->count() }})</h2>
            <div class="space-y-4">
                @forelse ($inquiries as $inq)
                    <div class="p-5 rounded-2xl bg-eco-surface border border-eco-border/80 space-y-3">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <div>
                                <span class="text-xs font-heading font-bold uppercase text-eco-green">{{ $inq->inquiry_type }}</span>
                                <h3 class="text-base font-heading font-bold text-eco-heading">{{ $inq->subject }}</h3>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-eco-mint-soft text-eco-forest text-xs font-heading font-bold uppercase">
                                {{ $inq->status }}
                            </span>
                        </div>
                        <p class="text-xs text-eco-body">
                            <strong>From:</strong> {{ $inq->name }} ({{ $inq->email }}) {{ $inq->organization ? '• ' . $inq->organization : '' }}
                        </p>
                        <p class="text-xs sm:text-sm text-eco-charcoal leading-relaxed">{{ $inq->message }}</p>

                        @if (auth()->user()?->canManageContent())
                            <form action="{{ route('admin.inquiries.status', $inq) }}" method="POST" class="pt-2 flex flex-wrap items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="px-3 py-1.5 rounded-xl bg-white border border-eco-border text-xs font-heading font-bold">
                                    <option value="new" @selected($inq->status === 'new')>New</option>
                                    <option value="in_review" @selected($inq->status === 'in_review')>In Review</option>
                                    <option value="resolved" @selected($inq->status === 'resolved')>Resolved</option>
                                </select>
                                <input type="text" name="admin_notes" value="{{ $inq->admin_notes }}" placeholder="Internal coordination note..." class="flex-1 px-3 py-1.5 rounded-xl bg-white border border-eco-border text-xs">
                                <button type="submit" class="px-3.5 py-1.5 rounded-xl bg-eco-green text-white text-xs font-heading font-bold cursor-pointer">
                                    Update
                                </button>
                            </form>
                        @endif
                    </div>
                @empty
                    <p class="text-xs text-eco-body">No contact inquiries recorded yet.</p>
                @endforelse
            </div>
        </div>

        <div class="lg:col-span-4 bg-white rounded-3xl border border-eco-border p-7 shadow-2xs space-y-4">
            <h2 class="text-lg font-heading font-bold text-eco-heading">Newsletter Subscribers ({{ $subscribers->count() }})</h2>
            <div class="space-y-2.5">
                @forelse ($subscribers as $sub)
                    <div class="p-3.5 rounded-xl bg-eco-surface border border-eco-border/70 flex items-center justify-between text-xs">
                        <span class="font-medium text-eco-heading">{{ $sub->email }}</span>
                        <span class="px-2 py-0.5 rounded bg-eco-mint-soft text-eco-forest font-heading font-bold">{{ $sub->status }}</span>
                    </div>
                @empty
                    <p class="text-xs text-eco-body">No newsletter subscribers yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.admin>

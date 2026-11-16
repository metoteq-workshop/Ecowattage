<x-layouts.admin title="Immutable Activity Audit Logs">
    <div class="bg-white rounded-3xl border border-eco-border p-7 shadow-2xs space-y-5">
        <div>
            <h2 class="text-xl font-heading font-bold text-eco-heading">Administrative Security &amp; Content Audit Trail</h2>
            <p class="text-xs sm:text-sm text-eco-body">
                Every page visibility change, publish/draft toggle, login, and content update is permanently recorded below.
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="border-b border-eco-border text-xs font-heading font-bold uppercase text-eco-body">
                        <th class="py-3 pr-4">Timestamp</th>
                        <th class="py-3 px-4">Actor</th>
                        <th class="py-3 px-4">Action</th>
                        <th class="py-3 px-4">Description</th>
                        <th class="py-3 pl-4">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-eco-border/60 text-xs">
                    @forelse ($logs as $log)
                        <tr>
                            <td class="py-3.5 pr-4 text-eco-body whitespace-nowrap">
                                {{ $log->created_at?->format('Y-m-d H:i:s') }}
                            </td>
                            <td class="py-3.5 px-4 font-heading font-bold text-eco-heading">
                                {{ $log->user?->name ?? 'System' }}
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2.5 py-0.5 rounded-full bg-eco-mint-soft text-eco-forest font-heading font-bold uppercase">
                                    {{ $log->action }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-eco-charcoal">
                                {{ $log->description }}
                            </td>
                            <td class="py-3.5 pl-4 text-eco-body">
                                {{ $log->ip_address ?? '127.0.0.1' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 text-center text-eco-body">No activity logs recorded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>

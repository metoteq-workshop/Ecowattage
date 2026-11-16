<x-layouts.admin title="Users & RBAC Role Management">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <div class="lg:col-span-5 bg-white rounded-3xl border border-eco-border p-7 shadow-2xs space-y-4">
            <h2 class="text-lg font-heading font-bold text-eco-heading">Create Staff / Role Account</h2>
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-heading font-bold uppercase text-eco-heading mb-1">Full Name *</label>
                    <input type="text" name="name" required class="w-full px-3.5 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm">
                </div>
                <div>
                    <label class="block text-xs font-heading font-bold uppercase text-eco-heading mb-1">Email Address *</label>
                    <input type="email" name="email" required class="w-full px-3.5 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm">
                </div>
                <div>
                    <label class="block text-xs font-heading font-bold uppercase text-eco-heading mb-1">Assign Proposal Role *</label>
                    <select name="role" required class="w-full px-3.5 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-xs font-heading font-bold">
                        @foreach ($roles as $roleCase)
                            <option value="{{ $roleCase->value }}">{{ $roleCase->label() }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-heading font-bold uppercase text-eco-heading mb-1">Initial Password *</label>
                    <input type="password" name="password" required minlength="8" class="w-full px-3.5 py-2.5 rounded-xl bg-eco-surface border border-eco-border text-sm">
                </div>
                <button type="submit" class="btn-eco-primary w-full justify-center !py-2.5 text-xs cursor-pointer">
                    <span>Create User Account</span>
                </button>
            </form>
        </div>

        <div class="lg:col-span-7 bg-white rounded-3xl border border-eco-border p-7 shadow-2xs space-y-4">
            <h2 class="text-lg font-heading font-bold text-eco-heading">Active CMS Accounts ({{ $users->count() }})</h2>
            <div class="space-y-3">
                @foreach ($users as $u)
                    <div class="p-4 rounded-2xl bg-eco-surface border border-eco-border/70 flex items-center justify-between gap-4">
                        <div>
                            <div class="text-sm font-heading font-bold text-eco-heading">{{ $u->name }}</div>
                            <div class="text-xs text-eco-body">{{ $u->email }}</div>
                        </div>
                        <span class="px-3 py-1 rounded-full bg-eco-mint-soft text-eco-forest text-xs font-heading font-bold">
                            {{ $u->roleEnum()->label() }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.admin>

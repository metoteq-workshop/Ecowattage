@props([
    'title' => 'CMS Administration',
])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} — Ecowattage CMS</title>
    <link rel="icon" type="image/png" href="{{ asset('images/ecowattage-emblem.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Condensed:wght@500;600;700;800&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-eco-surface text-eco-charcoal antialiased min-h-screen flex flex-col lg:flex-row">
    <!-- Sidebar Navigation -->
    <aside class="w-full lg:w-72 bg-eco-forest text-white shrink-0 flex flex-col justify-between border-b lg:border-b-0 lg:border-r border-white/10">
        <div>
            <div class="p-6 border-b border-white/10 flex items-center justify-between gap-3">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="bg-white rounded-xl p-1.5 shadow-sm">
                        <img src="{{ asset('images/ecowattage-official-logo.png') }}" alt="Ecowattage" class="h-9 w-auto object-contain">
                    </div>
                    <div>
                        <span class="block text-sm font-heading font-bold tracking-wide text-white">Ecowattage CMS</span>
                        <span class="block text-[11px] text-eco-mint font-medium">Stage 2 Admin Panel</span>
                    </div>
                </a>
            </div>

            @php($currentUser = auth()->user())
            <nav class="p-4 space-y-1.5 text-sm font-heading font-semibold" aria-label="CMS Sidebar Navigation">
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center justify-between px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-eco-green text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}"
                >
                    <span>Dashboard Overview</span>
                </a>

                @if ($currentUser?->canManagePages())
                    <a
                        href="{{ route('admin.pages.index') }}"
                        class="flex items-center justify-between px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.pages.*') ? 'bg-eco-green text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}"
                    >
                        <span>Pages, Visibility &amp; SEO</span>
                    </a>
                @endif

                @if ($currentUser?->canManageContent())
                    <a
                        href="{{ route('admin.posts.index') }}"
                        class="flex items-center justify-between px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.posts.*') ? 'bg-eco-green text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}"
                    >
                        <span>Content Modules</span>
                    </a>
                @endif

                @if ($currentUser?->canManageMedia())
                    <a
                        href="{{ route('admin.media.index') }}"
                        class="flex items-center justify-between px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.media.*') ? 'bg-eco-green text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}"
                    >
                        <span>Media Library</span>
                    </a>
                @endif

                <a
                    href="{{ route('admin.inquiries.index') }}"
                    class="flex items-center justify-between px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.inquiries.*') ? 'bg-eco-green text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}"
                >
                    <span>Inquiries &amp; Newsletter</span>
                </a>

                @if ($currentUser?->canManageUsers())
                    <a
                        href="{{ route('admin.users.index') }}"
                        class="flex items-center justify-between px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.users.*') ? 'bg-eco-green text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}"
                    >
                        <span>Users &amp; RBAC Roles</span>
                    </a>

                    <a
                        href="{{ route('admin.activity-logs.index') }}"
                        class="flex items-center justify-between px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.activity-logs.*') ? 'bg-eco-green text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}"
                    >
                        <span>Activity Audit Logs</span>
                    </a>
                @endif
            </nav>
        </div>

        <div class="p-4 border-t border-white/10 space-y-3">
            @if ($currentUser)
                <div class="px-3 py-2 rounded-xl bg-white/10 text-xs">
                    <div class="font-heading font-bold text-white">{{ $currentUser->name }}</div>
                    <div class="text-eco-mint font-medium">{{ $currentUser->roleEnum()->label() }}</div>
                </div>
            @endif

            <div class="flex items-center gap-2">
                <a
                    href="{{ route('home') }}"
                    target="_blank"
                    class="flex-1 text-center px-3 py-2 rounded-xl bg-white/15 hover:bg-white/25 text-xs font-heading font-bold text-white transition"
                >
                    View Live Site
                </a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-3 py-2 rounded-xl bg-red-500/80 hover:bg-red-600 text-xs font-heading font-bold text-white transition cursor-pointer">
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Admin Area -->
    <div class="flex-1 flex flex-col min-w-0">
        <header class="bg-white border-b border-eco-border px-6 lg:px-10 py-5 flex flex-wrap items-center justify-between gap-4">
            <h1 class="text-2xl font-heading font-bold text-eco-heading">{{ $title }}</h1>
            <div class="flex items-center gap-3 text-xs text-eco-body">
                <span class="px-3 py-1 rounded-full bg-eco-mint-soft text-eco-forest font-heading font-bold">
                    Stage 2 CMS Active
                </span>
            </div>
        </header>

        <main class="p-6 lg:p-10 space-y-8 flex-1">
            @if (session('cms_notice'))
                <div class="p-4 rounded-2xl bg-eco-mint-soft border border-eco-green/40 text-sm text-eco-forest font-medium flex items-center justify-between gap-4">
                    <span>{{ session('cms_notice') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-xs text-red-800 space-y-1">
                    <div class="font-heading font-bold uppercase">Validation Error:</div>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>
</body>
</html>

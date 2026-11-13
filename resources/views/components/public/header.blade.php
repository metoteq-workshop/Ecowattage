@props([
    'site' => [],
    'navigation' => [],
])

<!-- Top Header Bar (#4baf47) -->
<div class="bg-[#4baf47] text-white text-xs border-b border-black/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2.5 flex flex-wrap items-center justify-between gap-2">
        <div class="flex items-center gap-2.5">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-heading font-semibold bg-white/20 text-white border border-white/30">
                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                Powering Africa's Green Future
            </span>
            <span class="hidden md:inline text-white/95 font-medium">
                Renewable Energy Advocacy • Public Education • Innovation &amp; Future Manufacturing
            </span>
        </div>
        <div class="flex items-center gap-4 ml-auto">
            <button
                type="button"
                @click="showPlaceholderBadges = !showPlaceholderBadges"
                class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-white hover:text-eco-forest transition cursor-pointer bg-black/15 hover:bg-white px-2.5 py-1 rounded-full"
                title="Toggle visibility of Stage 1 content & illustrative photo markers"
            >
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <span x-text="showPlaceholderBadges ? 'Content Guide Badges: ON' : 'Content Guide Badges: OFF'">Content Guide Badges: ON</span>
            </button>
        </div>
    </div>
</div>

<!-- Flash Notification (e.g., Newsletter Demo Feedback) -->
@if (session('newsletter_status'))
    <div
        x-data="{ open: true }"
        x-show="open"
        class="bg-eco-forest text-white px-4 py-3 shadow-md relative z-50"
        role="status"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-4">
            <div class="flex items-center gap-2 text-sm font-medium">
                <svg class="w-5 h-5 shrink-0 text-[#4baf47]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('newsletter_status') }}</span>
            </div>
            <button type="button" @click="open = false" class="text-white/80 hover:text-white p-1" aria-label="Dismiss alert">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endif

<header
    x-data="{
        mobileMenuOpen: false,
        sideDrawerOpen: false,
        activeDropdown: null
    }"
    class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-eco-border/80 shadow-2xs transition-all duration-200"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20 lg:h-22 gap-4 lg:gap-6">
            <!-- Left Zone: Brand Logo (Optically Centered) -->
            <div class="flex items-center shrink-0">
                <a href="{{ route('home') }}" class="inline-flex items-center group focus:outline-none py-1">
                    <img
                        src="{{ asset($site['logo_full'] ?? 'images/ecowattage-official-logo.png') }}"
                        alt="Ecowattage Logo"
                        class="h-11 sm:h-12 lg:h-13 w-auto object-contain -mt-1 transition-transform duration-300 group-hover:scale-[1.02]"
                    >
                </a>
            </div>

            <!-- Center Zone: Desktop Navigation (Single-line, Uniform Height & Alignment) -->
            <nav class="hidden lg:flex items-center justify-center flex-1 gap-1 xl:gap-2" aria-label="Primary Navigation">
                @foreach ($navigation as $item)
                    @php
                        $isActive = request()->routeIs($item['route']);
                        $hasChildren = !empty($item['children']);
                    @endphp

                    @if ($hasChildren)
                        <div
                            class="relative flex items-center"
                            @mouseenter="activeDropdown = '{{ $item['label'] }}'"
                            @mouseleave="activeDropdown = null"
                        >
                            <button
                                type="button"
                                @click="activeDropdown = (activeDropdown === '{{ $item['label'] }}' ? null : '{{ $item['label'] }}')"
                                class="h-10 px-3 xl:px-3.5 rounded-xl text-sm xl:text-[15px] font-heading font-semibold leading-none whitespace-nowrap transition-colors duration-200 inline-flex items-center justify-center gap-1.5 cursor-pointer {{ $isActive ? 'text-eco-green bg-eco-mint-soft/70' : 'text-eco-heading hover:text-eco-green hover:bg-eco-surface/80' }}"
                                :aria-expanded="activeDropdown === '{{ $item['label'] }}'"
                            >
                                <span>{{ $item['label'] }}</span>
                                <svg
                                    class="w-3.5 h-3.5 shrink-0 transition-transform duration-200"
                                    :class="activeDropdown === '{{ $item['label'] }}' ? 'rotate-180 text-eco-green' : 'text-eco-body'"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2.2"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown Panel -->
                            <div
                                x-cloak
                                x-show="activeDropdown === '{{ $item['label'] }}'"
                                x-transition:enter="transition ease-out duration-150"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-2"
                                class="absolute left-1/2 -translate-x-1/2 top-full pt-2 w-72 z-50"
                            >
                                <div class="rounded-2xl bg-white shadow-xl border border-eco-border/90 p-2.5">
                                    @foreach ($item['children'] as $child)
                                        <a
                                            href="{{ route($child['route']) }}"
                                            class="flex items-start gap-3 p-3 rounded-xl hover:bg-eco-mint-soft/70 transition group"
                                        >
                                            <span class="w-2 h-2 rounded-full bg-eco-green mt-1.5 shrink-0 group-hover:scale-125 transition-transform"></span>
                                            <div>
                                                <div class="text-sm font-heading font-semibold text-eco-heading group-hover:text-eco-green">
                                                    {{ $child['label'] }}
                                                </div>
                                                @if (!empty($child['description']))
                                                    <p class="text-xs text-eco-body mt-0.5 leading-relaxed">{{ $child['description'] }}</p>
                                                @endif
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <a
                            href="{{ route($item['route']) }}"
                            class="h-10 px-3 xl:px-3.5 rounded-xl text-sm xl:text-[15px] font-heading font-semibold leading-none whitespace-nowrap transition-colors duration-200 inline-flex items-center justify-center {{ $isActive ? 'text-eco-green bg-eco-mint-soft/70' : 'text-eco-heading hover:text-eco-green hover:bg-eco-surface/80' }}"
                        >
                            {{ $item['label'] }}
                        </a>
                    @endif
                @endforeach
            </nav>

            <!-- Right Zone: Action CTA + Quick-Contact Drawer Trigger + Mobile Menu Toggle -->
            <div class="flex items-center justify-end gap-2.5 sm:gap-3 shrink-0">
                <a
                    href="#campaigns-section"
                    class="hidden sm:inline-flex items-center justify-center gap-2 h-11 px-5 rounded-full bg-eco-green hover:bg-eco-forest text-white font-heading font-semibold text-sm leading-none whitespace-nowrap transition-all duration-200 shadow-md shadow-eco-green/25"
                >
                    <span>Get Involved</span>
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>

                <!-- Ecozone Reference Sidebar Info Drawer Button -->
                <button
                    type="button"
                    @click="sideDrawerOpen = true"
                    class="hidden md:inline-flex items-center justify-center w-11 h-11 rounded-full border border-eco-border text-eco-heading hover:bg-eco-green hover:text-white hover:border-eco-green transition-colors duration-200 cursor-pointer shrink-0"
                    aria-label="Open organization quick contact drawer"
                    title="Quick Contact & Mission Overview"
                >
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h10M4 18h16" />
                    </svg>
                </button>

                <!-- Mobile Hamburger Button -->
                <button
                    type="button"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    class="lg:hidden inline-flex items-center justify-center w-11 h-11 rounded-xl border border-eco-border text-eco-heading hover:bg-eco-mint-soft transition cursor-pointer shrink-0"
                    :aria-expanded="mobileMenuOpen"
                    aria-label="Toggle mobile navigation menu"
                >
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-cloak x-show="mobileMenuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div
        x-cloak
        x-show="mobileMenuOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="lg:hidden bg-white border-t border-eco-border shadow-xl"
    >
        <div class="max-w-7xl mx-auto px-4 pt-3 pb-6 space-y-1.5">
            @foreach ($navigation as $item)
                @if (!empty($item['children']))
                    <div x-data="{ subOpen: false }" class="border-b border-eco-border/50 pb-1.5">
                        <button
                            type="button"
                            @click="subOpen = !subOpen"
                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-base font-heading font-semibold text-eco-heading hover:bg-eco-mint-soft/60"
                        >
                            <span>{{ $item['label'] }}</span>
                            <svg class="w-4 h-4 transition-transform" :class="subOpen ? 'rotate-180 text-eco-green' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-cloak x-show="subOpen" class="pl-4 pr-2 py-1 space-y-1">
                            @foreach ($item['children'] as $child)
                                <a
                                    href="{{ route($child['route']) }}"
                                    class="block px-3 py-2 rounded-lg text-sm font-medium text-eco-body hover:text-eco-green hover:bg-eco-mint-soft/40"
                                >
                                    {{ $child['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a
                        href="{{ route($item['route']) }}"
                        class="block px-3 py-2.5 rounded-xl text-base font-heading font-semibold {{ request()->routeIs($item['route']) ? 'bg-eco-mint-soft text-eco-green' : 'text-eco-heading hover:bg-eco-mint-soft/60' }}"
                    >
                        {{ $item['label'] }}
                    </a>
                @endif
            @endforeach

            <div class="pt-3 flex flex-col sm:flex-row gap-3">
                <a href="#campaigns-section" @click="mobileMenuOpen = false" class="btn-eco-primary w-full justify-center">
                    Explore Campaigns
                </a>
                <a href="{{ route('contact') }}" class="btn-eco-outline w-full justify-center">
                    Contact Us
                </a>
            </div>
        </div>
    </div>

    <!-- Ecozone-Style Right Quick-Contact & Mission Sidebar Drawer (Teleported to body for full-screen height) -->
    <template x-teleport="body">
        <div
            x-cloak
            x-show="sideDrawerOpen"
            @keydown.escape.window="sideDrawerOpen = false"
            class="fixed inset-0 z-50 overflow-hidden"
            aria-labelledby="drawer-title"
            role="dialog"
            aria-modal="true"
        >
            <!-- Full-Screen Backdrop Overlay -->
            <div
                x-show="sideDrawerOpen"
                x-transition:enter="ease-in-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in-out duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="sideDrawerOpen = false"
                class="fixed inset-0 bg-eco-forest/65 backdrop-blur-xs transition-opacity"
            ></div>

            <div class="fixed inset-y-0 right-0 max-w-full flex pl-10">
                <div
                    x-show="sideDrawerOpen"
                    x-transition:enter="transform transition ease-in-out duration-300"
                    x-transition:enter-start="translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in-out duration-200"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full"
                    class="w-screen max-w-md h-dvh bg-white shadow-2xl p-7 sm:p-8 flex flex-col justify-between overflow-y-auto"
                >
                    <div>
                        <div class="flex items-center justify-between pb-6 border-b border-eco-border">
                            <img src="{{ asset($site['logo_full'] ?? 'images/ecowattage-official-logo.png') }}" alt="Ecowattage" class="h-12 w-auto object-contain">
                            <button
                                type="button"
                                @click="sideDrawerOpen = false"
                                class="w-10 h-10 rounded-full bg-eco-surface text-eco-heading hover:bg-eco-green hover:text-white transition flex items-center justify-center cursor-pointer shrink-0"
                                aria-label="Close panel"
                            >
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="mt-6">
                            <span class="text-xs font-heading font-bold uppercase tracking-wider text-eco-green">Our Purpose</span>
                            <h3 id="drawer-title" class="text-xl font-heading font-bold text-eco-heading mt-1 leading-snug">
                                Have a Renewable Energy Initiative or Partnership in Mind?
                            </h3>
                            <p class="text-sm text-eco-body mt-3 leading-relaxed">
                                {{ $site['description'] ?? '' }}
                            </p>
                        </div>

                        <!-- Quick Navigation Links in Drawer -->
                        <div class="mt-6 pt-6 border-t border-eco-border/70">
                            <h4 class="text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-3">Quick Navigation</h4>
                            <div class="grid grid-cols-2 gap-2 text-sm font-heading font-medium">
                                <a href="{{ route('home') }}" @click="sideDrawerOpen = false" class="px-3 py-2 rounded-xl bg-eco-surface hover:bg-eco-mint-soft text-eco-heading hover:text-eco-green transition">Home</a>
                                <a href="{{ route('about') }}" class="px-3 py-2 rounded-xl bg-eco-surface hover:bg-eco-mint-soft text-eco-heading hover:text-eco-green transition">About Us</a>
                                <a href="{{ route('services') }}" class="px-3 py-2 rounded-xl bg-eco-surface hover:bg-eco-mint-soft text-eco-heading hover:text-eco-green transition">Services</a>
                                <a href="{{ route('campaigns') }}" class="px-3 py-2 rounded-xl bg-eco-surface hover:bg-eco-mint-soft text-eco-heading hover:text-eco-green transition">Campaigns</a>
                                <a href="{{ route('projects') }}" class="px-3 py-2 rounded-xl bg-eco-surface hover:bg-eco-mint-soft text-eco-heading hover:text-eco-green transition">Projects</a>
                                <a href="{{ route('contact') }}" class="px-3 py-2 rounded-xl bg-eco-surface hover:bg-eco-mint-soft text-eco-heading hover:text-eco-green transition">Contact Us</a>
                            </div>
                        </div>

                        <!-- Contact Information Block -->
                        <div class="mt-6 space-y-4 bg-eco-surface p-5 rounded-2xl border border-eco-border/80">
                            <div class="flex items-center justify-between">
                                <h4 class="text-sm font-heading font-bold uppercase tracking-wider text-eco-heading">Contact Details</h4>
                                <span x-show="showPlaceholderBadges" class="text-[10px] font-semibold px-2 py-0.5 rounded bg-amber-100 text-amber-900 border border-amber-300">
                                    Official Details Needed
                                </span>
                            </div>
                            <div class="space-y-3 text-sm text-eco-body">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-eco-green shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>{{ $site['contact']['address'] ?? '' }}</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-eco-green shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <span>{{ $site['contact']['phone'] ?? '' }}</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-eco-green shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ $site['contact']['email'] ?? '' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Newsletter Quick Box -->
                        <div class="mt-6">
                            <h4 class="text-sm font-heading font-bold text-eco-heading">Subscribe to Clean Energy Updates</h4>
                            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="mt-3 flex gap-2">
                                @csrf
                                <input
                                    type="email"
                                    name="email"
                                    required
                                    placeholder="Enter your email..."
                                    class="flex-1 rounded-xl border border-eco-border px-3.5 py-2.5 text-sm focus:outline-none focus:border-eco-green"
                                >
                                <button type="submit" class="btn-eco-primary !py-2.5 !px-4 !text-xs !rounded-xl cursor-pointer">
                                    Subscribe
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-eco-border mt-8 flex items-center justify-between">
                        <span class="text-xs font-medium text-eco-body">Follow Ecowattage:</span>
                        <div class="flex items-center gap-2">
                            @foreach (($site['socials'] ?? []) as $social)
                                <a
                                    href="{{ $social['url'] }}"
                                    class="w-9 h-9 rounded-full bg-eco-surface text-eco-heading hover:bg-eco-green hover:text-white transition flex items-center justify-center text-xs font-bold"
                                    aria-label="{{ $social['name'] }}"
                                >
                                    {{ substr($social['name'], 0, 2) }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</header>

@props([
    'site' => [],
    'navigation' => [],
])

<footer class="bg-eco-forest text-white relative overflow-hidden mt-auto">
    <!-- Decorative Organic Leaf/Wave Background Watermark (Ecozone Footer Pattern) -->
    <div class="absolute inset-0 pointer-events-none opacity-10">
        <svg class="w-full h-full" viewBox="0 0 1440 600" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M-100 500 C 300 300, 700 650, 1540 250" stroke="#00A86B" stroke-width="3" fill="none"/>
            <path d="M-100 350 C 400 150, 900 500, 1540 100" stroke="#C8E6C9" stroke-width="1.5" fill="none"/>
            <circle cx="1250" cy="140" r="180" stroke="#00A86B" stroke-width="1.5" fill="none"/>
        </svg>
    </div>

    <!-- Top Newsletter Subscription Panel (Ecozone Footer Layout 1) -->
    <div class="relative border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="bg-gradient-to-r from-eco-green-dark via-eco-green to-eco-blue/90 rounded-3xl p-8 sm:p-10 lg:p-12 shadow-2xl relative overflow-hidden">
                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-7">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 text-white text-xs font-heading font-semibold uppercase tracking-wider">
                            Monthly Clean Energy Digest
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-heading font-bold text-white mt-3 leading-tight">
                            Subscribe to Ecowattage News, Advocacy Alerts &amp; Research Updates
                        </h2>
                        <p class="text-white/90 text-sm sm:text-base mt-2 max-w-2xl">
                            Receive our curated monthly digest covering renewable energy policy, public education workshops, community projects, and clean-tech innovation across Africa.
                        </p>
                    </div>
                    <div class="lg:col-span-5">
                        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
                            @csrf
                            <label for="footer-newsletter-email" class="sr-only">Email address</label>
                            <input
                                id="footer-newsletter-email"
                                type="email"
                                name="email"
                                required
                                placeholder="Enter your email address..."
                                class="flex-1 rounded-full bg-white text-eco-charcoal px-5 py-3.5 text-sm font-medium placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-eco-mint shadow-inner"
                            >
                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-full bg-eco-forest hover:bg-eco-navy text-white font-heading font-semibold text-sm px-7 py-3.5 transition shadow-lg shrink-0 cursor-pointer"
                            >
                                <span>Subscribe Now</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main 4-Column Footer Content -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8">
            <!-- Column 1: Brand & Mission -->
            <div class="lg:col-span-4 space-y-5">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 bg-white px-4 py-3 rounded-2xl shadow-md">
                    <img
                        src="{{ asset($site['logo_full'] ?? 'images/ecowattage-official-logo.png') }}"
                        alt="Ecowattage Logo"
                        class="h-12 w-auto object-contain"
                    >
                </a>
                <p class="text-xs font-heading font-bold uppercase tracking-widest text-eco-mint">
                    {{ $site['tagline'] ?? "Powering Africa's Green Future" }}
                </p>
                <p class="text-sm text-white/75 leading-relaxed">
                    {{ $site['description'] ?? '' }}
                </p>
                <div class="pt-2 flex items-center gap-3">
                    @foreach (($site['socials'] ?? []) as $social)
                        <a
                            href="{{ $social['url'] }}"
                            class="w-10 h-10 rounded-full bg-white/10 hover:bg-eco-green text-white transition flex items-center justify-center"
                            aria-label="{{ $social['name'] }}"
                            title="{{ $social['name'] }} (Supply official profile URL)"
                        >
                            @if ($social['icon'] === 'facebook')
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                            @elseif ($social['icon'] === 'linkedin')
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
                            @elseif ($social['icon'] === 'twitter')
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            @else
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Column 2: Useful Links -->
            <div class="lg:col-span-2 space-y-4">
                <h3 class="text-base font-heading font-bold text-white tracking-wide">Useful Links</h3>
                <ul class="space-y-2.5 text-sm text-white/75">
                    <li><a href="{{ route('home') }}" class="hover:text-eco-mint transition">Home</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-eco-mint transition">About Us &amp; Team</a></li>
                    <li><a href="{{ route('campaigns') }}" class="hover:text-eco-mint transition">Advocacy Campaigns</a></li>
                    <li><a href="{{ route('projects') }}" class="hover:text-eco-mint transition">Projects Showcase</a></li>
                    <li><a href="{{ route('partners-careers') }}" class="hover:text-eco-mint transition">Partners &amp; Careers</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-eco-mint transition">Contact Us</a></li>
                </ul>
            </div>

            <!-- Column 3: Solutions & Knowledge -->
            <div class="lg:col-span-3 space-y-4">
                <h3 class="text-base font-heading font-bold text-white tracking-wide">Focus Areas &amp; Media</h3>
                <ul class="space-y-2.5 text-sm text-white/75">
                    <li><a href="{{ route('services') }}" class="hover:text-eco-mint transition">Renewable Energy Advocacy</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-eco-mint transition">Public Energy Education</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-eco-mint transition">Clean-Tech Innovation &amp; Manufacturing</a></li>
                    <li><a href="{{ route('blog') }}" class="hover:text-eco-mint transition">Blog &amp; Industry News</a></li>
                    <li><a href="{{ route('publications') }}" class="hover:text-eco-mint transition">Publications &amp; Research</a></li>
                    <li><a href="{{ route('events-gallery') }}" class="hover:text-eco-mint transition">Events &amp; Media Gallery</a></li>
                </ul>
            </div>

            <!-- Column 4: Contact Info -->
            <div class="lg:col-span-3 space-y-4">
                <div class="flex items-center justify-between gap-2">
                    <h3 class="text-base font-heading font-bold text-white tracking-wide">Contact Us</h3>
                    <span
                        x-show="showPlaceholderBadges"
                        class="text-[10px] font-semibold px-2 py-0.5 rounded bg-amber-400/20 text-amber-200 border border-amber-300/30"
                    >
                        Confirm Details
                    </span>
                </div>
                <ul class="space-y-3 text-sm text-white/80">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-eco-green shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>{{ $site['contact']['address'] ?? '' }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-eco-green shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>{{ $site['contact']['phone'] ?? '' }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-eco-green shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $site['contact']['email'] ?? '' }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bottom Copyright & Disclaimer Bar -->
    <div class="relative border-t border-white/10 bg-black/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-white/65">
            <p>
                &copy; {{ date('Y') }} <strong class="text-white font-semibold">Ecowattage</strong>. All Rights Reserved. Powering Africa’s Green Future.
            </p>
            <div class="flex flex-wrap items-center gap-5">
                <span x-show="showPlaceholderBadges" class="text-eco-mint/90">
                    Illustrative photography is used for visual demonstration and does not depict specific completed Ecowattage installations unless stated.
                </span>
                <a href="#main-content" class="hover:text-white transition">Privacy &amp; Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>

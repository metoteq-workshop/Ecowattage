<x-layouts.public
    :title="($site['name'] ?? 'Ecowattage') . ' — ' . ($site['tagline'] ?? 'Powering Africa\'s Green Future')"
    :metaDescription="$site['description'] ?? ''"
    :site="$site"
    :navigation="$navigation"
>
    {{-- =====================================================================
         SECTION 1: HERO SLIDER (Ecozone /nature Hero Layout 1)
         ===================================================================== --}}
    <section
        x-data="{
            activeSlide: 0,
            totalSlides: {{ count($home['hero_slides']) }},
            autoplay: null,
            init() {
                this.startAutoplay();
            },
            startAutoplay() {
                this.autoplay = setInterval(() => {
                    this.next();
                }, 7000);
            },
            stopAutoplay() {
                if (this.autoplay) clearInterval(this.autoplay);
            },
            next() {
                this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
            },
            prev() {
                this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides;
            }
        }"
        @mouseenter="stopAutoplay()"
        @mouseleave="startAutoplay()"
        class="relative bg-eco-forest text-white overflow-hidden pt-12 pb-20 lg:py-24"
    >
        <!-- Atmospheric Background Layer & Organic Vector Overlay -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute inset-0 bg-gradient-to-br from-eco-forest via-[#0B3529] to-eco-navy/90"></div>
            <svg class="absolute right-0 top-0 h-full w-1/2 opacity-10" viewBox="0 0 600 800" fill="none">
                <circle cx="450" cy="200" r="280" stroke="#00A86B" stroke-width="2" />
                <circle cx="450" cy="200" r="200" stroke="#C8E6C9" stroke-width="1" stroke-dasharray="8 8" />
                <path d="M0 700 C 200 500, 400 750, 600 450" stroke="#00A86B" stroke-width="3" />
            </svg>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @foreach ($home['hero_slides'] as $index => $slide)
                <div
                    x-cloak
                    x-show="activeSlide === {{ $index }}"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 translate-y-3"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center"
                >
                    <!-- Left Narrative & CTA Column -->
                    <div class="lg:col-span-6 space-y-6">
                        <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-white/10 border border-eco-mint/30 text-eco-mint text-xs font-heading font-bold uppercase tracking-widest">
                            <span class="w-2 h-2 rounded-full bg-eco-green"></span>
                            <span>{{ $slide['eyebrow'] }}</span>
                        </div>

                        <h1 class="text-3xl sm:text-5xl lg:text-[52px] font-heading font-bold text-white leading-[1.14]">
                            {{ $slide['title'] }}
                        </h1>

                        <p class="text-base sm:text-lg text-white/80 leading-relaxed max-w-xl">
                            {{ $slide['description'] }}
                        </p>

                        <div class="pt-2 flex flex-wrap items-center gap-4">
                            <a href="{{ $slide['primary_cta']['url'] }}" class="btn-eco-primary">
                                <span>{{ $slide['primary_cta']['label'] }}</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                            <a href="{{ $slide['secondary_cta']['url'] }}" class="inline-flex items-center justify-center gap-2.5 px-7 py-3.5 rounded-full border border-white/30 text-white font-heading font-semibold text-sm hover:bg-white hover:text-eco-forest transition">
                                <span>{{ $slide['secondary_cta']['label'] }}</span>
                            </a>
                        </div>

                        <!-- Slide Navigation Controls & Pillar Highlights -->
                        <div class="pt-6 border-t border-white/15 flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <button
                                    type="button"
                                    @click="prev()"
                                    class="w-10 h-10 rounded-full border border-white/25 hover:bg-eco-green hover:border-eco-green text-white transition flex items-center justify-center cursor-pointer"
                                    aria-label="Previous slide"
                                >
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>
                                <button
                                    type="button"
                                    @click="next()"
                                    class="w-10 h-10 rounded-full border border-white/25 hover:bg-eco-green hover:border-eco-green text-white transition flex items-center justify-center cursor-pointer"
                                    aria-label="Next slide"
                                >
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                                <div class="flex items-center gap-2 ml-2">
                                    @foreach ($home['hero_slides'] as $dotIndex => $dotSlide)
                                        <button
                                            type="button"
                                            @click="activeSlide = {{ $dotIndex }}"
                                            class="h-2 rounded-full transition-all cursor-pointer"
                                            :class="activeSlide === {{ $dotIndex }} ? 'w-7 bg-eco-green' : 'w-2 bg-white/35 hover:bg-white/60'"
                                            aria-label="Go to slide {{ $dotIndex + 1 }}"
                                        ></button>
                                    @endforeach
                                </div>
                            </div>

                            <div class="text-xs text-eco-mint/85 font-medium">
                                Slide 0{{ $index + 1 }} / 0{{ count($home['hero_slides']) }}
                            </div>
                        </div>
                    </div>

                    <!-- Right Split Imagery + Rotating Circular Emblem Badge (Ecozone Hero Layout 1) -->
                    <div class="lg:col-span-6 relative">
                        <div class="grid grid-cols-12 gap-4 items-center">
                            <!-- Main Framed Image -->
                            <div class="col-span-8 relative">
                                <div class="rounded-3xl overflow-hidden border-2 border-white/15 shadow-2xl aspect-[4/3] bg-eco-forest/50">
                                    <img
                                        src="{{ asset($slide['main_image']) }}"
                                        alt="{{ $slide['main_image_alt'] }}"
                                        class="w-full h-full object-cover"
                                    >
                                </div>
                            </div>

                            <!-- Secondary Offset Image -->
                            <div class="col-span-4 space-y-4">
                                <!-- Rotating Circular SVG Badge (Ecozone Signature Element) -->
                                <div class="relative w-28 h-28 sm:w-32 sm:h-32 mx-auto flex items-center justify-center">
                                    <svg class="w-full h-full animate-spin-slow text-eco-mint" viewBox="0 0 120 120">
                                        <defs>
                                            <path id="circlePath-{{ $index }}" d="M 60, 60 m -44, 0 a 44,44 0 1,1 88,0 a 44,44 0 1,1 -88,0" />
                                        </defs>
                                        <text fill="currentColor" font-size="8.7" font-weight="700" letter-spacing="2.2">
                                            <textPath href="#circlePath-{{ $index }}">
                                                • POWERING AFRICA'S GREEN FUTURE • ECOWATTAGE
                                            </textPath>
                                        </text>
                                    </svg>
                                    <div class="absolute w-14 h-14 rounded-full bg-white flex items-center justify-center shadow-lg p-2">
                                        <img src="{{ asset('images/ecowattage-emblem.png') }}" alt="Ecowattage Emblem" class="w-full h-full object-contain">
                                    </div>
                                </div>

                                <div class="rounded-2xl overflow-hidden border-2 border-white/15 shadow-xl aspect-[3/4] bg-eco-forest/50">
                                    <img
                                        src="{{ asset($slide['secondary_image']) }}"
                                        alt="{{ $slide['secondary_image_alt'] }}"
                                        class="w-full h-full object-cover"
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- 3D Interactive African Clean Energy Globe Badge -->
                        <div class="mt-4 p-4 rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 shadow-xl flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <div id="eco-globe-canvas" class="w-20 h-20 sm:w-24 sm:h-24 shrink-0 cursor-grab active:cursor-grabbing"></div>
                                <div>
                                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-heading font-bold uppercase tracking-wider bg-eco-green/30 text-eco-mint border border-eco-mint/30">
                                        <span class="w-1.5 h-1.5 rounded-full bg-eco-green animate-pulse"></span>
                                        Interactive 3D Sphere
                                    </span>
                                    <h4 class="text-xs sm:text-sm font-heading font-bold text-white mt-1">Clean Energy Orbit</h4>
                                    <p class="text-[11px] text-white/70">Drag to spin the West Africa energy beacon</p>
                                </div>
                            </div>
                            <div class="hidden sm:block text-right">
                                <span class="text-xs font-mono font-bold text-eco-mint">8.46° N, 13.23° W</span>
                                <p class="text-[10px] text-white/60">Sierra Leone &amp; Africa Hub</p>
                            </div>
                        </div>

                        <!-- Illustrative Photo Caption Badge -->
                        <div
                            x-show="showPlaceholderBadges"
                            class="mt-3 inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-black/40 border border-white/15 text-[11px] text-white/80"
                        >
                            <svg class="w-3.5 h-3.5 text-eco-mint shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $slide['image_caption'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- =====================================================================
         SECTION 2: 3-PILLAR FEATURE STRIP (Ecozone AditionalFeature Layout 1)
         ===================================================================== --}}
    <section class="py-20 lg:py-28 bg-eco-surface relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($home['core_pillars'] as $pillar)
                    <div class="card-3d-tilt bg-white rounded-3xl p-8 lg:p-10 border border-eco-border/80 shadow-xs hover:shadow-2xl transition-all duration-300 group relative overflow-hidden transform-gpu">
                        <div class="flex items-center justify-between mb-6">
                            <!-- Custom Pillar SVG Icon -->
                            <div class="w-16 h-16 rounded-2xl bg-eco-mint-soft text-eco-green group-hover:bg-eco-green group-hover:text-white transition-colors duration-300 flex items-center justify-center shadow-xs">
                                @if ($pillar['icon'] === 'advocacy')
                                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                    </svg>
                                @elseif ($pillar['icon'] === 'education')
                                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                @else
                                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                    </svg>
                                @endif
                            </div>

                            <span class="text-xs font-heading font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-eco-surface text-eco-body border border-eco-border">
                                {{ $pillar['tag'] }}
                            </span>
                        </div>

                        <h3 class="text-xl font-heading font-bold text-eco-heading group-hover:text-eco-green transition-colors">
                            {{ $pillar['title'] }}
                        </h3>

                        <p class="mt-3 text-sm sm:text-base text-eco-body leading-relaxed">
                            {{ $pillar['subtitle'] }}
                        </p>

                        <div class="mt-6 pt-5 border-t border-eco-border/60 flex items-center justify-between text-xs font-heading font-bold text-eco-green">
                            <span>Pillar {{ $pillar['number'] }}</span>
                            <a href="{{ route('services') }}" class="inline-flex items-center gap-1 hover:underline">
                                <span>Explore Pillar</span>
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- =====================================================================
         SECTION 3: ABOUT US SPLIT SECTION (Ecozone About Layout 1)
         ===================================================================== --}}
    <section id="about-section" class="py-20 lg:py-32 bg-white relative overflow-hidden">
        <!-- Decorative Leaf Vector Backdrop -->
        <div class="absolute -left-24 bottom-10 pointer-events-none opacity-5">
            <svg class="w-96 h-96 text-eco-green" viewBox="0 0 200 200" fill="currentColor">
                <path d="M100 10 C 40 40, 10 100, 40 170 C 100 190, 160 150, 180 80 C 160 40, 130 20, 100 10 Z" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                <!-- Left Image Composition + Video Trigger (Ecozone About Left Column) -->
                <div class="lg:col-span-6 relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-eco-border aspect-[4/3]">
                        <img
                            src="{{ asset($home['about']['primary_image']) }}"
                            alt="Renewable energy engineers reviewing solar schematics"
                            class="w-full h-full object-cover"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-eco-forest/60 via-transparent to-transparent"></div>

                        <!-- Ecozone-style Video Overview Trigger Badge -->
                        <div class="absolute bottom-6 left-6 right-6 flex items-center justify-between gap-4 bg-white/95 backdrop-blur-xs p-4 rounded-2xl shadow-lg">
                            <div class="flex items-center gap-3.5">
                                <div class="w-12 h-12 rounded-full bg-eco-green text-white flex items-center justify-center shrink-0 shadow-md">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-heading font-bold uppercase tracking-wider text-eco-green">Clean Energy Transition</p>
                                    <p class="text-sm font-heading font-bold text-eco-heading">Advocacy, Literacy &amp; African Innovation</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        x-show="showPlaceholderBadges"
                        class="mt-3 text-xs text-eco-body flex items-center gap-1.5"
                    >
                        <span class="px-2 py-0.5 rounded bg-eco-mint-soft text-eco-green font-semibold">Illustrative Photo</span>
                        <span>{{ $home['about']['image_disclaimer'] }}</span>
                    </div>
                </div>

                <!-- Right Content Column -->
                <div class="lg:col-span-6 space-y-6">
                    <x-public.section-heading
                        align="left"
                        :subtitle="$home['about']['subtitle']"
                        :title="$home['about']['title']"
                        :description="$home['about']['description']"
                    />

                    <!-- Mission & Values Blocks (Ecozone About Feature List) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-3">
                        @foreach ($home['about']['features'] as $feature)
                            <div class="p-5 rounded-2xl bg-eco-surface border border-eco-border/80">
                                <div class="w-10 h-10 rounded-xl bg-eco-green text-white flex items-center justify-center mb-3.5">
                                    @if ($feature['icon'] === 'mission')
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    @endif
                                </div>
                                <h3 class="text-lg font-heading font-bold text-eco-heading">{{ $feature['title'] }}</h3>
                                <p class="mt-2 text-sm text-eco-body leading-relaxed">{{ $feature['description'] }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-4 flex flex-wrap items-center gap-4">
                        <a href="{{ route($home['about']['cta_route']) }}" class="btn-eco-primary">
                            <span>{{ $home['about']['cta_text'] }}</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="{{ route('contact') }}" class="btn-eco-outline">
                            Connect With Our Team
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =====================================================================
         SECTION 4: SERVICES & SOLUTIONS SHOWCASE (Ecozone Service Layout 1)
         ===================================================================== --}}
    <section id="services-section" class="py-20 lg:py-32 bg-eco-green relative overflow-hidden text-white">
        <!-- Subtle Ecozone-style Organic SVG Pattern Overlay -->
        <div class="absolute inset-0 pointer-events-none opacity-15">
            <svg class="w-full h-full" viewBox="0 0 1440 700" fill="none" preserveAspectRatio="none">
                <path d="M-100 100 C 400 400, 900 -100, 1540 300" stroke="#FFFFFF" stroke-width="2" />
                <path d="M-100 550 C 500 200, 1000 650, 1540 200" stroke="#C8E6C9" stroke-width="2" />
                <circle cx="200" cy="600" r="220" stroke="#FFFFFF" stroke-width="1.5" />
                <circle cx="1300" cy="120" r="180" stroke="#FFFFFF" stroke-width="1.5" />
            </svg>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                light
                :subtitle="$home['services']['subtitle']"
                :title="$home['services']['title']"
                :description="$home['services']['description']"
            />

            <div class="mt-14 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                @foreach ($home['services']['items'] as $service)
                    <div class="card-3d-tilt bg-white text-eco-charcoal rounded-3xl p-7 lg:p-8 shadow-xl transition-all duration-300 flex flex-col justify-between group transform-gpu">
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-6">
                                <div class="w-14 h-14 rounded-2xl bg-eco-mint-soft text-eco-green group-hover:bg-eco-green group-hover:text-white transition-colors flex items-center justify-center">
                                    @if ($service['icon'] === 'megaphone')
                                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                        </svg>
                                    @elseif ($service['icon'] === 'book-open')
                                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    @elseif ($service['icon'] === 'sun-bolt')
                                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    @else
                                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                                        </svg>
                                    @endif
                                </div>

                                <span class="text-[11px] font-heading font-bold uppercase tracking-wider px-2.5 py-1 rounded-full {{ $service['badge'] === 'Future Phase' ? 'bg-eco-blue/10 text-eco-blue' : 'bg-eco-mint-soft text-eco-green-dark' }}">
                                    {{ $service['badge'] }}
                                </span>
                            </div>

                            <h3 class="text-xl font-heading font-bold text-eco-heading group-hover:text-eco-green transition-colors">
                                {{ $service['title'] }}
                            </h3>

                            <p class="mt-3 text-sm text-eco-body leading-relaxed">
                                {{ $service['subtitle'] }}
                            </p>
                        </div>

                        <div class="mt-7 pt-4 border-t border-eco-border/70">
                            <a
                                href="{{ route($service['route']) }}"
                                class="inline-flex items-center gap-2 text-sm font-heading font-bold text-eco-heading group-hover:text-eco-green transition"
                            >
                                <span>Learn More</span>
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- =====================================================================
         SECTION 5: IMPACT COUNTER STRIP (Ecozone FunFact Layout 1)
         ===================================================================== --}}
    <section class="py-16 lg:py-20 bg-white border-b border-eco-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Transparency Notice for Impact Statistics -->
            <div
                x-show="showPlaceholderBadges"
                class="mb-8 p-4 rounded-2xl bg-amber-50 border border-amber-200 flex items-start sm:items-center justify-between gap-4 text-xs text-amber-900"
            >
                <div class="flex items-center gap-2.5">
                    <span class="px-2 py-0.5 rounded bg-amber-200 font-heading font-bold uppercase">Metrics Notice</span>
                    <span>{{ $home['funfacts']['disclaimer'] }}</span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($home['funfacts']['items'] as $fact)
                    <div class="p-6 rounded-2xl bg-eco-surface border border-eco-border/70 text-center lg:text-left flex flex-col justify-between">
                        <div>
                            <div class="text-3xl sm:text-4xl font-heading font-extrabold text-eco-green">
                                {{ $fact['sample_display'] }}
                            </div>
                            <div class="mt-2 text-base font-heading font-bold text-eco-heading">
                                {{ $fact['label'] }}
                            </div>
                        </div>
                        <div
                            x-show="showPlaceholderBadges"
                            class="mt-3 pt-2 border-t border-eco-border text-[11px] text-amber-800 font-medium"
                        >
                            [{{ $fact['note'] }}]
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- =====================================================================
         SECTION 6: FAQ SPLIT SECTION (Ecozone Faq Layout 2)
         ===================================================================== --}}
    <section class="py-20 lg:py-32 bg-eco-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                <!-- Left Image Column -->
                <div class="lg:col-span-5">
                    <div class="rounded-3xl overflow-hidden shadow-xl border border-eco-border aspect-[4/4] bg-eco-forest/10">
                        <img
                            src="{{ asset($home['faq']['image']) }}"
                            alt="Community renewable energy workshop in West Africa"
                            class="w-full h-full object-cover"
                        >
                    </div>
                    <p
                        x-show="showPlaceholderBadges"
                        class="mt-3 text-xs text-eco-body flex items-center gap-1.5"
                    >
                        <span class="px-2 py-0.5 rounded bg-white border border-eco-border text-eco-green font-semibold">Illustrative Photo</span>
                        <span>{{ $home['faq']['image_caption'] }}</span>
                    </p>
                </div>

                <!-- Right Accordion Column -->
                <div class="lg:col-span-7" x-data="{ activeAccordion: 0 }">
                    <x-public.section-heading
                        align="left"
                        :subtitle="$home['faq']['subtitle']"
                        :title="$home['faq']['title']"
                    />

                    <div class="mt-8 space-y-4">
                        @foreach ($home['faq']['items'] as $faqIndex => $faqItem)
                            <div class="rounded-2xl bg-white border transition-colors duration-200 overflow-hidden"
                                 :class="activeAccordion === {{ $faqIndex }} ? 'border-eco-green shadow-md' : 'border-eco-border/80'">
                                <button
                                    type="button"
                                    @click="activeAccordion = (activeAccordion === {{ $faqIndex }} ? null : {{ $faqIndex }})"
                                    class="w-full px-6 py-5 text-left flex items-center justify-between gap-4 cursor-pointer"
                                    :aria-expanded="activeAccordion === {{ $faqIndex }}"
                                >
                                    <span class="text-base sm:text-lg font-heading font-bold text-eco-heading">
                                        {{ $faqItem['question'] }}
                                    </span>
                                    <span
                                        class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 transition-colors"
                                        :class="activeAccordion === {{ $faqIndex }} ? 'bg-eco-green text-white' : 'bg-eco-surface text-eco-heading'"
                                    >
                                        <svg class="w-4 h-4 transition-transform duration-200" :class="activeAccordion === {{ $faqIndex }} ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </span>
                                </button>
                                <div
                                    x-cloak
                                    x-show="activeAccordion === {{ $faqIndex }}"
                                    x-collapse
                                    class="px-6 pb-6 text-sm sm:text-base text-eco-body leading-relaxed border-t border-eco-border/50 pt-4"
                                >
                                    {{ $faqItem['answer'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =====================================================================
         SECTION 7: ADVOCACY CAMPAIGNS & INITIATIVES (Ecozone Campaign Layout 1)
         ===================================================================== --}}
    <section id="campaigns-section" class="py-20 lg:py-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12">
                <x-public.section-heading
                    align="left"
                    :subtitle="$home['campaigns']['subtitle']"
                    :title="$home['campaigns']['title']"
                />
                <div class="shrink-0">
                    <a href="{{ route('campaigns') }}" class="btn-eco-outline">
                        <span>View All Campaigns</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <div
                x-show="showPlaceholderBadges"
                class="mb-8 p-3.5 rounded-2xl bg-eco-mint-soft/70 border border-eco-mint text-xs text-eco-forest flex items-center gap-2"
            >
                <span class="px-2 py-0.5 rounded bg-eco-green text-white font-heading font-bold uppercase text-[10px]">Illustrative Preview</span>
                <span>{{ $home['campaigns']['disclaimer'] }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($home['campaigns']['items'] as $campaign)
                    <article class="rounded-3xl bg-white border border-eco-border overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="relative aspect-[16/10] overflow-hidden bg-eco-forest/10">
                                <img
                                    src="{{ asset($campaign['image']) }}"
                                    alt="{{ $campaign['title'] }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                >
                                <span class="absolute top-4 left-4 px-3.5 py-1 rounded-full bg-eco-forest/85 backdrop-blur-xs text-eco-mint text-xs font-heading font-semibold">
                                    {{ $campaign['category'] }}
                                </span>
                            </div>

                            <div class="p-7">
                                <h3 class="text-xl font-heading font-bold text-eco-heading group-hover:text-eco-green transition-colors leading-snug">
                                    {{ $campaign['title'] }}
                                </h3>
                                <p class="mt-3 text-sm text-eco-body leading-relaxed">
                                    {{ $campaign['description'] }}
                                </p>

                                <!-- Ecozone Campaign Progress Bar Structure -->
                                <div class="mt-6 pt-5 border-t border-eco-border/70">
                                    <div class="flex items-center justify-between text-xs font-heading font-bold mb-2">
                                        <span class="text-eco-heading">{{ $campaign['status_label'] }}</span>
                                        <span class="text-eco-green">{{ $campaign['progress_percent'] }}% Structurally Mapped</span>
                                    </div>
                                    <div class="w-full h-2.5 rounded-full bg-eco-surface overflow-hidden">
                                        <div class="h-full rounded-full bg-eco-green" style="width: {{ $campaign['progress_percent'] }}%"></div>
                                    </div>
                                    <p x-show="showPlaceholderBadges" class="mt-2 text-[11px] text-amber-800 font-medium">
                                        {{ $campaign['target_note'] }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="px-7 pb-7">
                            <a href="{{ route('contact') }}" class="btn-eco-primary w-full justify-center !py-3">
                                <span>{{ $campaign['cta_label'] }}</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- =====================================================================
         SECTION 8: STAKEHOLDER VOICES / TESTIMONIALS (Ecozone Testimonial Layout 1)
         ===================================================================== --}}
    <section class="py-20 lg:py-28 bg-eco-surface relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                :subtitle="$home['testimonials']['subtitle']"
                :title="$home['testimonials']['title']"
            />

            <div
                x-show="showPlaceholderBadges"
                class="mt-6 max-w-3xl mx-auto p-3.5 rounded-2xl bg-amber-50 border border-amber-200 text-xs text-amber-900 text-center"
            >
                {{ $home['testimonials']['disclaimer'] }}
            </div>

            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($home['testimonials']['items'] as $testimonial)
                    <div class="bg-white rounded-3xl p-8 border border-eco-border/80 shadow-xs flex flex-col justify-between relative">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <!-- 5-Star Visual Motif from Ecozone Reference -->
                                <div class="flex items-center gap-1 text-eco-green">
                                    @for ($i = 0; $i < 5; $i++)
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-[11px] font-heading font-semibold px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-900">
                                    {{ $testimonial['badge'] }}
                                </span>
                            </div>

                            <p class="text-sm sm:text-base text-eco-body italic leading-relaxed">
                                "{{ $testimonial['quote'] }}"
                            </p>
                        </div>

                        <div class="mt-6 pt-5 border-t border-eco-border/60 flex items-center gap-3.5">
                            <div class="w-11 h-11 rounded-full bg-eco-mint-soft text-eco-green font-heading font-bold text-sm flex items-center justify-center shrink-0">
                                EW
                            </div>
                            <div>
                                <div class="text-sm font-heading font-bold text-eco-heading">{{ $testimonial['name'] }}</div>
                                <div class="text-xs text-eco-body">{{ $testimonial['role'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- =====================================================================
         SECTION 9: DEDICATED TEAM & ADVOCATES (Ecozone Team Layout 1)
         ===================================================================== --}}
    <section class="py-20 lg:py-32 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                :subtitle="$home['team']['subtitle']"
                :title="$home['team']['title']"
            />

            <div
                x-show="showPlaceholderBadges"
                class="mt-6 max-w-2xl mx-auto p-3.5 rounded-2xl bg-amber-50 border border-amber-200 text-xs text-amber-900 text-center"
            >
                {{ $home['team']['disclaimer'] }}
            </div>

            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($home['team']['members'] as $member)
                    <div class="rounded-3xl bg-eco-surface border border-eco-border/80 overflow-hidden group hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                        <!-- Portrait Placeholder Area (No Fake AI Staff Faces per Brief) -->
                        <div class="aspect-[4/4] bg-gradient-to-br from-eco-forest via-eco-green-dark to-eco-navy relative flex flex-col items-center justify-center p-6 text-center text-white">
                            <div class="w-20 h-20 rounded-full bg-white/15 border border-white/30 flex items-center justify-center text-2xl font-heading font-bold text-eco-mint mb-3">
                                {{ $member['initials'] }}
                            </div>
                            <span class="text-[11px] font-heading font-semibold uppercase tracking-wider px-3 py-1 rounded-full bg-black/30 text-eco-mint">
                                Official Staff Photo Pending
                            </span>
                        </div>

                        <div class="p-6">
                            <span class="text-[11px] font-heading font-bold uppercase tracking-wider text-eco-green">
                                {{ $member['designation'] }}
                            </span>
                            <h3 class="text-lg font-heading font-bold text-eco-heading mt-1">
                                {{ $member['name'] }}
                            </h3>
                            <p class="mt-2.5 text-xs sm:text-sm text-eco-body leading-relaxed">
                                {{ $member['bio'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- =====================================================================
         SECTION 10: FULL-WIDTH VOLUNTEER / PARTNER CTA BANNER (Ecozone CTA Layout 1)
         ===================================================================== --}}
    <section id="cta-section" class="py-16 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative rounded-3xl overflow-hidden shadow-2xl bg-eco-forest text-white">
                <img
                    src="{{ asset($home['cta_banner']['background_image']) }}"
                    alt="Renewable energy solar array backdrop"
                    class="absolute inset-0 w-full h-full object-cover opacity-25"
                >
                <div class="absolute inset-0 bg-gradient-to-r from-eco-forest via-eco-forest/90 to-eco-green-dark/85"></div>

                <div class="relative z-10 p-8 sm:p-12 lg:p-16 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-8 space-y-4">
                        <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/15 text-eco-mint text-xs font-heading font-bold uppercase tracking-widest">
                            {{ $home['cta_banner']['eyebrow'] }}
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-heading font-bold text-white leading-tight">
                            {{ $home['cta_banner']['title'] }}
                        </h2>
                        <p class="text-white/85 text-sm sm:text-base max-w-2xl leading-relaxed">
                            {{ $home['cta_banner']['description'] }}
                        </p>
                    </div>

                    <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3.5 justify-end">
                        <a href="{{ route($home['cta_banner']['primary_btn']['route']) }}" class="btn-eco-primary justify-center">
                            <span>{{ $home['cta_banner']['primary_btn']['label'] }}</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="{{ route($home['cta_banner']['secondary_btn']['route']) }}" class="btn-eco-white justify-center">
                            <span>{{ $home['cta_banner']['secondary_btn']['label'] }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =====================================================================
         SECTION 11: LATEST NEWS & BLOG UPDATES (Ecozone Blog Layout 1)
         ===================================================================== --}}
    <section id="blog-section" class="py-20 lg:py-28 bg-eco-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12">
                <x-public.section-heading
                    align="left"
                    :subtitle="$home['blogs']['subtitle']"
                    :title="$home['blogs']['title']"
                />
                <div class="shrink-0">
                    <a href="{{ route('blog') }}" class="btn-eco-outline">
                        <span>Explore All Articles</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($home['blogs']['items'] as $post)
                    <article class="bg-white rounded-3xl border border-eco-border/80 overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="relative aspect-[16/10] overflow-hidden bg-eco-forest/10">
                                <img
                                    src="{{ asset($post['image']) }}"
                                    alt="{{ $post['title'] }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                >
                                <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-eco-green text-white text-xs font-heading font-semibold shadow-xs">
                                    {{ $post['category'] }}
                                </span>
                            </div>

                            <div class="p-7">
                                <div class="flex items-center gap-3 text-xs text-eco-body mb-3">
                                    <span>{{ $post['author'] }}</span>
                                    <span>•</span>
                                    <span>{{ $post['read_time'] }}</span>
                                </div>

                                <h3 class="text-xl font-heading font-bold text-eco-heading group-hover:text-eco-green transition-colors leading-snug">
                                    <a href="{{ route('blog') }}">{{ $post['title'] }}</a>
                                </h3>

                                <p class="mt-3 text-sm text-eco-body leading-relaxed">
                                    {{ $post['excerpt'] }}
                                </p>
                            </div>
                        </div>

                        <div class="px-7 pb-7 pt-2">
                            <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 text-sm font-heading font-bold text-eco-green hover:text-eco-forest transition">
                                <span>Read More</span>
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.public>

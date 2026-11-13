<x-layouts.public
    :title="'About Us — ' . ($site['name'] ?? 'Ecowattage')"
    :metaDescription="'Learn about Ecowattage, our mission, vision, core values, leadership team, and roadmap for clean energy advocacy and manufacturing in Africa.'"
    :site="$site"
    :navigation="$navigation"
>
    {{-- Page Breadcrumb Hero Banner --}}
    <x-public.page-hero
        title="About Us"
        image="/images/illustrative/about-engineering-field.jpg"
    />

    {{-- =====================================================================
         SECTION 1: DETAILED STORY & MISSION (Ecozone About Layout 1)
         ===================================================================== --}}
    <section class="py-20 lg:py-28 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                <!-- Left Asymmetric Imagery with Video-style Overview -->
                <div class="lg:col-span-6 relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-eco-border aspect-[4/3] bg-eco-forest/10">
                        <img
                            src="{{ asset($about['overview']['image']) }}"
                            alt="Ecowattage renewable energy engineers reviewing power schematics"
                            class="w-full h-full object-cover"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-eco-forest/70 via-transparent to-transparent"></div>

                        <!-- Brand Badge Overlay -->
                        <div class="absolute bottom-6 left-6 right-6 bg-white/95 backdrop-blur-md p-5 rounded-2xl shadow-lg border border-eco-border/80 flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-eco-green text-white flex items-center justify-center shrink-0 shadow-md">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div>
                                <span class="text-xs font-heading font-bold uppercase tracking-wider text-eco-green">Ecowattage Ethos</span>
                                <p class="text-sm font-heading font-bold text-eco-heading">Local Capacity &amp; African Clean Energy Dignity</p>
                            </div>
                        </div>
                    </div>

                    <p
                        x-show="showPlaceholderBadges"
                        class="mt-3 text-xs text-eco-body flex items-center gap-1.5"
                    >
                        <span class="px-2 py-0.5 rounded bg-eco-mint-soft text-eco-green font-semibold">Illustrative Photo</span>
                        <span>{{ $about['overview']['image_caption'] }}</span>
                    </p>
                </div>

                <!-- Right Narrative & Core Highlights -->
                <div class="lg:col-span-6 space-y-6">
                    <x-public.section-heading
                        align="left"
                        :subtitle="$about['overview']['subtitle']"
                        :title="$about['overview']['title']"
                    />

                    <div class="space-y-4 text-base sm:text-lg text-eco-body leading-relaxed">
                        @foreach ($about['overview']['description_paragraphs'] as $p)
                            <p>{{ $p }}</p>
                        @endforeach
                    </div>

                    <!-- Highlight Icons List -->
                    <div class="pt-4 space-y-4">
                        @foreach ($about['overview']['highlights'] as $highlight)
                            <div class="flex items-start gap-4 p-4 rounded-2xl bg-eco-surface border border-eco-border/70 hover:border-eco-green/40 transition">
                                <div class="w-9 h-9 rounded-xl bg-eco-green text-white flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-base font-heading font-bold text-eco-heading">{{ $highlight['title'] }}</h4>
                                    <p class="text-sm text-eco-body mt-0.5 leading-relaxed">{{ $highlight['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =====================================================================
         SECTION 2: VISION, MISSION & VALUES (Cards Grid)
         ===================================================================== --}}
    <section class="py-20 lg:py-28 bg-eco-forest text-white relative overflow-hidden">
        <!-- Decorative Vector Pattern -->
        <div class="absolute inset-0 pointer-events-none opacity-10">
            <svg class="w-full h-full" viewBox="0 0 1440 600" fill="none">
                <circle cx="200" cy="300" r="250" stroke="#00A86B" stroke-width="2" />
                <circle cx="1200" cy="150" r="180" stroke="#C8E6C9" stroke-width="1.5" stroke-dasharray="6 6" />
            </svg>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                light
                subtitle="Guiding Principles"
                title="Our Mission, Vision & Core Values"
                description="The core convictions that shape our community work, research, and technical roadmap."
            />

            <div class="mt-14 grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Mission Card -->
                <div class="card-3d-tilt p-8 sm:p-10 rounded-3xl bg-white/10 backdrop-blur-md border border-white/15 relative overflow-hidden transition-all duration-300 transform-gpu">
                    <div class="w-14 h-14 rounded-2xl bg-eco-green text-white flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-xs font-heading font-bold uppercase tracking-widest text-eco-mint">Primary Mandate</span>
                    <h3 class="text-2xl font-heading font-bold text-white mt-1">{{ $about['vision_mission']['mission']['title'] }}</h3>
                    <p class="mt-4 text-base text-white/85 leading-relaxed">
                        {{ $about['vision_mission']['mission']['statement'] }}
                    </p>
                </div>

                <!-- Vision Card -->
                <div class="card-3d-tilt p-8 sm:p-10 rounded-3xl bg-white/10 backdrop-blur-md border border-white/15 relative overflow-hidden transition-all duration-300 transform-gpu">
                    <div class="w-14 h-14 rounded-2xl bg-eco-blue text-white flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <span class="text-xs font-heading font-bold uppercase tracking-widest text-eco-mint">Future Horizon</span>
                    <h3 class="text-2xl font-heading font-bold text-white mt-1">{{ $about['vision_mission']['vision']['title'] }}</h3>
                    <p class="mt-4 text-base text-white/85 leading-relaxed">
                        {{ $about['vision_mission']['vision']['statement'] }}
                    </p>
                </div>
            </div>

            <!-- Core Values Trio -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($about['vision_mission']['values'] as $valueName => $valueDesc)
                    <div class="p-6 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/10 transition">
                        <h4 class="text-lg font-heading font-bold text-eco-mint">{{ $valueName }}</h4>
                        <p class="mt-2 text-sm text-white/80 leading-relaxed">{{ $valueDesc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- =====================================================================
         SECTION 3: WHAT WE DO & INITIATIVES (Ecozone AditionalFeature Layout 7)
         ===================================================================== --}}
    <section class="py-20 lg:py-28 bg-eco-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                :subtitle="$about['initiatives']['subtitle']"
                :title="$about['initiatives']['title']"
            />

            <div class="mt-14 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($about['initiatives']['items'] as $item)
                    <div class="bg-white rounded-3xl p-7 border border-eco-border/80 shadow-xs hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <span class="inline-block text-xs font-heading font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-eco-mint-soft text-eco-green border border-eco-mint mb-5">
                                {{ $item['tag'] }}
                            </span>
                            <h3 class="text-xl font-heading font-bold text-eco-heading">{{ $item['title'] }}</h3>
                            <p class="mt-3 text-sm text-eco-body leading-relaxed">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- =====================================================================
         SECTION 4: IMPACT STATISTICS STRIP (Ecozone FunFact Layout 1)
         ===================================================================== --}}
    <section class="py-16 lg:py-20 bg-white border-y border-eco-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                x-show="showPlaceholderBadges"
                class="mb-8 p-4 rounded-2xl bg-amber-50 border border-amber-200 text-xs text-amber-900 flex items-center gap-3"
            >
                <span class="px-2 py-0.5 rounded bg-amber-200 font-heading font-bold uppercase text-[10px]">Metrics Notice</span>
                <span>{{ $funfacts['disclaimer'] }}</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($funfacts['items'] as $fact)
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
         SECTION 5: FUTURE MANUFACTURING ROADMAP (Strategic Phasing)
         ===================================================================== --}}
    <section class="py-20 lg:py-28 bg-eco-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                :subtitle="$about['manufacturing_roadmap']['subtitle']"
                :title="$about['manufacturing_roadmap']['title']"
                :description="$about['manufacturing_roadmap']['description']"
            />

            <div class="mt-14 grid grid-cols-1 md:grid-cols-3 gap-8 relative">
                @foreach ($about['manufacturing_roadmap']['phases'] as $idx => $phase)
                    <div class="bg-white rounded-3xl p-8 border border-eco-border/80 shadow-xs relative flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <span class="w-10 h-10 rounded-xl bg-eco-green text-white font-heading font-bold flex items-center justify-center text-sm">
                                    0{{ $idx + 1 }}
                                </span>
                                <span class="text-xs font-heading font-semibold px-2.5 py-1 rounded-full {{ $idx === 0 ? 'bg-eco-green/15 text-eco-green-dark border border-eco-green/30' : 'bg-eco-surface text-eco-body' }}">
                                    {{ $phase['status'] }}
                                </span>
                            </div>
                            <h3 class="text-xl font-heading font-bold text-eco-heading">{{ $phase['phase'] }}</h3>
                            <p class="mt-3 text-sm text-eco-body leading-relaxed">{{ $phase['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- =====================================================================
         SECTION 6: LEADERSHIP TEAM & ADVOCATES (Ecozone Team Layout 1)
         ===================================================================== --}}
    <section class="py-20 lg:py-28 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                :subtitle="$about['team']['subtitle']"
                :title="$about['team']['title']"
            />

            <div
                x-show="showPlaceholderBadges"
                class="mt-6 max-w-2xl mx-auto p-3.5 rounded-2xl bg-amber-50 border border-amber-200 text-xs text-amber-900 text-center"
            >
                {{ $about['team']['disclaimer'] }}
            </div>

            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($about['team']['members'] as $member)
                    <div class="rounded-3xl bg-eco-surface border border-eco-border/80 overflow-hidden group hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                        <!-- Portrait Placeholder Area -->
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
         SECTION 7: CALL TO ACTION BANNER (Ecozone CTA Layout 1)
         ===================================================================== --}}
    <section class="py-16 lg:py-24 bg-eco-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative rounded-3xl overflow-hidden shadow-2xl bg-eco-forest text-white p-8 sm:p-12 lg:p-16">
                <div class="absolute inset-0 pointer-events-none opacity-20">
                    <img
                        src="{{ asset('/images/illustrative/hero-solar-microgrid.jpg') }}"
                        alt="Solar energy backdrop"
                        class="w-full h-full object-cover"
                    >
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-eco-forest via-eco-forest/90 to-eco-green-dark/85"></div>

                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-8 space-y-4">
                        <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/15 text-eco-mint text-xs font-heading font-bold uppercase tracking-widest">
                            Partner With Us
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-heading font-bold text-white leading-tight">
                            Help Us Power Africa's Green Future Through Community &amp; Institutional Partnerships
                        </h2>
                        <p class="text-white/85 text-sm sm:text-base max-w-2xl leading-relaxed">
                            Join our network of advocacy partners, educational collaborators, and clean-tech champions across Africa.
                        </p>
                    </div>

                    <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3.5 justify-end">
                        <a href="{{ route('contact') }}" class="btn-eco-primary justify-center">
                            <span>Get in Touch With Us</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="{{ route('services') }}" class="btn-eco-white justify-center">
                            <span>Explore Solutions &amp; Services</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>

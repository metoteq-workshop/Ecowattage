<x-layouts.public
    :title="'Advocacy Campaigns — ' . ($site['name'] ?? 'Ecowattage')"
    :metaDescription="'Discover Ecowattage renewable energy advocacy campaigns across Sierra Leone and Africa: public literacy, solar healthcare, energy efficiency, and clean water.'"
    :site="$site"
    :navigation="$navigation"
>
    {{-- Page Breadcrumb Hero Banner --}}
    <x-public.page-hero
        title="Advocacy Campaigns"
        image="/images/illustrative/hero-solar-microgrid.jpg"
    />

    {{-- =====================================================================
         SECTION 1: CAMPAIGNS GRID & MILESTONES (Ecozone Campaign Layout)
         ===================================================================== --}}
    <section class="py-20 lg:py-28 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                :subtitle="$campaignsData['header']['subtitle']"
                :title="$campaignsData['header']['title']"
                :description="$campaignsData['header']['description']"
            />

            <!-- Transparency / Content Notice -->
            <div
                x-show="showPlaceholderBadges"
                class="mt-8 max-w-4xl mx-auto p-4 rounded-2xl bg-eco-mint-soft/80 border border-eco-mint text-xs text-eco-forest flex items-start sm:items-center gap-3"
            >
                <span class="px-2 py-0.5 rounded bg-eco-green text-white font-heading font-bold uppercase text-[10px] shrink-0">
                    Campaign Scope Notice
                </span>
                <span>
                    The campaigns below represent Ecowattage's active advocacy focus areas. Specific progress percentages, targets, and milestones are structural layout templates ready to be populated with official metrics via the Stage 2 CMS.
                </span>
            </div>

            <!-- 6 Campaigns Grid (Ecozone Style Cards with 3D Tilt) -->
            <div class="mt-14 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($campaignsData['campaigns_list'] as $campaign)
                    <article
                        id="{{ $campaign['id'] }}"
                        class="card-3d-tilt bg-white rounded-3xl border border-eco-border/80 shadow-xs hover:shadow-2xl transition-all duration-300 flex flex-col justify-between overflow-hidden group transform-gpu"
                    >
                        <div>
                            <!-- Campaign Visual Banner -->
                            <div class="relative aspect-[16/10] overflow-hidden bg-eco-forest/10">
                                <img
                                    src="{{ asset($campaign['image']) }}"
                                    alt="{{ $campaign['title'] }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-eco-forest/70 via-transparent to-transparent"></div>

                                <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-eco-forest/90 backdrop-blur-xs text-eco-mint text-xs font-heading font-semibold">
                                    {{ $campaign['category'] }}
                                </span>

                                <span class="absolute bottom-3 right-4 px-2.5 py-0.5 rounded-full bg-eco-green text-white text-[11px] font-heading font-bold">
                                    {{ $campaign['status'] }}
                                </span>
                            </div>

                            <div class="p-7 sm:p-8">
                                <h3 class="text-xl sm:text-2xl font-heading font-bold text-eco-heading group-hover:text-eco-green transition-colors leading-snug">
                                    {{ $campaign['title'] }}
                                </h3>

                                <p class="mt-3 text-sm text-eco-body leading-relaxed">
                                    {{ $campaign['summary'] }}
                                </p>

                                <!-- Ecozone Milestone / Progress Indicator -->
                                <div class="mt-6 pt-5 border-t border-eco-border/70">
                                    <div class="flex items-center justify-between text-xs font-heading font-bold mb-2">
                                        <span class="text-eco-heading">{{ $campaign['milestone_label'] }}</span>
                                        <span class="text-eco-green">{{ $campaign['progress_percent'] }}% Mapped</span>
                                    </div>
                                    <div class="w-full h-2 rounded-full bg-eco-surface overflow-hidden">
                                        <div
                                            class="h-full rounded-full bg-eco-green transition-all duration-700"
                                            style="width: {{ $campaign['progress_percent'] }}%"
                                        ></div>
                                    </div>
                                    <p
                                        x-show="showPlaceholderBadges"
                                        class="mt-2 text-[11px] text-amber-800 font-medium"
                                    >
                                        {{ $campaign['target_note'] }}
                                    </p>
                                </div>

                                <!-- Key Achievements / Objectives -->
                                <div class="mt-5 space-y-2 text-xs sm:text-sm text-eco-body">
                                    @foreach ($campaign['achievements'] as $ach)
                                        <div class="flex items-start gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-eco-green mt-1.5 shrink-0"></span>
                                            <span>{{ $ach }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- CTA Button -->
                        <div class="px-7 sm:px-8 pb-7 sm:pb-8 pt-2">
                            <a
                                href="{{ route('contact') }}"
                                class="btn-eco-primary w-full justify-center !py-3 text-xs sm:text-sm font-semibold"
                            >
                                <span>{{ $campaign['cta_label'] }}</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
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
         SECTION 2: PARTICIPATION / HOW TO ENGAGE (3 Options)
         ===================================================================== --}}
    <section class="py-20 lg:py-28 bg-eco-surface relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                :subtitle="$campaignsData['action_options']['subtitle']"
                :title="$campaignsData['action_options']['title']"
                description="Our campaigns rely on multi-stakeholder partnerships connecting institutions, communities, educators, and international champions."
            />

            <div class="mt-14 grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($campaignsData['action_options']['items'] as $opt)
                    <div class="bg-white rounded-3xl p-8 sm:p-9 border border-eco-border/80 shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <span class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-eco-mint-soft text-eco-green font-heading font-extrabold text-lg mb-6">
                                {{ $opt['number'] }}
                            </span>
                            <h3 class="text-xl sm:text-2xl font-heading font-bold text-eco-heading">
                                {{ $opt['title'] }}
                            </h3>
                            <p class="mt-3 text-sm sm:text-base text-eco-body leading-relaxed">
                                {{ $opt['desc'] }}
                            </p>
                        </div>

                        <div class="mt-8 pt-5 border-t border-eco-border/70">
                            <a
                                href="{{ route($opt['route']) }}"
                                class="inline-flex items-center gap-2 text-sm font-heading font-bold text-eco-green hover:text-eco-forest transition"
                            >
                                <span>{{ $opt['cta'] }}</span>
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
         SECTION 3: IMPACT STATS STRIP (Ecozone FunFact Layout 1)
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
         SECTION 4: CALL TO ACTION BANNER (Ecozone CTA Layout 1)
         ===================================================================== --}}
    <section class="py-16 lg:py-24 bg-eco-forest text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-eco-forest via-eco-forest/95 to-eco-green-dark/90 p-8 sm:p-12 lg:p-16 border border-white/10 shadow-2xl">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-8 space-y-4">
                        <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/15 text-eco-mint text-xs font-heading font-bold uppercase tracking-widest">
                            Join the Movement
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-heading font-bold text-white leading-tight">
                            Co-Sponsor or Support a Clean Energy Campaign in Your Region
                        </h2>
                        <p class="text-white/85 text-sm sm:text-base max-w-2xl leading-relaxed">
                            Every school electrified, clinic powered, and technician trained creates lasting resilience. Let's make it happen together.
                        </p>
                    </div>

                    <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3.5 justify-end">
                        <a href="{{ route('contact') }}" class="btn-eco-primary justify-center">
                            <span>Sponsor a Campaign</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="{{ route('partners-careers') }}" class="btn-eco-white justify-center">
                            <span>Volunteer With Us</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>

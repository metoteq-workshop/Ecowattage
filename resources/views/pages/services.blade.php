<x-layouts.public
    :title="'Solutions & Services — ' . ($site['name'] ?? 'Ecowattage')"
    :metaDescription="'Explore Ecowattage renewable energy solutions: clean energy advocacy, community literacy, engineering advisory, and future African clean-tech manufacturing.'"
    :site="$site"
    :navigation="$navigation"
>
    {{-- Page Breadcrumb Hero Banner --}}
    <x-public.page-hero
        title="Solutions & Services"
        image="/images/illustrative/hero-energy-education.jpg"
    />

    {{-- =====================================================================
         SECTION 1: OVERVIEW & SERVICES GRID (Ecozone Service Layout 5)
         ===================================================================== --}}
    <section class="py-20 lg:py-28 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                :subtitle="$servicesData['header']['subtitle']"
                :title="$servicesData['header']['title']"
                :description="$servicesData['header']['description']"
            />

            <!-- 6 Services Grid (Ecozone Layout 5 style) -->
            <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($servicesData['services_list'] as $service)
                    <article
                        id="{{ $service['id'] }}"
                        class="card-3d-tilt bg-white rounded-3xl border border-eco-border/80 shadow-xs hover:shadow-2xl transition-all duration-300 flex flex-col justify-between overflow-hidden group transform-gpu"
                    >
                        <div>
                            <!-- Service Illustrative Image -->
                            <div class="relative aspect-[16/10] overflow-hidden bg-eco-forest/10">
                                <img
                                    src="{{ asset($service['image']) }}"
                                    alt="{{ $service['title'] }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-eco-forest/60 via-transparent to-transparent"></div>
                                
                                <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-eco-forest/85 backdrop-blur-xs text-eco-mint text-xs font-heading font-semibold">
                                    {{ $service['category'] }}
                                </span>
                                
                                <span class="absolute bottom-3 right-4 text-xs font-heading font-extrabold text-white/90">
                                    {{ $service['number'] }}
                                </span>
                            </div>

                            <div class="p-7 sm:p-8">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-xs font-heading font-bold uppercase tracking-wider text-eco-green">
                                        {{ $service['badge'] }}
                                    </span>
                                </div>

                                <h3 class="text-xl sm:text-2xl font-heading font-bold text-eco-heading group-hover:text-eco-green transition-colors leading-snug">
                                    {{ $service['title'] }}
                                </h3>

                                <p class="mt-3 text-sm sm:text-base text-eco-body leading-relaxed">
                                    {{ $service['summary'] }}
                                </p>

                                <!-- Key Feature Deliverables -->
                                <ul class="mt-5 space-y-2.5 pt-4 border-t border-eco-border/70 text-xs sm:text-sm text-eco-body">
                                    @foreach ($service['details'] as $detail)
                                        <li class="flex items-start gap-2.5">
                                            <svg class="w-4 h-4 text-eco-green shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span>{{ $detail }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="px-7 sm:px-8 pb-7 sm:pb-8 pt-2">
                            <a
                                href="{{ route('contact') }}"
                                class="btn-eco-outline w-full justify-center !py-2.5 text-xs sm:text-sm font-semibold group-hover:bg-eco-green group-hover:text-white"
                            >
                                <span>Inquire About This Service</span>
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
         SECTION 2: 4-STEP METHODOLOGY / PROCESS SECTION
         ===================================================================== --}}
    <section class="py-20 lg:py-28 bg-eco-surface relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                :subtitle="$servicesData['process']['subtitle']"
                :title="$servicesData['process']['title']"
                description="Our structured 4-step framework bridges awareness, localized training, robust engineering, and long-term African technical independence."
            />

            <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 relative">
                @foreach ($servicesData['process']['steps'] as $idx => $step)
                    <div class="bg-white rounded-3xl p-8 border border-eco-border/80 shadow-xs relative flex flex-col justify-between hover:shadow-xl transition-all duration-300">
                        <div>
                            <div class="w-12 h-12 rounded-2xl bg-eco-green text-white font-heading font-extrabold flex items-center justify-center text-lg mb-6 shadow-md shadow-eco-green/30">
                                {{ $step['step'] }}
                            </div>
                            <h3 class="text-xl font-heading font-bold text-eco-heading mb-3">
                                {{ $step['title'] }}
                            </h3>
                            <p class="text-sm text-eco-body leading-relaxed">
                                {{ $step['desc'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- =====================================================================
         SECTION 3: SERVICE INQUIRY FAQ (Ecozone Accordion)
         ===================================================================== --}}
    <section class="py-20 lg:py-28 bg-white" x-data="{ activeFaq: 0 }">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                :subtitle="$servicesData['faq']['subtitle']"
                :title="$servicesData['faq']['title']"
                description="Key questions about our advisory engagements, community projects, and future clean-tech manufacturing roadmap."
            />

            <div class="mt-12 space-y-4">
                @foreach ($servicesData['faq']['items'] as $fIdx => $fItem)
                    <div
                        class="rounded-2xl bg-eco-surface border transition-colors duration-200 overflow-hidden"
                        :class="activeFaq === {{ $fIdx }} ? 'border-eco-green shadow-md' : 'border-eco-border/80'"
                    >
                        <button
                            type="button"
                            @click="activeFaq = (activeFaq === {{ $fIdx }} ? null : {{ $fIdx }})"
                            class="w-full px-6 py-5 text-left flex items-center justify-between gap-4 cursor-pointer"
                            :aria-expanded="activeFaq === {{ $fIdx }}"
                        >
                            <span class="text-base sm:text-lg font-heading font-bold text-eco-heading">
                                {{ $fItem['q'] }}
                            </span>
                            <span
                                class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 transition-colors"
                                :class="activeFaq === {{ $fIdx }} ? 'bg-eco-green text-white' : 'bg-white text-eco-heading border border-eco-border'"
                            >
                                <svg class="w-4 h-4 transition-transform duration-200" :class="activeFaq === {{ $fIdx }} ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div
                            x-cloak
                            x-show="activeFaq === {{ $fIdx }}"
                            x-collapse
                            class="px-6 pb-6 text-sm sm:text-base text-eco-body leading-relaxed border-t border-eco-border/50 pt-4"
                        >
                            {{ $fItem['a'] }}
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
                            Ready to Collaborate?
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-heading font-bold text-white leading-tight">
                            Have a Renewable Energy Project, School Workshop, or Advisory Inquiry?
                        </h2>
                        <p class="text-white/85 text-sm sm:text-base max-w-2xl leading-relaxed">
                            Our team of clean energy advocates and engineers is ready to support your community, NGO, clinic, or institution.
                        </p>
                    </div>

                    <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3.5 justify-end">
                        <a href="{{ route('contact') }}" class="btn-eco-primary justify-center">
                            <span>Request an Advisory Consultation</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="{{ route('home') }}#campaigns-section" class="btn-eco-white justify-center">
                            <span>Explore Active Campaigns</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>

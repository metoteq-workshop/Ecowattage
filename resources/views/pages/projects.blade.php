<x-layouts.public
    :title="'Projects Showcase — ' . ($site['name'] ?? 'Ecowattage')"
    :metaDescription="'Explore Ecowattage renewable energy project blueprints across Sierra Leone and Africa: solar microgrids, rural clinic solarization, micro-hydro feasibility, and clean-tech R&D.'"
    :site="$site"
    :navigation="$navigation"
>
    {{-- Page Breadcrumb Hero Banner --}}
    <x-public.page-hero
        title="Projects Showcase"
        image="/images/illustrative/project-wind-solar-hybrid.jpg"
    />

    {{-- =====================================================================
         SECTION 1: FEATURED BLUEPRINT SPOTLIGHT (Ecozone ProjectDetails Layout 1)
         ===================================================================== --}}
    <section class="py-20 lg:py-28 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                :subtitle="$projectsData['header']['subtitle']"
                :title="$projectsData['header']['title']"
                :description="$projectsData['header']['description']"
            />

            <!-- Transparency / Content Notice -->
            <div
                x-show="showPlaceholderBadges"
                class="mt-8 max-w-4xl mx-auto p-4 rounded-2xl bg-eco-mint-soft/80 border border-eco-mint text-xs text-eco-forest flex items-start sm:items-center gap-3"
            >
                <span class="px-2 py-0.5 rounded bg-eco-green text-white font-heading font-bold uppercase text-[10px] shrink-0">
                    Illustrative Blueprints
                </span>
                <span>{{ $projectsData['header']['disclaimer'] }}</span>
            </div>

            <!-- Featured ProjectDetails Card -->
            @php($featured = $projectsData['featured_blueprint'])
            <div class="mt-14 grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
                <!-- Left Visual + Specs Card -->
                <div class="lg:col-span-6 space-y-6">
                    <div class="card-3d-tilt relative rounded-3xl overflow-hidden shadow-xl border border-eco-border bg-eco-forest/5 transform-gpu">
                        <div class="aspect-[16/11] overflow-hidden">
                            <img
                                src="{{ asset($featured['image']) }}"
                                alt="{{ $featured['title'] }}"
                                class="w-full h-full object-cover"
                            >
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-eco-forest/75 via-transparent to-transparent pointer-events-none"></div>

                        <span class="absolute top-4 left-4 px-3.5 py-1.5 rounded-full bg-eco-green text-white text-xs font-heading font-bold shadow-md">
                            {{ $featured['badge'] }}
                        </span>

                        <div
                            x-show="showPlaceholderBadges"
                            class="absolute bottom-4 left-4 right-4 px-3.5 py-2 rounded-xl bg-eco-forest/85 backdrop-blur-xs text-white/95 text-xs border border-white/15"
                        >
                            {{ $featured['image_caption'] }}
                        </div>
                    </div>

                    <!-- Ecozone product_info_list style specification bar -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-6 rounded-2xl bg-eco-surface border border-eco-border/80">
                        <div>
                            <span class="text-[11px] font-heading font-bold uppercase tracking-wider text-eco-green block">Stage</span>
                            <span class="mt-1 text-sm font-heading font-bold text-eco-heading block">{{ $featured['status'] }}</span>
                        </div>
                        <div>
                            <span class="text-[11px] font-heading font-bold uppercase tracking-wider text-eco-green block">Target Location</span>
                            <span class="mt-1 text-xs font-medium text-amber-800 block">{{ $featured['location_placeholder'] }}</span>
                        </div>
                        <div>
                            <span class="text-[11px] font-heading font-bold uppercase tracking-wider text-eco-green block">System Capacity</span>
                            <span class="mt-1 text-xs font-medium text-amber-800 block">{{ $featured['capacity_placeholder'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right Objectives & Technical Scope -->
                <div class="lg:col-span-6 space-y-6">
                    <div>
                        <span class="inline-flex items-center gap-2 text-xs font-heading font-bold uppercase tracking-widest text-eco-green">
                            <span class="w-6 h-0.5 bg-eco-green rounded-full"></span>
                            {{ $featured['subtitle'] }}
                        </span>
                        <h3 class="mt-2 text-2xl sm:text-3xl font-heading font-bold text-eco-heading leading-tight">
                            {{ $featured['title'] }}
                        </h3>
                        <p class="mt-4 text-sm sm:text-base text-eco-body leading-relaxed">
                            {{ $featured['description'] }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        @foreach ($featured['scope_pillars'] as $index => $pillar)
                            <div class="p-5 rounded-2xl bg-eco-surface border border-eco-border/70 hover:border-eco-green/40 transition-colors">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-eco-mint-soft text-eco-green font-heading font-bold text-xs shrink-0">
                                        0{{ $index + 1 }}
                                    </span>
                                    <h4 class="font-heading font-bold text-sm sm:text-base text-eco-heading leading-snug">
                                        {{ $pillar['title'] }}
                                    </h4>
                                </div>
                                <p class="text-xs sm:text-sm text-eco-body leading-relaxed">
                                    {{ $pillar['subtitle'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-3 flex flex-wrap items-center gap-4">
                        <a href="{{ route('contact') }}" class="btn-eco-primary">
                            <span>Partner on This Blueprint</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="{{ route('services') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-full border border-eco-border text-sm font-heading font-bold text-eco-heading hover:border-eco-green hover:text-eco-green transition">
                            <span>Explore Our Capabilities</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =====================================================================
         SECTION 2: FILTERABLE PROJECTS GRID (Ecozone Projects Layout 1)
         ===================================================================== --}}
    <section
        id="project-portfolio"
        x-data="{
            activeCategory: 'All',
            selectedProject: null,
            projects: @js($projectsData['projects_list']),
            openProject(id) {
                this.selectedProject = this.projects.find((item) => item.id === id) || null;
            },
            closeProject() {
                this.selectedProject = null;
            }
        }"
        @keydown.escape.window="closeProject()"
        class="py-20 lg:py-28 bg-eco-surface relative overflow-hidden"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                subtitle="Structured Project Portfolio"
                title="Active Concepts & Technical Blueprints"
                description="Filter across Ecowattage's renewable energy deployment models—each structured for transparent location, capacity, and objective tracking."
            />

            <!-- Category Filter Pills -->
            <div class="mt-10 flex flex-wrap items-center justify-center gap-2.5 sm:gap-3" role="tablist" aria-label="Filter projects by category">
                @foreach ($projectsData['categories'] as $category)
                    <button
                        type="button"
                        @click="activeCategory = @js($category)"
                        :aria-selected="(activeCategory === @js($category)).toString()"
                        :class="activeCategory === @js($category)
                            ? 'bg-eco-green text-white border-eco-green shadow-md'
                            : 'bg-white text-eco-heading border-eco-border hover:border-eco-green hover:text-eco-green'"
                        class="px-5 py-2.5 rounded-full border text-xs sm:text-sm font-heading font-bold transition-all cursor-pointer"
                    >
                        {{ $category }}
                    </button>
                @endforeach
            </div>

            <!-- 6-Card Portfolio Grid -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($projectsData['projects_list'] as $project)
                    <article
                        id="{{ $project['id'] }}"
                        x-show="activeCategory === 'All' || activeCategory === @js($project['category'])"
                        x-transition.opacity.duration.250ms
                        class="card-3d-tilt bg-white rounded-3xl border border-eco-border/80 shadow-xs hover:shadow-2xl transition-all duration-300 flex flex-col justify-between overflow-hidden group transform-gpu"
                    >
                        <div>
                            <!-- Card Image -->
                            <div class="relative aspect-[16/10] overflow-hidden bg-eco-forest/10">
                                <img
                                    src="{{ asset($project['image']) }}"
                                    alt="{{ $project['title'] }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-eco-forest/75 via-transparent to-transparent"></div>

                                <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-eco-forest/90 backdrop-blur-xs text-eco-mint text-xs font-heading font-semibold">
                                    {{ $project['category'] }}
                                </span>

                                <span class="absolute bottom-3 right-4 px-2.5 py-0.5 rounded-full bg-eco-green text-white text-[11px] font-heading font-bold">
                                    {{ $project['status'] }}
                                </span>
                            </div>

                            <!-- Card Body -->
                            <div class="p-7 sm:p-8">
                                <h3 class="text-xl sm:text-2xl font-heading font-bold text-eco-heading group-hover:text-eco-green transition-colors leading-snug">
                                    {{ $project['title'] }}
                                </h3>

                                <p class="mt-3 text-sm text-eco-body leading-relaxed">
                                    {{ $project['summary'] }}
                                </p>

                                <!-- Structured Specs (Location & Capacity) -->
                                <div class="mt-5 pt-4 border-t border-eco-border/70 grid grid-cols-1 gap-2 text-xs">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="font-heading font-bold text-eco-heading">Location:</span>
                                        <span class="text-amber-800 font-medium text-right">{{ $project['location'] }}</span>
                                    </div>
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="font-heading font-bold text-eco-heading">Capacity:</span>
                                        <span class="text-eco-green font-semibold text-right">{{ $project['capacity'] }}</span>
                                    </div>
                                </div>

                                <!-- Core Objectives -->
                                <div class="mt-5 space-y-2 text-xs sm:text-sm text-eco-body">
                                    @foreach ($project['objectives'] as $objective)
                                        <div class="flex items-start gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-eco-green mt-1.5 shrink-0"></span>
                                            <span>{{ $objective }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Card Actions -->
                        <div class="px-7 sm:px-8 pb-7 sm:pb-8 pt-2 flex items-center gap-3">
                            <button
                                type="button"
                                @click="openProject(@js($project['id']))"
                                class="btn-eco-primary w-full justify-center !py-3 text-xs sm:text-sm font-semibold cursor-pointer"
                            >
                                <span>Inspect Blueprint</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        <!-- Blueprint Detail Modal -->
        <div
            x-show="selectedProject !== null"
            x-cloak
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-eco-forest/75 backdrop-blur-xs"
            @click.self="closeProject()"
            role="dialog"
            aria-modal="true"
            aria-label="Project Blueprint Details"
        >
            <div
                x-show="selectedProject !== null"
                x-transition
                class="bg-white rounded-3xl max-w-2xl w-full overflow-hidden shadow-2xl border border-eco-border max-h-[90vh] flex flex-col"
            >
                <template x-if="selectedProject">
                    <div class="overflow-y-auto">
                        <div class="relative aspect-[16/9] bg-eco-forest/10">
                            <img
                                :src="selectedProject.image"
                                :alt="selectedProject.title"
                                class="w-full h-full object-cover"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-eco-forest/80 via-transparent to-transparent"></div>
                            <button
                                type="button"
                                @click="closeProject()"
                                aria-label="Close blueprint modal"
                                class="absolute top-4 right-4 w-9 h-9 rounded-full bg-white/90 text-eco-forest hover:bg-white flex items-center justify-center shadow-md cursor-pointer"
                            >
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <div class="absolute bottom-4 left-6 right-6 flex flex-wrap items-center gap-2">
                                <span class="px-3 py-1 rounded-full bg-eco-green text-white text-xs font-heading font-bold" x-text="selectedProject.category"></span>
                                <span class="px-3 py-1 rounded-full bg-white/90 text-eco-forest text-xs font-heading font-bold" x-text="selectedProject.status"></span>
                            </div>
                        </div>

                        <div class="p-7 sm:p-8 space-y-5">
                            <h3 class="text-2xl font-heading font-bold text-eco-heading" x-text="selectedProject.title"></h3>
                            <p class="text-sm sm:text-base text-eco-body leading-relaxed" x-text="selectedProject.summary"></p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-2xl bg-eco-surface border border-eco-border">
                                <div>
                                    <span class="text-[11px] font-heading font-bold uppercase tracking-wider text-eco-green block">Location Slot</span>
                                    <span class="text-xs font-medium text-amber-800" x-text="selectedProject.location"></span>
                                </div>
                                <div>
                                    <span class="text-[11px] font-heading font-bold uppercase tracking-wider text-eco-green block">Capacity Spec</span>
                                    <span class="text-xs font-semibold text-eco-heading" x-text="selectedProject.capacity"></span>
                                </div>
                            </div>

                            <div>
                                <h4 class="text-sm font-heading font-bold uppercase tracking-wider text-eco-heading mb-3">
                                    Planned Technical &amp; Community Objectives
                                </h4>
                                <ul class="space-y-2.5">
                                    <template x-for="(obj, idx) in selectedProject.objectives" :key="idx">
                                        <li class="flex items-start gap-2.5 text-sm text-eco-body">
                                            <span class="w-2 h-2 rounded-full bg-eco-green mt-1.5 shrink-0"></span>
                                            <span x-text="obj"></span>
                                        </li>
                                    </template>
                                </ul>
                            </div>

                            <div class="pt-3 border-t border-eco-border flex flex-wrap items-center justify-between gap-3">
                                <a href="{{ route('contact') }}" class="btn-eco-primary">
                                    <span>Discuss Partnership</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                                <button
                                    type="button"
                                    @click="closeProject()"
                                    class="px-5 py-2.5 rounded-full border border-eco-border text-xs font-heading font-bold text-eco-heading hover:bg-eco-surface cursor-pointer"
                                >
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
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
                            Co-Develop Clean Energy
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-heading font-bold text-white leading-tight">
                            Propose a Site, Fund a Microgrid Pilot, or Request a Technical Brief
                        </h2>
                        <p class="text-white/85 text-sm sm:text-base max-w-2xl leading-relaxed">
                            Partner with Ecowattage to move clean energy blueprints from feasibility assessment to measurable community impact.
                        </p>
                    </div>

                    <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3.5 justify-end">
                        <a href="{{ route('contact') }}" class="btn-eco-primary justify-center">
                            <span>Propose a Project</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="{{ route('publications') }}" class="btn-eco-white justify-center">
                            <span>Explore Research</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>

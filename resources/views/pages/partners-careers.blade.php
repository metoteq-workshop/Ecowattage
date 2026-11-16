<x-layouts.public
    :title="'Partners & Careers — ' . ($site['name'] ?? 'Ecowattage')"
    :metaDescription="'Partner with Ecowattage on clean energy policy, community solar microgrids, and STEM education, or explore renewable energy engineering and apprenticeship pathways.'"
    :site="$site"
    :navigation="$navigation"
>
    {{-- Page Breadcrumb Hero Banner --}}
    <x-public.page-hero
        title="Partners & Careers"
        image="/images/illustrative/partners-careers-teamwork.jpg"
    />

    {{-- =====================================================================
         SECTION 1: STRATEGIC PARTNERSHIP PILLARS & CMS LOGO SLOTS
         ===================================================================== --}}
    <section class="py-20 lg:py-28 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                :subtitle="$partnersData['header']['subtitle']"
                :title="$partnersData['header']['title']"
                :description="$partnersData['header']['description']"
            />

            <!-- Transparency Notice -->
            <div
                x-show="showPlaceholderBadges"
                class="mt-8 max-w-4xl mx-auto p-4 rounded-2xl bg-eco-mint-soft/80 border border-eco-mint text-xs text-eco-forest flex items-start sm:items-center gap-3"
            >
                <span class="px-2 py-0.5 rounded bg-eco-green text-white font-heading font-bold uppercase text-[10px] shrink-0">
                    Institutional Notice
                </span>
                <span>{{ $partnersData['header']['disclaimer'] }}</span>
            </div>

            <!-- 4 Strategic Partnership Tracks -->
            <div class="mt-14 grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach ($partnersData['partnership_tracks'] as $track)
                    <article class="card-3d-tilt bg-eco-surface rounded-3xl p-8 sm:p-9 border border-eco-border/80 shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between transform-gpu">
                        <div>
                            <div class="flex items-center justify-between gap-4 mb-6">
                                <span class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-eco-mint-soft text-eco-green font-heading font-extrabold text-lg">
                                    {{ $track['number'] }}
                                </span>
                                <span class="px-3.5 py-1 rounded-full bg-white border border-eco-border text-xs font-heading font-bold text-eco-forest">
                                    {{ $track['badge'] }}
                                </span>
                            </div>

                            <h3 class="text-xl sm:text-2xl font-heading font-bold text-eco-heading leading-snug">
                                {{ $track['title'] }}
                            </h3>

                            <p class="mt-3 text-sm sm:text-base text-eco-body leading-relaxed">
                                {{ $track['desc'] }}
                            </p>

                            <div class="mt-6 pt-5 border-t border-eco-border/70 space-y-2.5 text-xs sm:text-sm text-eco-body">
                                @foreach ($track['deliverables'] as $deliverable)
                                    <div class="flex items-start gap-2.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-eco-green mt-1.5 shrink-0"></span>
                                        <span>{{ $deliverable }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-7 pt-4">
                            <a
                                href="{{ route('contact') }}"
                                class="inline-flex items-center gap-2 text-sm font-heading font-bold text-eco-green hover:text-eco-forest transition"
                            >
                                <span>Initiate Partnership Dialogue</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Institutional Partner Logo Slots (Non-Fabricated CMS Placeholders) -->
            <div class="mt-16 pt-14 border-t border-eco-border">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
                    <div>
                        <span class="text-xs font-heading font-bold uppercase tracking-widest text-eco-green block">
                            Verified Ecosystem Directory
                        </span>
                        <h3 class="mt-1 text-2xl font-heading font-bold text-eco-heading">
                            Institutional &amp; Technical Partner Roster Slots
                        </h3>
                    </div>
                    <span
                        x-show="showPlaceholderBadges"
                        class="text-xs text-amber-800 bg-amber-50 border border-amber-200 px-3.5 py-1.5 rounded-full font-medium"
                    >
                        No unverified logos displayed — upload approved partner emblems in Stage 2 CMS
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach ($partnersData['partner_slots'] as $slot)
                        <div class="p-6 rounded-2xl bg-eco-surface border border-dashed border-eco-border flex flex-col justify-between gap-3">
                            <span class="text-[11px] font-heading font-bold uppercase tracking-wider text-eco-green">
                                {{ $slot['sector'] }}
                            </span>
                            <div class="text-sm font-heading font-bold text-eco-heading">
                                {{ $slot['label'] }}
                            </div>
                            <span
                                x-show="showPlaceholderBadges"
                                class="text-[11px] text-amber-800 font-medium"
                            >
                                {{ $slot['status'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- =====================================================================
         SECTION 2: CAREERS, FELLOWSHIPS & APPRENTICESHIP TRACKS
         ===================================================================== --}}
    <section
        id="careers-directory"
        x-data="{
            activeRoleCategory: 'All',
            selectedRole: null,
            roles: @js($partnersData['career_tracks']),
            openRole(id) {
                this.selectedRole = this.roles.find((r) => r.id === id) || null;
            },
            closeRole() {
                this.selectedRole = null;
            }
        }"
        @keydown.escape.window="closeRole()"
        class="py-20 lg:py-28 bg-eco-surface relative overflow-hidden"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Culture & Workforce Banner -->
            <div class="mb-16 grid grid-cols-1 lg:grid-cols-12 gap-10 items-center bg-white rounded-3xl p-8 sm:p-10 lg:p-12 border border-eco-border/80 shadow-xs">
                <div class="lg:col-span-6 space-y-5">
                    <span class="inline-flex items-center gap-2 text-xs font-heading font-bold uppercase tracking-widest text-eco-green">
                        <span class="w-6 h-0.5 bg-eco-green rounded-full"></span>
                        Careers &amp; Talent Pathways
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-heading font-bold text-eco-heading leading-tight">
                        Grow Your Career Engineering Africa’s Clean Energy Transition
                    </h2>
                    <p class="text-sm sm:text-base text-eco-body leading-relaxed">
                        Whether you are an electrical systems engineer, a laboratory electronics technician, a STEM educator, or a vocational solar apprentice, Ecowattage offers a mission-driven environment grounded in technical rigor and community service.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 text-xs sm:text-sm font-heading font-bold text-eco-heading">
                        <div class="p-3.5 rounded-xl bg-eco-surface border border-eco-border/70 flex items-center gap-2.5">
                            <span class="w-2 h-2 rounded-full bg-eco-green shrink-0"></span>
                            <span>Field &amp; Lab Mentorship</span>
                        </div>
                        <div class="p-3.5 rounded-xl bg-eco-surface border border-eco-border/70 flex items-center gap-2.5">
                            <span class="w-2 h-2 rounded-full bg-eco-green shrink-0"></span>
                            <span>Domestic Clean-Tech R&amp;D</span>
                        </div>
                        <div class="p-3.5 rounded-xl bg-eco-surface border border-eco-border/70 flex items-center gap-2.5">
                            <span class="w-2 h-2 rounded-full bg-eco-green shrink-0"></span>
                            <span>Youth Apprenticeship Cohorts</span>
                        </div>
                        <div class="p-3.5 rounded-xl bg-eco-surface border border-eco-border/70 flex items-center gap-2.5">
                            <span class="w-2 h-2 rounded-full bg-eco-green shrink-0"></span>
                            <span>Evidence-Based Policy Impact</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-6">
                    <div class="relative rounded-2xl overflow-hidden aspect-[16/10] border border-eco-border shadow-lg">
                        <img
                            src="{{ asset('/images/illustrative/partners-careers-teamwork.jpg') }}"
                            alt="Ecowattage engineering and apprenticeship collaboration"
                            class="w-full h-full object-cover"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-eco-forest/70 via-transparent to-transparent"></div>
                        <span
                            x-show="showPlaceholderBadges"
                            class="absolute bottom-3 left-4 right-4 px-3 py-1.5 rounded-xl bg-eco-forest/85 text-white/95 text-[11px]"
                        >
                            Illustrative Documentary Photo — Clean-energy engineers and apprentices collaborating on solar and LED schematics.
                        </span>
                    </div>
                </div>
            </div>

            <x-public.section-heading
                subtitle="Talent & Fellowship Tracks"
                title="Open Expression-of-Interest Role Blueprints"
                description="Filter across our core discipline tracks below. When active recruitment windows open in Stage 2, verified application deadlines and CV upload forms appear automatically."
            />

            <!-- Career Category Filter Tabs -->
            <div class="mt-10 flex flex-wrap items-center justify-center gap-2.5 sm:gap-3" role="tablist" aria-label="Filter career tracks by discipline">
                @foreach ($partnersData['career_categories'] as $cat)
                    <button
                        type="button"
                        @click="activeRoleCategory = @js($cat)"
                        :aria-selected="(activeRoleCategory === @js($cat)).toString()"
                        :class="activeRoleCategory === @js($cat)
                            ? 'bg-eco-green text-white border-eco-green shadow-md'
                            : 'bg-white text-eco-heading border-eco-border hover:border-eco-green hover:text-eco-green'"
                        class="px-5 py-2.5 rounded-full border text-xs sm:text-sm font-heading font-bold transition-all cursor-pointer"
                    >
                        {{ $cat }}
                    </button>
                @endforeach
            </div>

            <!-- Role Cards List -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($partnersData['career_tracks'] as $role)
                    <article
                        id="{{ $role['id'] }}"
                        x-show="activeRoleCategory === 'All' || activeRoleCategory === @js($role['category'])"
                        x-transition.opacity.duration.200ms
                        class="card-3d-tilt bg-white rounded-3xl p-7 sm:p-8 border border-eco-border/80 shadow-xs hover:shadow-2xl transition-all duration-300 flex flex-col justify-between transform-gpu"
                    >
                        <div>
                            <div class="flex flex-wrap items-center justify-between gap-2 mb-4">
                                <span class="px-3 py-1 rounded-full bg-eco-mint-soft text-eco-forest text-xs font-heading font-bold">
                                    {{ $role['category'] }}
                                </span>
                                <span
                                    x-show="showPlaceholderBadges"
                                    class="text-[11px] font-medium text-amber-800"
                                >
                                    {{ $role['status'] }}
                                </span>
                            </div>

                            <h3 class="text-xl font-heading font-bold text-eco-heading leading-snug">
                                {{ $role['title'] }}
                            </h3>

                            <div class="mt-2 flex flex-wrap items-center gap-2 text-xs text-eco-green font-semibold">
                                <span>{{ $role['type'] }}</span>
                                <span>•</span>
                                <span class="text-eco-body">{{ $role['location'] }}</span>
                            </div>

                            <p class="mt-4 text-sm text-eco-body leading-relaxed">
                                {{ $role['summary'] }}
                            </p>

                            <div class="mt-5 pt-4 border-t border-eco-border/70 space-y-2 text-xs text-eco-body">
                                @foreach ($role['requirements'] as $req)
                                    <div class="flex items-start gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-eco-green mt-1.5 shrink-0"></span>
                                        <span>{{ $req }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-7 pt-2">
                            <button
                                type="button"
                                @click="openRole(@js($role['id']))"
                                class="btn-eco-primary w-full justify-center !py-3 text-xs sm:text-sm font-semibold cursor-pointer"
                            >
                                <span>View Role Brief &amp; Express Interest</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </button>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        <!-- Role Details Modal -->
        <div
            x-show="selectedRole !== null"
            x-cloak
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-eco-forest/75 backdrop-blur-xs"
            @click.self="closeRole()"
            role="dialog"
            aria-modal="true"
            aria-label="Career Track Details"
        >
            <div
                x-show="selectedRole !== null"
                x-transition
                class="bg-white rounded-3xl max-w-2xl w-full overflow-hidden shadow-2xl border border-eco-border max-h-[90vh] flex flex-col"
            >
                <template x-if="selectedRole">
                    <div class="p-7 sm:p-9 overflow-y-auto space-y-5">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <span class="px-3 py-1 rounded-full bg-eco-mint-soft text-eco-forest text-xs font-heading font-bold" x-text="selectedRole.category"></span>
                                <h3 class="mt-3 text-2xl font-heading font-bold text-eco-heading" x-text="selectedRole.title"></h3>
                            </div>
                            <button
                                type="button"
                                @click="closeRole()"
                                aria-label="Close role modal"
                                class="w-9 h-9 rounded-full bg-eco-surface text-eco-forest hover:bg-eco-mint-soft flex items-center justify-center cursor-pointer shrink-0"
                            >
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-2xl bg-eco-surface border border-eco-border">
                            <div>
                                <span class="text-[11px] font-heading font-bold uppercase tracking-wider text-eco-green block">Engagement Track</span>
                                <span class="text-xs font-semibold text-eco-heading" x-text="selectedRole.type"></span>
                            </div>
                            <div>
                                <span class="text-[11px] font-heading font-bold uppercase tracking-wider text-eco-green block">Location</span>
                                <span class="text-xs font-semibold text-eco-heading" x-text="selectedRole.location"></span>
                            </div>
                        </div>

                        <p class="text-sm sm:text-base text-eco-body leading-relaxed" x-text="selectedRole.summary"></p>

                        <div>
                            <h4 class="text-xs font-heading font-bold uppercase tracking-wider text-eco-green mb-3">
                                Core Competencies &amp; Expectations
                            </h4>
                            <ul class="space-y-2.5">
                                <template x-for="(req, idx) in selectedRole.requirements" :key="idx">
                                    <li class="flex items-start gap-2.5 text-sm text-eco-body">
                                        <span class="w-2 h-2 rounded-full bg-eco-green mt-1.5 shrink-0"></span>
                                        <span x-text="req"></span>
                                    </li>
                                </template>
                            </ul>
                        </div>

                        <div class="pt-4 border-t border-eco-border flex flex-wrap items-center justify-between gap-3">
                            <a href="{{ route('contact') }}" class="btn-eco-primary">
                                <span>Submit Expression of Interest</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                            <button
                                type="button"
                                @click="closeRole()"
                                class="px-5 py-2.5 rounded-full border border-eco-border text-xs font-heading font-bold text-eco-heading hover:bg-eco-surface cursor-pointer"
                            >
                                Close
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>

    {{-- =====================================================================
         SECTION 3: CALL TO ACTION BANNER (Ecozone CTA Layout 1)
         ===================================================================== --}}
    <section class="py-16 lg:py-24 bg-eco-forest text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-eco-forest via-eco-forest/95 to-eco-green-dark/90 p-8 sm:p-12 lg:p-16 border border-white/10 shadow-2xl">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-8 space-y-4">
                        <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/15 text-eco-mint text-xs font-heading font-bold uppercase tracking-widest">
                            Join Our Ecosystem
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-heading font-bold text-white leading-tight">
                            Ready to Partner With Ecowattage or Join Our Clean Energy Talent Pool?
                        </h2>
                        <p class="text-white/85 text-sm sm:text-base max-w-2xl leading-relaxed">
                            Reach out to our institutional partnerships and talent desk to propose a joint initiative, academic fellowship, or technical apprenticeship.
                        </p>
                    </div>

                    <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3.5 justify-end">
                        <a href="{{ route('contact') }}" class="btn-eco-primary justify-center">
                            <span>Contact Our Team</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="{{ route('projects') }}" class="btn-eco-white justify-center">
                            <span>Explore Project Blueprints</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>

<x-layouts.public
    :title="'Publications & Research — ' . ($site['name'] ?? 'Ecowattage')"
    :metaDescription="'Access Ecowattage renewable energy policy briefs, technical white papers, school literacy toolkits, and feasibility studies across Sierra Leone and Africa.'"
    :site="$site"
    :navigation="$navigation"
>
    {{-- Page Breadcrumb Hero Banner --}}
    <x-public.page-hero
        title="Publications & Research"
        image="/images/illustrative/publications-research-desk.jpg"
    />

    {{-- =====================================================================
         SECTION 1: FEATURED RESEARCH FRAMEWORK
         ===================================================================== --}}
    <section class="py-20 lg:py-28 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                :subtitle="$publicationsData['header']['subtitle']"
                :title="$publicationsData['header']['title']"
                :description="$publicationsData['header']['description']"
            />

            <!-- Repository Transparency Notice -->
            <div
                x-show="showPlaceholderBadges"
                class="mt-8 max-w-4xl mx-auto p-4 rounded-2xl bg-eco-mint-soft/80 border border-eco-mint text-xs text-eco-forest flex items-start sm:items-center gap-3"
            >
                <span class="px-2 py-0.5 rounded bg-eco-green text-white font-heading font-bold uppercase text-[10px] shrink-0">
                    Repository Notice
                </span>
                <span>{{ $publicationsData['header']['disclaimer'] }}</span>
            </div>

            <!-- Featured Policy & Technical Report Spotlight -->
            @php($featured = $publicationsData['featured_report'])
            <div class="mt-14 grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
                <!-- Left Visual + Document Metadata -->
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

                        <span class="absolute bottom-4 left-4 px-3 py-1 rounded-full bg-eco-forest/90 text-eco-mint text-xs font-heading font-semibold border border-white/15">
                            {{ $featured['type'] }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-6 rounded-2xl bg-eco-surface border border-eco-border/80">
                        <div>
                            <span class="text-[11px] font-heading font-bold uppercase tracking-wider text-eco-green block">Prepared By</span>
                            <span class="mt-1 text-xs sm:text-sm font-heading font-bold text-eco-heading block">{{ $featured['authors'] }}</span>
                        </div>
                        <div>
                            <span class="text-[11px] font-heading font-bold uppercase tracking-wider text-eco-green block">Release Status</span>
                            <span class="mt-1 text-xs font-medium text-amber-800 block">{{ $featured['status'] }}</span>
                        </div>
                        <div>
                            <span class="text-[11px] font-heading font-bold uppercase tracking-wider text-eco-green block">Document File</span>
                            <span class="mt-1 text-xs font-medium text-amber-800 block">{{ $featured['format_note'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right Executive Scope -->
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
                            {{ $featured['summary'] }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        @foreach ($featured['methodology_points'] as $idx => $point)
                            <div class="p-5 rounded-2xl bg-eco-surface border border-eco-border/70 hover:border-eco-green/40 transition-colors">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-eco-mint-soft text-eco-green font-heading font-bold text-xs shrink-0">
                                        0{{ $idx + 1 }}
                                    </span>
                                    <h4 class="font-heading font-bold text-sm sm:text-base text-eco-heading leading-snug">
                                        {{ $point['title'] }}
                                    </h4>
                                </div>
                                <p class="text-xs sm:text-sm text-eco-body leading-relaxed">
                                    {{ $point['desc'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-3 flex flex-wrap items-center gap-4">
                        <a href="{{ route('contact') }}" class="btn-eco-primary">
                            <span>Request Briefing Copy</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="#repository" class="inline-flex items-center gap-2 px-5 py-3 rounded-full border border-eco-border text-sm font-heading font-bold text-eco-heading hover:border-eco-green hover:text-eco-green transition">
                            <span>Browse All Documents</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =====================================================================
         SECTION 2: FILTERABLE PUBLICATIONS & TOOLKITS REPOSITORY
         ===================================================================== --}}
    <section
        id="repository"
        x-data="{
            activeType: 'All',
            searchQuery: '',
            selectedDoc: null,
            documents: @js($publicationsData['publications_list']),
            matchesDoc(type, blob) {
                const typeMatch = this.activeType === 'All' || this.activeType === type;
                const q = this.searchQuery.trim().toLowerCase();
                const searchMatch = q === '' || blob.toLowerCase().includes(q);
                return typeMatch && searchMatch;
            },
            matchingCount() {
                const q = this.searchQuery.trim().toLowerCase();
                return this.documents.filter((doc) => {
                    const typeMatch = this.activeType === 'All' || this.activeType === doc.type;
                    const blob = (doc.title + ' ' + doc.abstract + ' ' + doc.topic + ' ' + doc.audience).toLowerCase();
                    const searchMatch = q === '' || blob.includes(q);
                    return typeMatch && searchMatch;
                }).length;
            },
            openDoc(id) {
                this.selectedDoc = this.documents.find((doc) => doc.id === id) || null;
            },
            closeDoc() {
                this.selectedDoc = null;
            },
            resetFilters() {
                this.activeType = 'All';
                this.searchQuery = '';
            }
        }"
        @keydown.escape.window="closeDoc()"
        class="py-20 lg:py-28 bg-eco-surface relative overflow-hidden"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                subtitle="Knowledge Archive"
                title="Policy Briefs, White Papers & Educational Toolkits"
                description="Filter publications by format or search across clean-tech research topics prepared for policymakers, engineers, and educators."
            />

            <!-- Type Filter Pills + Search Input -->
            <div class="mt-10 flex flex-col lg:flex-row items-center justify-between gap-5">
                <div class="flex flex-wrap items-center justify-center gap-2.5" role="tablist" aria-label="Filter publications by type">
                    @foreach ($publicationsData['types'] as $type)
                        <button
                            type="button"
                            @click="activeType = @js($type)"
                            :aria-selected="(activeType === @js($type)).toString()"
                            :class="activeType === @js($type)
                                ? 'bg-eco-green text-white border-eco-green shadow-md'
                                : 'bg-white text-eco-heading border-eco-border hover:border-eco-green hover:text-eco-green'"
                            class="px-5 py-2.5 rounded-full border text-xs sm:text-sm font-heading font-bold transition-all cursor-pointer"
                        >
                            {{ $type }}
                        </button>
                    @endforeach
                </div>

                <div class="relative w-full lg:w-72">
                    <input
                        type="search"
                        x-model="searchQuery"
                        placeholder="Search papers & toolkits..."
                        aria-label="Search publications"
                        class="w-full pl-4 pr-10 py-2.5 rounded-full bg-white border border-eco-border text-sm text-eco-charcoal placeholder:text-eco-body/60 focus:outline-none focus:border-eco-green"
                    >
                    <svg class="w-4 h-4 text-eco-green absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z" />
                    </svg>
                </div>
            </div>

            <!-- 6-Document Grid -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($publicationsData['publications_list'] as $doc)
                    @php($searchBlob = $doc['title'] . ' ' . $doc['abstract'] . ' ' . $doc['topic'] . ' ' . $doc['audience'])
                    <article
                        id="{{ $doc['id'] }}"
                        x-show="matchesDoc(@js($doc['type']), @js($searchBlob))"
                        x-transition.opacity.duration.200ms
                        class="card-3d-tilt bg-white rounded-3xl border border-eco-border/80 shadow-xs hover:shadow-2xl transition-all duration-300 flex flex-col justify-between overflow-hidden group transform-gpu"
                    >
                        <div>
                            <!-- Thumbnail -->
                            <div class="relative aspect-[16/10] overflow-hidden bg-eco-forest/10">
                                <img
                                    src="{{ asset($doc['image']) }}"
                                    alt="{{ $doc['title'] }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-eco-forest/75 via-transparent to-transparent"></div>

                                <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-eco-forest/90 backdrop-blur-xs text-eco-mint text-xs font-heading font-semibold">
                                    {{ $doc['type'] }}
                                </span>

                                <span
                                    x-show="showPlaceholderBadges"
                                    class="absolute bottom-3 right-4 px-2.5 py-0.5 rounded-full bg-eco-green text-white text-[11px] font-heading font-bold"
                                >
                                    {{ $doc['file_status'] }}
                                </span>
                            </div>

                            <!-- Card Content -->
                            <div class="p-7 sm:p-8">
                                <span class="text-xs font-heading font-bold uppercase tracking-wider text-eco-green block mb-2">
                                    {{ $doc['topic'] }}
                                </span>

                                <h3 class="text-xl font-heading font-bold text-eco-heading group-hover:text-eco-green transition-colors leading-snug">
                                    {{ $doc['title'] }}
                                </h3>

                                <p class="mt-3 text-sm text-eco-body leading-relaxed">
                                    {{ $doc['abstract'] }}
                                </p>

                                <div class="mt-5 pt-4 border-t border-eco-border/70 space-y-1.5 text-xs">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="font-heading font-bold text-eco-heading">Audience:</span>
                                        <span class="text-eco-body text-right">{{ $doc['audience'] }}</span>
                                    </div>
                                    <div
                                        x-show="showPlaceholderBadges"
                                        class="flex items-center justify-between gap-2"
                                    >
                                        <span class="font-heading font-bold text-eco-heading">Status:</span>
                                        <span class="text-amber-800 font-medium text-right">{{ $doc['status'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Preview Button -->
                        <div class="px-7 sm:px-8 pb-7 sm:pb-8 pt-2">
                            <button
                                type="button"
                                @click="openDoc(@js($doc['id']))"
                                class="btn-eco-primary w-full justify-center !py-3 text-xs sm:text-sm font-semibold cursor-pointer"
                            >
                                <span>Preview Executive Brief</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </button>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Empty Search State -->
            <div
                x-show="matchingCount() === 0"
                x-cloak
                class="mt-10 p-10 rounded-3xl bg-white border border-eco-border text-center space-y-4"
            >
                <h3 class="text-xl font-heading font-bold text-eco-heading">No matching publications found</h3>
                <p class="text-sm text-eco-body max-w-md mx-auto">
                    Try another document format or clear your search filter to view all planned research titles.
                </p>
                <button type="button" @click="resetFilters()" class="btn-eco-primary cursor-pointer">
                    <span>Show All Publications</span>
                </button>
            </div>
        </div>

        <!-- Executive Brief Reader Modal -->
        <div
            x-show="selectedDoc !== null"
            x-cloak
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-eco-forest/75 backdrop-blur-xs"
            @click.self="closeDoc()"
            role="dialog"
            aria-modal="true"
            aria-label="Publication Brief Preview"
        >
            <div
                x-show="selectedDoc !== null"
                x-transition
                class="bg-white rounded-3xl max-w-2xl w-full overflow-hidden shadow-2xl border border-eco-border max-h-[90vh] flex flex-col"
            >
                <template x-if="selectedDoc">
                    <div class="overflow-y-auto">
                        <div class="relative aspect-[16/8] bg-eco-forest/10">
                            <img :src="selectedDoc.image" :alt="selectedDoc.title" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-eco-forest/85 via-transparent to-transparent"></div>
                            <button
                                type="button"
                                @click="closeDoc()"
                                aria-label="Close publication preview"
                                class="absolute top-4 right-4 w-9 h-9 rounded-full bg-white/90 text-eco-forest hover:bg-white flex items-center justify-center shadow-md cursor-pointer"
                            >
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <div class="absolute bottom-4 left-6 right-6 flex flex-wrap items-center gap-2">
                                <span class="px-3 py-1 rounded-full bg-eco-green text-white text-xs font-heading font-bold" x-text="selectedDoc.type"></span>
                                <span class="px-3 py-1 rounded-full bg-white/90 text-eco-forest text-xs font-heading font-bold" x-text="selectedDoc.topic"></span>
                            </div>
                        </div>

                        <div class="p-7 sm:p-8 space-y-5">
                            <h3 class="text-2xl font-heading font-bold text-eco-heading leading-snug" x-text="selectedDoc.title"></h3>
                            <p class="text-sm sm:text-base text-eco-body leading-relaxed" x-text="selectedDoc.abstract"></p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-2xl bg-eco-surface border border-eco-border">
                                <div>
                                    <span class="text-[11px] font-heading font-bold uppercase tracking-wider text-eco-green block">Primary Audience</span>
                                    <span class="text-xs font-semibold text-eco-heading" x-text="selectedDoc.audience"></span>
                                </div>
                                <div>
                                    <span class="text-[11px] font-heading font-bold uppercase tracking-wider text-eco-green block">Document Attachment</span>
                                    <span class="text-xs font-medium text-amber-800" x-text="selectedDoc.file_status"></span>
                                </div>
                            </div>

                            <div>
                                <h4 class="text-xs font-heading font-bold uppercase tracking-wider text-eco-green mb-3">
                                    Core Research Findings &amp; Takeaways
                                </h4>
                                <ul class="space-y-2.5">
                                    <template x-for="(finding, idx) in selectedDoc.key_findings" :key="idx">
                                        <li class="flex items-start gap-2.5 text-sm text-eco-body">
                                            <span class="w-2 h-2 rounded-full bg-eco-green mt-1.5 shrink-0"></span>
                                            <span x-text="finding"></span>
                                        </li>
                                    </template>
                                </ul>
                            </div>

                            <div class="pt-4 border-t border-eco-border flex flex-wrap items-center justify-between gap-3">
                                <a href="{{ route('contact') }}" class="btn-eco-primary">
                                    <span>Request Document / Collaborate</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                                <button
                                    type="button"
                                    @click="closeDoc()"
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
         SECTION 3: RESEARCH STANDARDS & OPEN ACCESS PRINCIPLES
         ===================================================================== --}}
    <section class="py-20 lg:py-24 bg-white border-t border-eco-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                subtitle="Our Knowledge Approach"
                title="How Ecowattage Conducts & Shares Clean-Tech Research"
                description="Grounded in empirical West African conditions and designed for practical adoption by policymakers, educators, and technicians."
            />

            <div class="mt-14 grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($publicationsData['research_pillars'] as $pillar)
                    <div class="p-8 rounded-3xl bg-eco-surface border border-eco-border/80 shadow-xs hover:shadow-lg transition">
                        <span class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-eco-mint-soft text-eco-green font-heading font-extrabold text-lg mb-6">
                            {{ $pillar['number'] }}
                        </span>
                        <h3 class="text-xl font-heading font-bold text-eco-heading">
                            {{ $pillar['title'] }}
                        </h3>
                        <p class="mt-3 text-sm sm:text-base text-eco-body leading-relaxed">
                            {{ $pillar['desc'] }}
                        </p>
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
                            Academic &amp; Policy Collaboration
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-heading font-bold text-white leading-tight">
                            Co-Author Clean Energy Studies or Request Educational Toolkits
                        </h2>
                        <p class="text-white/85 text-sm sm:text-base max-w-2xl leading-relaxed">
                            Universities, policy institutes, secondary schools, and NGOs can partner with Ecowattage on empirical energy research and literacy materials.
                        </p>
                    </div>

                    <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3.5 justify-end">
                        <a href="{{ route('contact') }}" class="btn-eco-primary justify-center">
                            <span>Collaborate With Us</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="{{ route('events-gallery') }}" class="btn-eco-white justify-center">
                            <span>View Events &amp; Workshops</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>

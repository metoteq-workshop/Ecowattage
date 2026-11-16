<x-layouts.public
    :title="'Events & Media Gallery — ' . ($site['name'] ?? 'Ecowattage')"
    :metaDescription="'Explore Ecowattage renewable energy workshops, clean-tech policy symposiums, community solar demonstrations, and documentary media galleries.'"
    :site="$site"
    :navigation="$navigation"
>
    {{-- Page Breadcrumb Hero Banner --}}
    <x-public.page-hero
        title="Events & Media Gallery"
        image="/images/illustrative/events-energy-conference.jpg"
    />

    {{-- =====================================================================
         SECTION 1: UPCOMING & PLANNED EVENTS PROGRAM (Filterable + Detail Modal)
         ===================================================================== --}}
    <section
        id="events-program"
        x-data="{
            activeEventCategory: 'All',
            selectedEvent: null,
            events: @js($eventsData['events_list']),
            openEvent(id) {
                this.selectedEvent = this.events.find((item) => item.id === id) || null;
            },
            closeEvent() {
                this.selectedEvent = null;
            }
        }"
        @keydown.escape.window="closeEvent()"
        class="py-20 lg:py-28 bg-white relative overflow-hidden"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                :subtitle="$eventsData['header']['subtitle']"
                :title="$eventsData['header']['title']"
                :description="$eventsData['header']['description']"
            />

            <!-- Transparency Notice -->
            <div
                x-show="showPlaceholderBadges"
                class="mt-8 max-w-4xl mx-auto p-4 rounded-2xl bg-eco-mint-soft/80 border border-eco-mint text-xs text-eco-forest flex items-start sm:items-center gap-3"
            >
                <span class="px-2 py-0.5 rounded bg-eco-green text-white font-heading font-bold uppercase text-[10px] shrink-0">
                    Program Notice
                </span>
                <span>{{ $eventsData['header']['disclaimer'] }}</span>
            </div>

            <!-- Category Tabs -->
            <div class="mt-10 flex flex-wrap items-center justify-center gap-2.5 sm:gap-3" role="tablist" aria-label="Filter events by category">
                @foreach ($eventsData['event_categories'] as $category)
                    <button
                        type="button"
                        @click="activeEventCategory = @js($category)"
                        :aria-selected="(activeEventCategory === @js($category)).toString()"
                        :class="activeEventCategory === @js($category)
                            ? 'bg-eco-green text-white border-eco-green shadow-md'
                            : 'bg-eco-surface text-eco-heading border-eco-border hover:border-eco-green hover:text-eco-green'"
                        class="px-5 py-2.5 rounded-full border text-xs sm:text-sm font-heading font-bold transition-all cursor-pointer"
                    >
                        {{ $category }}
                    </button>
                @endforeach
            </div>

            <!-- Events Grid (2x2 Balanced Layout) -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach ($eventsData['events_list'] as $event)
                    <article
                        id="{{ $event['id'] }}"
                        x-show="activeEventCategory === 'All' || activeEventCategory === @js($event['category'])"
                        x-transition.opacity.duration.200ms
                        class="card-3d-tilt bg-white rounded-3xl border border-eco-border/80 shadow-xs hover:shadow-2xl transition-all duration-300 flex flex-col justify-between overflow-hidden group transform-gpu"
                    >
                        <div>
                            <div class="relative aspect-[16/9] overflow-hidden bg-eco-forest/10">
                                <img
                                    src="{{ asset($event['image']) }}"
                                    alt="{{ $event['title'] }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-eco-forest/75 via-transparent to-transparent"></div>

                                <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-eco-forest/90 backdrop-blur-xs text-eco-mint text-xs font-heading font-semibold">
                                    {{ $event['category'] }}
                                </span>

                                <span class="absolute bottom-3 right-4 px-2.5 py-0.5 rounded-full bg-eco-green text-white text-[11px] font-heading font-bold">
                                    {{ $event['format'] }}
                                </span>
                            </div>

                            <div class="p-7 sm:p-8">
                                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs mb-3">
                                    <span class="font-heading font-bold text-amber-800">{{ $event['schedule'] }}</span>
                                    <span class="text-eco-border">•</span>
                                    <span class="text-eco-green font-semibold">{{ $event['location'] }}</span>
                                </div>

                                <h3 class="text-xl sm:text-2xl font-heading font-bold text-eco-heading group-hover:text-eco-green transition-colors leading-snug">
                                    {{ $event['title'] }}
                                </h3>

                                <p class="mt-3 text-sm sm:text-base text-eco-body leading-relaxed">
                                    {{ $event['summary'] }}
                                </p>

                                <div class="mt-5 space-y-2 text-xs sm:text-sm text-eco-body">
                                    @foreach ($event['highlights'] as $item)
                                        <div class="flex items-start gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-eco-green mt-1.5 shrink-0"></span>
                                            <span>{{ $item }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="px-7 sm:px-8 pb-7 sm:pb-8 pt-2">
                            <button
                                type="button"
                                @click="openEvent(@js($event['id']))"
                                class="btn-eco-primary w-full justify-center !py-3 text-xs sm:text-sm font-semibold cursor-pointer"
                            >
                                <span>View Event Brief &amp; Register Interest</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </button>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        <!-- Event Brief Modal -->
        <div
            x-show="selectedEvent !== null"
            x-cloak
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-eco-forest/75 backdrop-blur-xs"
            @click.self="closeEvent()"
            role="dialog"
            aria-modal="true"
            aria-label="Event Program Brief"
        >
            <div
                x-show="selectedEvent !== null"
                x-transition
                class="bg-white rounded-3xl max-w-2xl w-full overflow-hidden shadow-2xl border border-eco-border max-h-[90vh] flex flex-col"
            >
                <template x-if="selectedEvent">
                    <div class="overflow-y-auto">
                        <div class="relative aspect-[16/9] bg-eco-forest/10">
                            <img :src="selectedEvent.image" :alt="selectedEvent.title" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-eco-forest/80 via-transparent to-transparent"></div>
                            <button
                                type="button"
                                @click="closeEvent()"
                                aria-label="Close event modal"
                                class="absolute top-4 right-4 w-9 h-9 rounded-full bg-white/90 text-eco-forest hover:bg-white flex items-center justify-center shadow-md cursor-pointer"
                            >
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <div class="absolute bottom-4 left-6 right-6 flex flex-wrap items-center gap-2">
                                <span class="px-3 py-1 rounded-full bg-eco-green text-white text-xs font-heading font-bold" x-text="selectedEvent.category"></span>
                                <span class="px-3 py-1 rounded-full bg-white/90 text-eco-forest text-xs font-heading font-bold" x-text="selectedEvent.format"></span>
                            </div>
                        </div>

                        <div class="p-7 sm:p-8 space-y-5">
                            <h3 class="text-2xl font-heading font-bold text-eco-heading leading-snug" x-text="selectedEvent.title"></h3>
                            <p class="text-sm sm:text-base text-eco-body leading-relaxed" x-text="selectedEvent.summary"></p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-2xl bg-eco-surface border border-eco-border">
                                <div>
                                    <span class="text-[11px] font-heading font-bold uppercase tracking-wider text-eco-green block">Schedule Slot</span>
                                    <span class="text-xs font-medium text-amber-800" x-text="selectedEvent.schedule"></span>
                                </div>
                                <div>
                                    <span class="text-[11px] font-heading font-bold uppercase tracking-wider text-eco-green block">Location Slot</span>
                                    <span class="text-xs font-semibold text-eco-heading" x-text="selectedEvent.location"></span>
                                </div>
                            </div>

                            <div>
                                <h4 class="text-xs font-heading font-bold uppercase tracking-wider text-eco-green mb-3">
                                    Session Agenda Highlights
                                </h4>
                                <ul class="space-y-2.5">
                                    <template x-for="(hl, idx) in selectedEvent.highlights" :key="idx">
                                        <li class="flex items-start gap-2.5 text-sm text-eco-body">
                                            <span class="w-2 h-2 rounded-full bg-eco-green mt-1.5 shrink-0"></span>
                                            <span x-text="hl"></span>
                                        </li>
                                    </template>
                                </ul>
                            </div>

                            <div class="pt-4 border-t border-eco-border flex flex-wrap items-center justify-between gap-3">
                                <a href="{{ route('contact') }}" class="btn-eco-primary">
                                    <span>Inquire About Participation</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                                <button
                                    type="button"
                                    @click="closeEvent()"
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
         SECTION 2: DOCUMENTARY PHOTO & VIDEO MEDIA GALLERY (With Lightbox)
         ===================================================================== --}}
    <section
        id="media-gallery"
        x-data="{
            activeMediaCategory: 'All Media',
            lightboxIndex: null,
            items: @js($eventsData['gallery_items']),
            filteredItems() {
                if (this.activeMediaCategory === 'All Media') {
                    return this.items;
                }
                return this.items.filter((item) => item.category === this.activeMediaCategory);
            },
            openLightbox(id) {
                const list = this.filteredItems();
                const idx = list.findIndex((item) => item.id === id);
                if (idx >= 0) {
                    this.lightboxIndex = idx;
                }
            },
            closeLightbox() {
                this.lightboxIndex = null;
            },
            nextImage() {
                const list = this.filteredItems();
                if (this.lightboxIndex !== null && list.length > 0) {
                    this.lightboxIndex = (this.lightboxIndex + 1) % list.length;
                }
            },
            prevImage() {
                const list = this.filteredItems();
                if (this.lightboxIndex !== null && list.length > 0) {
                    this.lightboxIndex = (this.lightboxIndex - 1 + list.length) % list.length;
                }
            },
            currentLightboxItem() {
                const list = this.filteredItems();
                return this.lightboxIndex !== null ? (list[this.lightboxIndex] || null) : null;
            }
        }"
        @keydown.escape.window="closeLightbox()"
        @keydown.arrow-right.window="if (lightboxIndex !== null) nextImage()"
        @keydown.arrow-left.window="if (lightboxIndex !== null) prevImage()"
        class="py-20 lg:py-28 bg-eco-surface relative overflow-hidden"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                subtitle="Documentary Visual Archive"
                title="Field Highlights & Clean Energy Media Gallery"
                description="Browse illustrative documentary visuals across our energy workshops, research dialogues, and community microgrid blueprints."
            />

            <!-- Media Filter Tabs -->
            <div class="mt-10 flex flex-wrap items-center justify-center gap-2.5 sm:gap-3" role="tablist" aria-label="Filter gallery media by category">
                @foreach ($eventsData['gallery_categories'] as $mediaCat)
                    <button
                        type="button"
                        @click="activeMediaCategory = @js($mediaCat); lightboxIndex = null;"
                        :aria-selected="(activeMediaCategory === @js($mediaCat)).toString()"
                        :class="activeMediaCategory === @js($mediaCat)
                            ? 'bg-eco-green text-white border-eco-green shadow-md'
                            : 'bg-white text-eco-heading border-eco-border hover:border-eco-green hover:text-eco-green'"
                        class="px-5 py-2.5 rounded-full border text-xs sm:text-sm font-heading font-bold transition-all cursor-pointer"
                    >
                        {{ $mediaCat }}
                    </button>
                @endforeach
            </div>

            <!-- 9-Item Photo Gallery Mosaic -->
            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($eventsData['gallery_items'] as $media)
                    <button
                        type="button"
                        x-show="activeMediaCategory === 'All Media' || activeMediaCategory === @js($media['category'])"
                        x-transition.opacity.duration.200ms
                        @click="openLightbox(@js($media['id']))"
                        class="card-3d-tilt group relative rounded-3xl overflow-hidden bg-eco-forest/10 border border-eco-border/80 shadow-xs hover:shadow-2xl transition-all duration-300 text-left aspect-[4/3] cursor-pointer transform-gpu"
                    >
                        <img
                            src="{{ asset($media['image']) }}"
                            alt="{{ $media['title'] }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-eco-forest/90 via-eco-forest/20 to-transparent opacity-85 group-hover:opacity-95 transition-opacity"></div>

                        <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-eco-forest/85 backdrop-blur-xs text-eco-mint text-[11px] font-heading font-semibold">
                            {{ $media['category'] }}
                        </span>

                        <span class="absolute top-4 right-4 w-9 h-9 rounded-full bg-white/20 backdrop-blur-xs text-white flex items-center justify-center group-hover:bg-eco-green transition-colors">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 8v6m-3-3h6" />
                            </svg>
                        </span>

                        <div class="absolute bottom-4 left-5 right-5 space-y-1">
                            <h3 class="text-base sm:text-lg font-heading font-bold text-white leading-snug">
                                {{ $media['title'] }}
                            </h3>
                            <p
                                x-show="showPlaceholderBadges"
                                class="text-[11px] text-white/80 line-clamp-1"
                            >
                                {{ $media['caption'] }}
                            </p>
                        </div>
                    </button>
                @endforeach
            </div>

            <!-- Video Documentation Reel Slot (Stage 2 CMS Ready) -->
            <div class="mt-14 rounded-3xl bg-white border border-eco-border/80 p-8 sm:p-10 shadow-xs grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-5 relative aspect-[16/10] rounded-2xl overflow-hidden bg-eco-forest">
                    <img
                        src="{{ asset('/images/illustrative/events-solar-field-demo.jpg') }}"
                        alt="Ecowattage documentary video showcase preview"
                        class="w-full h-full object-cover opacity-75"
                    >
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/95 text-eco-forest text-xs font-heading font-bold shadow-lg">
                            <svg class="w-4 h-4 text-eco-green" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                            <span>Video Reel Slot (Stage 2 CMS)</span>
                        </span>
                    </div>
                </div>

                <div class="lg:col-span-7 space-y-4">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-eco-mint-soft text-eco-forest text-xs font-heading font-bold uppercase tracking-wider">
                        Multimedia Documentation Ready
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-heading font-bold text-eco-heading">
                        Community Workshop Recaps &amp; Clean Energy Video Briefings
                    </h3>
                    <p class="text-sm sm:text-base text-eco-body leading-relaxed">
                        Once field event footage and speaker interviews are finalized, the Stage 2 Media Manager lets Ecowattage staff publish categorized video highlights, workshop playlists, and downloadable press photo packs directly here.
                    </p>
                    <div class="pt-1">
                        <a href="{{ route('contact') }}" class="btn-eco-primary">
                            <span>Request Press &amp; Media Kit</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery Lightbox Modal -->
        <div
            x-show="currentLightboxItem() !== null"
            x-cloak
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-eco-forest/90 backdrop-blur-sm"
            @click.self="closeLightbox()"
            role="dialog"
            aria-modal="true"
            aria-label="Media Gallery Lightbox"
        >
            <template x-if="currentLightboxItem()">
                <div class="relative max-w-4xl w-full bg-white rounded-3xl overflow-hidden shadow-2xl border border-white/15">
                    <div class="relative aspect-[16/10] bg-black">
                        <img
                            :src="currentLightboxItem().image"
                            :alt="currentLightboxItem().title"
                            class="w-full h-full object-cover"
                        >
                        <button
                            type="button"
                            @click="closeLightbox()"
                            aria-label="Close lightbox"
                            class="absolute top-4 right-4 w-10 h-10 rounded-full bg-white/95 text-eco-forest hover:bg-white flex items-center justify-center shadow-lg cursor-pointer"
                        >
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <button
                            type="button"
                            @click="prevImage()"
                            aria-label="Previous gallery image"
                            class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/90 text-eco-forest hover:bg-white flex items-center justify-center shadow-lg cursor-pointer"
                        >
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button
                            type="button"
                            @click="nextImage()"
                            aria-label="Next gallery image"
                            class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/90 text-eco-forest hover:bg-white flex items-center justify-center shadow-lg cursor-pointer"
                        >
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-6 sm:p-7 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white">
                        <div>
                            <span class="text-xs font-heading font-bold uppercase tracking-wider text-eco-green" x-text="currentLightboxItem().category"></span>
                            <h3 class="mt-1 text-xl font-heading font-bold text-eco-heading" x-text="currentLightboxItem().title"></h3>
                            <p class="mt-1 text-xs sm:text-sm text-eco-body" x-text="currentLightboxItem().caption"></p>
                        </div>
                        <span class="text-xs font-heading font-bold text-eco-forest bg-eco-mint-soft px-3 py-1.5 rounded-full shrink-0" x-text="(lightboxIndex + 1) + ' / ' + filteredItems().length"></span>
                    </div>
                </div>
            </template>
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
                            Host &amp; Collaborate
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-heading font-bold text-white leading-tight">
                            Invite Ecowattage to Lead a Clean Energy Workshop or Policy Panel
                        </h2>
                        <p class="text-white/85 text-sm sm:text-base max-w-2xl leading-relaxed">
                            Partner with us to bring practical solar demonstrations, youth energy literacy days, and institutional clean-tech forums to your campus or community.
                        </p>
                    </div>

                    <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3.5 justify-end">
                        <a href="{{ route('contact') }}" class="btn-eco-primary justify-center">
                            <span>Request a Workshop</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="{{ route('partners-careers') }}" class="btn-eco-white justify-center">
                            <span>Partner &amp; Careers</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>

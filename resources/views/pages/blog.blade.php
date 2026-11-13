<x-layouts.public
    :title="'Blog & News — ' . ($site['name'] ?? 'Ecowattage')"
    :metaDescription="'Read Ecowattage renewable energy articles, policy insights, community electrification stories, and technical briefs across Sierra Leone and Africa.'"
    :site="$site"
    :navigation="$navigation"
>
    {{-- Page Breadcrumb Hero Banner --}}
    <x-public.page-hero
        title="Blog & News"
        image="/images/illustrative/blog-energy-forum.jpg"
    />

    {{-- =====================================================================
         SECTION 1: EDITORIAL BLOG INDEX & SIDEBAR (Ecozone Blogs/Index Layout)
         ===================================================================== --}}
    <section
        id="blog-directory"
        x-data="{
            searchQuery: '',
            activeCategory: 'All',
            activeTag: '',
            selectedArticle: null,
            articles: @js($blogData['articles']),
            matchesFilter(category, tags, searchBlob) {
                const catMatch = this.activeCategory === 'All' || this.activeCategory === category;
                const tagMatch = this.activeTag === '' || tags.includes(this.activeTag);
                const q = this.searchQuery.trim().toLowerCase();
                const searchMatch = q === '' || searchBlob.toLowerCase().includes(q);
                return catMatch && tagMatch && searchMatch;
            },
            matchingCount() {
                const q = this.searchQuery.trim().toLowerCase();
                return this.articles.filter((item) => {
                    const catMatch = this.activeCategory === 'All' || this.activeCategory === item.category;
                    const tagMatch = this.activeTag === '' || item.tags.includes(this.activeTag);
                    const blob = (item.title + ' ' + item.excerpt + ' ' + item.category + ' ' + item.tags.join(' ')).toLowerCase();
                    const searchMatch = q === '' || blob.includes(q);
                    return catMatch && tagMatch && searchMatch;
                }).length;
            },
            toggleTag(tag) {
                this.activeTag = this.activeTag === tag ? '' : tag;
            },
            resetFilters() {
                this.searchQuery = '';
                this.activeCategory = 'All';
                this.activeTag = '';
            },
            openArticle(slug) {
                this.selectedArticle = this.articles.find((item) => item.slug === slug) || null;
            },
            closeArticle() {
                this.selectedArticle = null;
            }
        }"
        @keydown.escape.window="closeArticle()"
        class="py-20 lg:py-28 bg-white relative overflow-hidden"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                :subtitle="$blogData['header']['subtitle']"
                :title="$blogData['header']['title']"
                :description="$blogData['header']['description']"
            />

            <!-- Editorial Transparency Notice -->
            <div
                x-show="showPlaceholderBadges"
                class="mt-8 max-w-4xl mx-auto p-4 rounded-2xl bg-eco-mint-soft/80 border border-eco-mint text-xs text-eco-forest flex items-start sm:items-center gap-3"
            >
                <span class="px-2 py-0.5 rounded bg-eco-green text-white font-heading font-bold uppercase text-[10px] shrink-0">
                    Editorial Preview
                </span>
                <span>{{ $blogData['header']['disclaimer'] }}</span>
            </div>

            <!-- Main Content Grid + Sidebar -->
            <div class="mt-14 grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
                <!-- Left Column: Filter Summary + Articles Grid -->
                <div class="lg:col-span-8 space-y-8">
                    <!-- Active Filter Status Bar -->
                    <div
                        x-show="activeCategory !== 'All' || activeTag !== '' || searchQuery.trim() !== ''"
                        x-cloak
                        class="p-4 rounded-2xl bg-eco-surface border border-eco-border flex flex-wrap items-center justify-between gap-3 text-xs"
                    >
                        <div class="flex flex-wrap items-center gap-2 text-eco-heading">
                            <span class="font-heading font-bold uppercase tracking-wider text-eco-green">Active Filters:</span>
                            <template x-if="activeCategory !== 'All'">
                                <span class="px-3 py-1 rounded-full bg-white border border-eco-border font-semibold" x-text="activeCategory"></span>
                            </template>
                            <template x-if="activeTag !== ''">
                                <span class="px-3 py-1 rounded-full bg-eco-mint-soft text-eco-forest font-semibold" x-text="'#' + activeTag"></span>
                            </template>
                            <template x-if="searchQuery.trim() !== ''">
                                <span class="px-3 py-1 rounded-full bg-white border border-eco-border font-semibold" x-text="'Search: &quot;' + searchQuery.trim() + '&quot;'"></span>
                            </template>
                        </div>
                        <button
                            type="button"
                            @click="resetFilters()"
                            class="text-eco-green hover:text-eco-forest font-heading font-bold underline cursor-pointer"
                        >
                            Clear All Filters
                        </button>
                    </div>

                    <!-- Articles Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach ($blogData['articles'] as $article)
                            @php($searchBlob = $article['title'] . ' ' . $article['excerpt'] . ' ' . $article['category'] . ' ' . implode(' ', $article['tags']))
                            <article
                                id="{{ $article['slug'] }}"
                                x-show="matchesFilter(@js($article['category']), @js($article['tags']), @js($searchBlob))"
                                x-transition.opacity.duration.200ms
                                class="card-3d-tilt {{ $article['featured'] ? 'md:col-span-2' : '' }} bg-white rounded-3xl border border-eco-border/80 shadow-xs hover:shadow-2xl transition-all duration-300 flex flex-col justify-between overflow-hidden group transform-gpu"
                            >
                                <div>
                                    <!-- Article Image -->
                                    <div class="relative {{ $article['featured'] ? 'aspect-[16/8]' : 'aspect-[16/10]' }} overflow-hidden bg-eco-forest/10">
                                        <img
                                            src="{{ asset($article['image']) }}"
                                            alt="{{ $article['title'] }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        >
                                        <div class="absolute inset-0 bg-gradient-to-t from-eco-forest/75 via-transparent to-transparent"></div>

                                        <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-eco-forest/90 backdrop-blur-xs text-eco-mint text-xs font-heading font-semibold">
                                            {{ $article['category'] }}
                                        </span>

                                        <span
                                            x-show="showPlaceholderBadges"
                                            class="absolute bottom-3 right-4 px-2.5 py-0.5 rounded-full bg-eco-green text-white text-[11px] font-heading font-bold"
                                        >
                                            {{ $article['date'] }}
                                        </span>
                                    </div>

                                    <!-- Article Meta & Excerpt -->
                                    <div class="p-7 sm:p-8">
                                        <div class="flex flex-wrap items-center gap-3 text-xs text-eco-body/80 font-medium mb-3">
                                            <span class="inline-flex items-center gap-1.5 text-eco-forest font-semibold">
                                                <span class="w-1.5 h-1.5 rounded-full bg-eco-green"></span>
                                                {{ $article['author'] }}
                                            </span>
                                            <span>•</span>
                                            <span>{{ $article['read_time'] }}</span>
                                        </div>

                                        <h3 class="{{ $article['featured'] ? 'text-2xl sm:text-3xl' : 'text-xl sm:text-2xl' }} font-heading font-bold text-eco-heading group-hover:text-eco-green transition-colors leading-snug">
                                            {{ $article['title'] }}
                                        </h3>

                                        <p class="mt-3 text-sm sm:text-base text-eco-body leading-relaxed">
                                            {{ $article['excerpt'] }}
                                        </p>

                                        <!-- Tags -->
                                        <div class="mt-5 flex flex-wrap gap-2">
                                            @foreach ($article['tags'] as $tag)
                                                <button
                                                    type="button"
                                                    @click="toggleTag(@js($tag))"
                                                    class="px-2.5 py-1 rounded-full bg-eco-surface border border-eco-border/80 text-[11px] font-heading font-semibold text-eco-heading hover:border-eco-green hover:text-eco-green transition cursor-pointer"
                                                >
                                                    #{{ $tag }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Read Full Article Button -->
                                <div class="px-7 sm:px-8 pb-7 sm:pb-8 pt-2">
                                    <button
                                        type="button"
                                        @click="openArticle(@js($article['slug']))"
                                        class="btn-eco-primary w-full justify-center !py-3 text-xs sm:text-sm font-semibold cursor-pointer"
                                    >
                                        <span>Read Full Article</span>
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </button>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Empty Filter State -->
                    <div
                        x-show="matchingCount() === 0"
                        x-cloak
                        class="p-10 rounded-3xl bg-eco-surface border border-eco-border text-center space-y-4"
                    >
                        <h3 class="text-xl font-heading font-bold text-eco-heading">No matching articles found</h3>
                        <p class="text-sm text-eco-body max-w-md mx-auto">
                            Try clearing your search keyword or switching to another renewable energy category.
                        </p>
                        <button
                            type="button"
                            @click="resetFilters()"
                            class="btn-eco-primary cursor-pointer"
                        >
                            <span>Reset Article Filters</span>
                        </button>
                    </div>
                </div>

                <!-- Right Sidebar (Ecozone Blog Sidebar Widgets) -->
                <aside class="lg:col-span-4 space-y-8">
                    <!-- 1. Search Widget -->
                    <div class="p-6 sm:p-7 rounded-3xl bg-eco-surface border border-eco-border/80">
                        <h3 class="text-lg font-heading font-bold text-eco-heading mb-4">Search Articles</h3>
                        <div class="relative">
                            <input
                                type="search"
                                x-model="searchQuery"
                                placeholder="Search topics, solar, LED..."
                                aria-label="Search blog articles"
                                class="w-full pl-4 pr-10 py-3 rounded-2xl bg-white border border-eco-border text-sm text-eco-charcoal placeholder:text-eco-body/60 focus:outline-none focus:border-eco-green"
                            >
                            <svg class="w-4 h-4 text-eco-green absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z" />
                            </svg>
                        </div>
                    </div>

                    <!-- 2. Categories Widget -->
                    <div class="p-6 sm:p-7 rounded-3xl bg-eco-surface border border-eco-border/80">
                        <h3 class="text-lg font-heading font-bold text-eco-heading mb-4">Categories</h3>
                        <ul class="space-y-2">
                            @foreach ($blogData['categories'] as $category)
                                @php($catCount = $category === 'All' ? count($blogData['articles']) : collect($blogData['articles'])->where('category', $category)->count())
                                <li>
                                    <button
                                        type="button"
                                        @click="activeCategory = @js($category)"
                                        :class="activeCategory === @js($category)
                                            ? 'bg-eco-green text-white border-eco-green'
                                            : 'bg-white text-eco-heading border-eco-border/70 hover:border-eco-green hover:text-eco-green'"
                                        class="w-full px-4 py-2.5 rounded-xl border text-xs sm:text-sm font-heading font-bold flex items-center justify-between transition cursor-pointer"
                                    >
                                        <span>{{ $category }}</span>
                                        <span
                                            :class="activeCategory === @js($category) ? 'bg-white/20 text-white' : 'bg-eco-mint-soft text-eco-forest'"
                                            class="px-2 py-0.5 rounded-full text-[11px]"
                                        >
                                            {{ $catCount }}
                                        </span>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- 3. Featured / Recent Articles Widget -->
                    <div class="p-6 sm:p-7 rounded-3xl bg-eco-surface border border-eco-border/80">
                        <h3 class="text-lg font-heading font-bold text-eco-heading mb-5">Featured Highlights</h3>
                        <div class="space-y-4">
                            @foreach (array_slice($blogData['articles'], 0, 3) as $recent)
                                <button
                                    type="button"
                                    @click="openArticle(@js($recent['slug']))"
                                    class="w-full text-left flex items-start gap-3.5 group cursor-pointer"
                                >
                                    <img
                                        src="{{ asset($recent['image']) }}"
                                        alt="{{ $recent['title'] }}"
                                        class="w-16 h-16 rounded-xl object-cover shrink-0 border border-eco-border"
                                    >
                                    <div>
                                        <span class="text-[11px] font-heading font-bold uppercase text-eco-green block">
                                            {{ $recent['read_time'] }}
                                        </span>
                                        <h4 class="text-sm font-heading font-bold text-eco-heading group-hover:text-eco-green transition leading-snug line-clamp-2">
                                            {{ $recent['title'] }}
                                        </h4>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- 4. Tags Cloud Widget -->
                    <div class="p-6 sm:p-7 rounded-3xl bg-eco-surface border border-eco-border/80">
                        <h3 class="text-lg font-heading font-bold text-eco-heading mb-4">Popular Topics</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($blogData['tags'] as $tag)
                                <button
                                    type="button"
                                    @click="toggleTag(@js($tag))"
                                    :class="activeTag === @js($tag)
                                        ? 'bg-eco-green text-white border-eco-green'
                                        : 'bg-white text-eco-heading border-eco-border hover:border-eco-green hover:text-eco-green'"
                                    class="px-3 py-1.5 rounded-full border text-xs font-heading font-semibold transition cursor-pointer"
                                >
                                    #{{ $tag }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- 5. Newsletter Digest Card -->
                    <div class="p-7 rounded-3xl bg-eco-forest text-white space-y-4 shadow-xl">
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/15 text-eco-mint text-[11px] font-heading font-bold uppercase tracking-widest">
                            Monthly Digest
                        </span>
                        <h3 class="text-xl font-heading font-bold text-white leading-snug">
                            Receive Clean Energy Briefs &amp; Policy Updates
                        </h3>
                        <p class="text-xs sm:text-sm text-white/80 leading-relaxed">
                            Subscribe for upcoming Ecowattage research notes, community energy stories, and event announcements.
                        </p>

                        @if (session('newsletter_status'))
                            <div class="p-3 rounded-xl bg-eco-green/25 border border-eco-mint/40 text-xs text-eco-mint">
                                {{ session('newsletter_status') }}
                            </div>
                        @endif

                        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-3">
                            @csrf
                            <input
                                type="email"
                                name="email"
                                required
                                placeholder="Enter your email address"
                                aria-label="Email address for clean energy newsletter"
                                class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-sm text-white placeholder:text-white/60 focus:outline-none focus:border-eco-mint"
                            >
                            <button type="submit" class="btn-eco-primary w-full justify-center !py-3 text-xs sm:text-sm cursor-pointer">
                                <span>Subscribe to Updates</span>
                            </button>
                        </form>
                    </div>
                </aside>
            </div>
        </div>

        <!-- Full Article Reader Modal -->
        <div
            x-show="selectedArticle !== null"
            x-cloak
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-eco-forest/75 backdrop-blur-xs"
            @click.self="closeArticle()"
            role="dialog"
            aria-modal="true"
            aria-label="Full Article Reader"
        >
            <div
                x-show="selectedArticle !== null"
                x-transition
                class="bg-white rounded-3xl max-w-3xl w-full overflow-hidden shadow-2xl border border-eco-border max-h-[90vh] flex flex-col"
            >
                <template x-if="selectedArticle">
                    <div class="overflow-y-auto">
                        <div class="relative aspect-[16/8] bg-eco-forest/10">
                            <img
                                :src="selectedArticle.image"
                                :alt="selectedArticle.title"
                                class="w-full h-full object-cover"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-eco-forest/85 via-transparent to-transparent"></div>
                            <button
                                type="button"
                                @click="closeArticle()"
                                aria-label="Close article reader"
                                class="absolute top-4 right-4 w-9 h-9 rounded-full bg-white/90 text-eco-forest hover:bg-white flex items-center justify-center shadow-md cursor-pointer"
                            >
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <div class="absolute bottom-4 left-6 right-6 flex flex-wrap items-center gap-2">
                                <span class="px-3 py-1 rounded-full bg-eco-green text-white text-xs font-heading font-bold" x-text="selectedArticle.category"></span>
                                <span class="px-3 py-1 rounded-full bg-white/90 text-eco-forest text-xs font-heading font-bold" x-text="selectedArticle.read_time"></span>
                            </div>
                        </div>

                        <div class="p-7 sm:p-9 space-y-5">
                            <div class="flex flex-wrap items-center gap-3 text-xs text-eco-body font-medium">
                                <span class="font-heading font-bold text-eco-forest" x-text="selectedArticle.author"></span>
                                <span>•</span>
                                <span x-text="selectedArticle.date"></span>
                            </div>

                            <h3 class="text-2xl sm:text-3xl font-heading font-bold text-eco-heading leading-tight" x-text="selectedArticle.title"></h3>

                            <div class="space-y-4 text-sm sm:text-base text-eco-body leading-relaxed">
                                <template x-for="(paragraph, idx) in selectedArticle.body" :key="idx">
                                    <p x-text="paragraph"></p>
                                </template>
                            </div>

                            <div class="p-5 rounded-2xl bg-eco-surface border border-eco-border">
                                <h4 class="text-xs font-heading font-bold uppercase tracking-wider text-eco-green mb-3">
                                    Key Takeaways
                                </h4>
                                <ul class="space-y-2">
                                    <template x-for="(point, pIdx) in selectedArticle.key_takeaways" :key="pIdx">
                                        <li class="flex items-start gap-2.5 text-sm text-eco-heading">
                                            <span class="w-2 h-2 rounded-full bg-eco-green mt-1.5 shrink-0"></span>
                                            <span x-text="point"></span>
                                        </li>
                                    </template>
                                </ul>
                            </div>

                            <div class="pt-4 border-t border-eco-border flex flex-wrap items-center justify-between gap-3">
                                <a href="{{ route('contact') }}" class="btn-eco-primary">
                                    <span>Submit an Editorial Inquiry</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                                <button
                                    type="button"
                                    @click="closeArticle()"
                                    class="px-5 py-2.5 rounded-full border border-eco-border text-xs font-heading font-bold text-eco-heading hover:bg-eco-surface cursor-pointer"
                                >
                                    Close Reader
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>

    {{-- =====================================================================
         SECTION 2: CALL TO ACTION BANNER (Ecozone CTA Layout 1)
         ===================================================================== --}}
    <section class="py-16 lg:py-24 bg-eco-forest text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-eco-forest via-eco-forest/95 to-eco-green-dark/90 p-8 sm:p-12 lg:p-16 border border-white/10 shadow-2xl">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-8 space-y-4">
                        <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/15 text-eco-mint text-xs font-heading font-bold uppercase tracking-widest">
                            Share Clean Energy Knowledge
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-heading font-bold text-white leading-tight">
                            Contribute Research Notes or Feature a Community Energy Story
                        </h2>
                        <p class="text-white/85 text-sm sm:text-base max-w-2xl leading-relaxed">
                            Researchers, energy practitioners, and community leaders are welcome to collaborate with our editorial and publications desk.
                        </p>
                    </div>

                    <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3.5 justify-end">
                        <a href="{{ route('publications') }}" class="btn-eco-primary justify-center">
                            <span>Explore Publications</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="{{ route('contact') }}" class="btn-eco-white justify-center">
                            <span>Contact Editorial Desk</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>

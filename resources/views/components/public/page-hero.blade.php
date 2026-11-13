@props([
    'title' => '',
    'subtitle' => 'Home',
    'image' => '/images/illustrative/hero-solar-microgrid.jpg',
])

<section class="relative bg-eco-forest text-white py-20 lg:py-28 overflow-hidden">
    <!-- Atmospheric Background Image with Overlay -->
    <div class="absolute inset-0 pointer-events-none">
        <img
            src="{{ asset($image) }}"
            alt="{{ $title }}"
            class="w-full h-full object-cover opacity-20"
        >
        <div class="absolute inset-0 bg-gradient-to-r from-eco-forest via-eco-forest/90 to-[#045D3B]/80"></div>
    </div>

    <!-- Organic Decorative Curves -->
    <div class="absolute inset-0 pointer-events-none opacity-15">
        <svg class="w-full h-full" viewBox="0 0 1440 320" fill="none" preserveAspectRatio="none">
            <path d="M0,192L60,186.7C120,181,240,171,360,181.3C480,192,600,224,720,218.7C840,213,960,171,1080,165.3C1200,160,1320,192,1380,208L1440,224L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z" fill="#00A86B"></path>
        </svg>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="Breadcrumb" class="inline-flex items-center gap-2 text-xs sm:text-sm font-medium text-eco-mint mb-4">
            <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Home</span>
            </a>
            <span class="text-white/40">/</span>
            <span class="text-white">{{ $title }}</span>
        </nav>

        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-heading font-extrabold text-white tracking-tight">
            {{ $title }}
        </h1>
        <p class="mt-4 max-w-2xl mx-auto text-base sm:text-lg text-white/80 leading-relaxed">
            Powering Africa's Green Future through advocacy, public energy literacy, and indigenous clean-tech manufacturing.
        </p>
    </div>
</section>

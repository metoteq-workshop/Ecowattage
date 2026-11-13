@props([
    'title' => "Ecowattage — Powering Africa's Green Future",
    'metaDescription' => 'Ecowattage is a renewable energy company focused on advocacy, public education, innovation, and the future manufacturing of renewable energy products across Africa.',
    'site' => [],
    'navigation' => [],
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="robots" content="index, follow">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Ecowattage">
    <meta property="og:image" content="{{ asset('images/ecowattage-official-logo.png') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/ecowattage-emblem.png') }}">

    <!-- Google Fonts: Encode Sans Condensed (Headings) & Roboto (Body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Condensed:wght@400;500;600;700;800;900&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Alpine.js for interactive sliders, accordions, drawers, and modals -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body
    x-data="{
        showPlaceholderBadges: true,
        scrolled: false,
        videoModalOpen: false
    }"
    @scroll.window="scrolled = (window.pageYOffset > 300)"
    class="bg-white text-eco-charcoal antialiased selection:bg-eco-green selection:text-white flex flex-col min-h-screen"
>
    <!-- Accessibility Skip Link -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:bg-eco-green focus:text-white focus:px-4 focus:py-2 focus:rounded-lg focus:shadow-lg">
        Skip to main content
    </a>

    <!-- Shared Sticky Header Navigation (includes Top Header Bar & Main Menu Header) -->
    <x-public.header :site="$site" :navigation="$navigation" />

    <!-- Main Page Content -->
    <main id="main-content" class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Shared Multi-Column Footer -->
    <x-public.footer :site="$site" :navigation="$navigation" />

    <!-- Back to Top Button -->
    <button
        type="button"
        x-cloak
        x-show="scrolled"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-6 right-6 z-40 w-12 h-12 rounded-full bg-eco-green text-white shadow-lg shadow-eco-green/30 hover:bg-eco-forest transition flex items-center justify-center cursor-pointer"
        aria-label="Scroll back to top"
    >
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
        </svg>
    </button>
</body>
</html>

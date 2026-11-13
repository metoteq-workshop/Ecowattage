<x-layouts.public
    :title="$pageTitle . ' — Ecowattage (Stage 1 Queue)'"
    :site="$site"
    :navigation="$navigation"
>
    <section class="py-24 lg:py-32 bg-eco-surface">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-eco-mint-soft text-eco-green border border-eco-mint text-xs font-heading font-bold uppercase tracking-widest">
                Stage 1 Page-by-Page Build Queue
            </span>
            <h1 class="mt-4 text-3xl sm:text-5xl font-heading font-bold text-eco-heading">
                {{ $pageTitle }}
            </h1>
            <p class="mt-4 text-base sm:text-lg text-eco-body leading-relaxed">
                Per our page-by-page development workflow, this route (<code class="px-2 py-0.5 rounded bg-white border border-eco-border text-eco-green font-mono text-sm">/{{ $routeName }}</code>) is registered and ready to be built as soon as you select it as our next page.
            </p>
            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('home') }}" class="btn-eco-primary">
                    <span>Return to Completed Homepage</span>
                </a>
            </div>
        </div>
    </section>
</x-layouts.public>

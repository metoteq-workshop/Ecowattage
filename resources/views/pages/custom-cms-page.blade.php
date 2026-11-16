<x-layouts.public
    :title="$cmsPage->meta_title ?: ($cmsPage->title . ' — ' . ($site['name'] ?? 'Ecowattage'))"
    :metaDescription="$cmsPage->meta_description ?: ($cmsPage->summary ?? '')"
    :site="$site"
    :navigation="$navigation"
    :cmsPage="$cmsPage"
>
    <x-public.page-hero
        :title="$cmsPage->title"
        :image="$cmsPage->featured_image ?: '/images/illustrative/hero-solar-microgrid.jpg'"
    />

    <section class="py-20 lg:py-28 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            @if ($cmsPage->summary)
                <p class="text-lg sm:text-xl font-heading font-semibold text-eco-forest leading-relaxed">
                    {{ $cmsPage->summary }}
                </p>
            @endif

            <div class="prose max-w-none text-eco-body leading-relaxed space-y-4">
                {!! nl2br(e((string) $cmsPage->content)) !!}
            </div>
        </div>
    </section>
</x-layouts.public>

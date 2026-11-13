@props([
    'subtitle' => '',
    'title' => '',
    'description' => null,
    'align' => 'center',
    'light' => false,
])

@php
    $alignClasses = match ($align) {
        'left' => 'text-left items-start',
        'right' => 'text-right items-end',
        default => 'text-center items-center mx-auto max-w-3xl',
    };
@endphp

<div {{ $attributes->merge(['class' => "flex flex-col {$alignClasses}"]) }}>
    @if ($subtitle)
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-heading font-bold uppercase tracking-widest mb-3.5 {{ $light ? 'bg-white/15 text-eco-mint border border-white/20' : 'bg-eco-mint-soft text-eco-green border border-eco-mint' }}">
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17 8C8 10 5.9 16.17 3.82 21.34L5.71 22l1-2.3A4.49 4.49 0 0 0 8 20C19 20 22 3 22 3c-1 2-8 2.25-13 3.25S2 11.5 2 13.5s1.75 3.75 1.75 3.75C7 8 17 8 17 8Z"/>
            </svg>
            <span>{{ $subtitle }}</span>
        </div>
    @endif

    @if ($title)
        <h2 class="text-3xl sm:text-4xl lg:text-[42px] font-heading font-bold leading-[1.18] {{ $light ? 'text-white' : 'text-eco-heading' }}">
            {!! nl2br(e($title)) !!}
        </h2>
    @endif

    @if ($description)
        <p class="mt-4 text-base sm:text-lg leading-relaxed {{ $light ? 'text-white/85' : 'text-eco-body' }}">
            {{ $description }}
        </p>
    @endif
</div>

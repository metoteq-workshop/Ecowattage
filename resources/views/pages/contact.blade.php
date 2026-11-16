<x-layouts.public
    :title="'Contact Us — ' . ($site['name'] ?? 'Ecowattage')"
    :metaDescription="'Contact Ecowattage in Freetown, Sierra Leone to propose community solar blueprints, request school energy literacy workshops, or explore clean-tech partnerships.'"
    :site="$site"
    :navigation="$navigation"
>
    {{-- Page Breadcrumb Hero Banner --}}
    <x-public.page-hero
        title="Contact Us"
        image="/images/illustrative/about-engineering-field.jpg"
    />

    {{-- =====================================================================
         SECTION 1: CONTACT CARDS & VERIFIED TRANSPARENCY NOTICE
         ===================================================================== --}}
    <section class="py-20 lg:py-28 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                :subtitle="$contactData['header']['subtitle']"
                :title="$contactData['header']['title']"
                :description="$contactData['header']['description']"
            />

            <!-- Transparency Notice -->
            <div
                x-show="showPlaceholderBadges"
                class="mt-8 max-w-4xl mx-auto p-4 rounded-2xl bg-eco-mint-soft/80 border border-eco-mint text-xs text-eco-forest flex items-start sm:items-center gap-3"
            >
                <span class="px-2 py-0.5 rounded bg-eco-green text-white font-heading font-bold uppercase text-[10px] shrink-0">
                    Contact Notice
                </span>
                <span>{{ $contactData['header']['disclaimer'] }}</span>
            </div>

            <!-- 4 Contact Info Cards (Ecozone Contact Info Strip) -->
            <div class="mt-14 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($contactData['contact_cards'] as $card)
                    <div class="card-3d-tilt p-7 rounded-3xl bg-eco-surface border border-eco-border/80 shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between transform-gpu">
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-5">
                                <span class="w-12 h-12 rounded-2xl bg-eco-mint-soft text-eco-green flex items-center justify-center shrink-0">
                                    @if ($card['icon'] === 'location')
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    @elseif ($card['icon'] === 'phone')
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    @elseif ($card['icon'] === 'email')
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @endif
                                </span>

                                <span
                                    x-show="showPlaceholderBadges"
                                    class="px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-900 text-[10px] font-heading font-bold uppercase"
                                >
                                    {{ $card['badge'] }}
                                </span>
                            </div>

                            <h3 class="text-lg font-heading font-bold text-eco-heading">
                                {{ $card['title'] }}
                            </h3>
                            <p class="mt-2 text-sm font-heading font-bold text-eco-green break-words">
                                {{ $card['primary'] }}
                            </p>
                            <p class="mt-1.5 text-xs text-eco-body leading-relaxed">
                                {{ $card['secondary'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Main Contact Form + Regional Location & Desks Split -->
            <div class="mt-16 grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
                <!-- Left Column: Interactive Inquiry Form -->
                <div class="lg:col-span-7 bg-eco-surface rounded-3xl p-8 sm:p-10 lg:p-12 border border-eco-border/80 shadow-xs">
                    <span class="inline-flex items-center gap-2 text-xs font-heading font-bold uppercase tracking-widest text-eco-green">
                        <span class="w-6 h-0.5 bg-eco-green rounded-full"></span>
                        Direct Message &amp; Proposal Form
                    </span>
                    <h3 class="mt-2 text-2xl sm:text-3xl font-heading font-bold text-eco-heading">
                        Send Us an Inquiry or Project Proposal
                    </h3>
                    <p class="mt-2 text-sm text-eco-body">
                        Complete the form below and select the relevant coordination track so our team can respond promptly.
                    </p>

                    @if (session('contact_status'))
                        <div class="mt-6 p-4 rounded-2xl bg-eco-mint-soft border border-eco-green/40 text-sm text-eco-forest font-medium flex items-start gap-3">
                            <svg class="w-5 h-5 text-eco-green shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>{{ session('contact_status') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mt-6 p-4 rounded-2xl bg-red-50 border border-red-200 text-xs text-red-800 space-y-1">
                            <div class="font-heading font-bold uppercase">Please check your form entries:</div>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="mt-8 space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="contact-name" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-2">
                                    Full Name <span class="text-eco-green">*</span>
                                </label>
                                <input
                                    id="contact-name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                    placeholder="Your full name"
                                    class="w-full px-4 py-3 rounded-xl bg-white border border-eco-border text-sm text-eco-charcoal focus:outline-none focus:border-eco-green"
                                >
                            </div>

                            <div>
                                <label for="contact-email" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-2">
                                    Email Address <span class="text-eco-green">*</span>
                                </label>
                                <input
                                    id="contact-email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    placeholder="you@example.org"
                                    class="w-full px-4 py-3 rounded-xl bg-white border border-eco-border text-sm text-eco-charcoal focus:outline-none focus:border-eco-green"
                                >
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="contact-organization" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-2">
                                    Organization / Community (Optional)
                                </label>
                                <input
                                    id="contact-organization"
                                    type="text"
                                    name="organization"
                                    value="{{ old('organization') }}"
                                    placeholder="School, Clinic, NGO, or Ministry"
                                    class="w-full px-4 py-3 rounded-xl bg-white border border-eco-border text-sm text-eco-charcoal focus:outline-none focus:border-eco-green"
                                >
                            </div>

                            <div>
                                <label for="contact-inquiry-type" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-2">
                                    Inquiry Category <span class="text-eco-green">*</span>
                                </label>
                                <select
                                    id="contact-inquiry-type"
                                    name="inquiry_type"
                                    required
                                    class="w-full px-4 py-3 rounded-xl bg-white border border-eco-border text-sm text-eco-charcoal focus:outline-none focus:border-eco-green"
                                >
                                    @foreach ($contactData['inquiry_categories'] as $cat)
                                        <option value="{{ $cat }}" @selected(old('inquiry_type') === $cat)>
                                            {{ $cat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="contact-subject" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-2">
                                Subject <span class="text-eco-green">*</span>
                            </label>
                            <input
                                id="contact-subject"
                                type="text"
                                name="subject"
                                value="{{ old('subject') }}"
                                required
                                placeholder="Brief summary of your request or proposal"
                                class="w-full px-4 py-3 rounded-xl bg-white border border-eco-border text-sm text-eco-charcoal focus:outline-none focus:border-eco-green"
                            >
                        </div>

                        <div>
                            <label for="contact-message" class="block text-xs font-heading font-bold uppercase tracking-wider text-eco-heading mb-2">
                                Message &amp; Details <span class="text-eco-green">*</span>
                            </label>
                            <textarea
                                id="contact-message"
                                name="message"
                                rows="5"
                                required
                                placeholder="Share location details, project scope, workshop goals, or partnership questions..."
                                class="w-full px-4 py-3 rounded-xl bg-white border border-eco-border text-sm text-eco-charcoal focus:outline-none focus:border-eco-green"
                            >{{ old('message') }}</textarea>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="btn-eco-primary w-full sm:w-auto justify-center cursor-pointer">
                                <span>Submit Inquiry</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Column: Coordination Desks + Map / Location Slot -->
                <div class="lg:col-span-5 space-y-6">
                    <!-- Regional Operations Map Slot (Non-Fabricated Coordinates) -->
                    <div class="rounded-3xl bg-eco-forest text-white p-7 sm:p-8 shadow-xl space-y-4 relative overflow-hidden">
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/15 text-eco-mint text-[11px] font-heading font-bold uppercase tracking-widest">
                            West Africa Operations Hub
                        </span>
                        <h3 class="text-xl sm:text-2xl font-heading font-bold text-white">
                            Freetown, Sierra Leone Coordination Base
                        </h3>
                        <p class="text-xs sm:text-sm text-white/80 leading-relaxed">
                            Our core advocacy, engineering, and clean-tech R&amp;D operations are anchored in Freetown, serving urban, peri-urban, and rural districts across Sierra Leone and West Africa.
                        </p>
                        <div class="p-4 rounded-2xl bg-white/10 border border-white/15 text-xs space-y-1.5">
                            <div class="font-heading font-bold text-eco-mint uppercase tracking-wider">Interactive Map Embed Slot</div>
                            <p class="text-white/85">
                                Exact street pin and Google Maps / OpenStreetMap coordinates will be configured in Stage 2 CMS once the official street address is confirmed.
                            </p>
                        </div>
                    </div>

                    <!-- 3 Specialized Coordination Desks -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-heading font-bold text-eco-heading px-1">
                            Specialized Coordination Desks
                        </h3>
                        @foreach ($contactData['coordination_desks'] as $desk)
                            <div class="p-6 rounded-2xl bg-eco-surface border border-eco-border/80 flex items-start gap-4">
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-eco-mint-soft text-eco-green font-heading font-extrabold text-sm shrink-0">
                                    {{ $desk['number'] }}
                                </span>
                                <div class="space-y-1.5">
                                    <h4 class="text-base font-heading font-bold text-eco-heading">
                                        {{ $desk['title'] }}
                                    </h4>
                                    <p class="text-xs sm:text-sm text-eco-body leading-relaxed">
                                        {{ $desk['focus'] }}
                                    </p>
                                    <a
                                        href="{{ route($desk['route']) }}"
                                        class="inline-flex items-center gap-1.5 text-xs font-heading font-bold text-eco-green hover:text-eco-forest transition pt-1"
                                    >
                                        <span>{{ $desk['cta'] }}</span>
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =====================================================================
         SECTION 2: INQUIRY FAQ ACCORDION
         ===================================================================== --}}
    <section
        x-data="{ openFaq: 0 }"
        class="py-20 lg:py-24 bg-eco-surface border-t border-eco-border"
    >
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.section-heading
                subtitle="Common Inquiry Questions"
                title="How We Coordinate Proposals, Workshops & Research"
                description="Quick answers on how schools, clinics, researchers, and institutional partners connect with Ecowattage."
            />

            <div class="mt-12 space-y-4">
                @foreach ($contactData['faqs'] as $idx => $faq)
                    <div class="rounded-2xl bg-white border border-eco-border/80 overflow-hidden shadow-2xs">
                        <button
                            type="button"
                            @click="openFaq = openFaq === {{ $idx }} ? null : {{ $idx }}"
                            class="w-full px-6 py-5 text-left flex items-center justify-between gap-4 cursor-pointer"
                        >
                            <span class="text-base sm:text-lg font-heading font-bold text-eco-heading">
                                {{ $faq['question'] }}
                            </span>
                            <span
                                :class="openFaq === {{ $idx }} ? 'bg-eco-green text-white rotate-180' : 'bg-eco-surface text-eco-heading'"
                                class="w-8 h-8 rounded-full flex items-center justify-center transition-transform shrink-0"
                            >
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div
                            x-show="openFaq === {{ $idx }}"
                            x-collapse
                            class="px-6 pb-5 text-sm sm:text-base text-eco-body leading-relaxed border-t border-eco-border/50 pt-4"
                        >
                            {{ $faq['answer'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.public>

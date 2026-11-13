<?php

declare(strict_types=1);

namespace App\Support;

class StageOneData
{
    /**
     * Brand and site-wide configuration for Stage 1.
     *
     * @return array<string, mixed>
     */
    public static function siteConfig(): array
    {
        return [
            'name' => 'Ecowattage',
            'tagline' => "Powering Africa's Green Future",
            'secondary_motto' => 'Turning Awareness into Clean Energy',
            'description' => 'Ecowattage is a renewable energy company focused on advocacy, public education, innovation, and the future manufacturing of renewable energy products across Africa.',
            'logo_clean' => '/images/ecowattage-official-logo.png',
            'logo_full' => '/images/ecowattage-official-logo.png',
            'logo_emblem' => '/images/ecowattage-emblem.png',
            'contact' => [
                'address' => 'Freetown, Sierra Leone [Official Street Address to Be Supplied]',
                'phone' => '+232 [Official Phone Number to Be Supplied]',
                'whatsapp' => '+232 [Official WhatsApp Number to Be Supplied]',
                'email' => 'info@ecowattage.com [Confirm Official Email]',
                'hours' => 'Mon – Fri: 8:30 AM – 5:00 PM (GMT)',
                'is_placeholder' => true,
            ],
            'socials' => [
                ['name' => 'Facebook', 'url' => '#facebook-pending', 'icon' => 'facebook'],
                ['name' => 'LinkedIn', 'url' => '#linkedin-pending', 'icon' => 'linkedin'],
                ['name' => 'X (Twitter)', 'url' => '#twitter-pending', 'icon' => 'twitter'],
                ['name' => 'YouTube', 'url' => '#youtube-pending', 'icon' => 'youtube'],
            ],
        ];
    }

    /**
     * Primary navigation structure for the public website.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function navigation(): array
    {
        return [
            [
                'label' => 'Home',
                'route' => 'home',
                'built' => true,
            ],
            [
                'label' => 'About Us',
                'route' => 'about',
                'built' => true,
            ],
            [
                'label' => 'Services',
                'route' => 'services',
                'built' => true,
            ],
            [
                'label' => 'Initiatives',
                'route' => 'campaigns',
                'built' => false,
                'children' => [
                    [
                        'label' => 'Advocacy Campaigns',
                        'route' => 'campaigns',
                        'description' => 'Public awareness drives & policy engagement across Africa',
                        'built' => true,
                    ],
                    [
                        'label' => 'Projects Showcase',
                        'route' => 'projects',
                        'description' => 'Solar, wind, hydro & community electrification initiatives',
                        'built' => true,
                    ],
                ],
            ],
            [
                'label' => 'Resources',
                'route' => 'blog',
                'built' => false,
                'children' => [
                    [
                        'label' => 'Blog & News',
                        'route' => 'blog',
                        'description' => 'Renewable energy articles, press updates & insights',
                        'built' => true,
                    ],
                    [
                        'label' => 'Publications & Research',
                        'route' => 'publications',
                        'description' => 'Policy briefs, white papers & educational toolkits',
                        'built' => false,
                    ],
                    [
                        'label' => 'Events & Media Gallery',
                        'route' => 'events-gallery',
                        'description' => 'Workshops, conferences, photo & video documentation',
                        'built' => false,
                    ],
                ],
            ],
            [
                'label' => 'Partners & Careers',
                'route' => 'partners-careers',
                'built' => false,
            ],
            [
                'label' => 'Contact',
                'route' => 'contact',
                'built' => false,
            ],
        ];
    }

    /**
     * All 11 Homepage sections modeled on https://ecozone-laravel.laralink.com/nature.
     *
     * @return array<string, mixed>
     */
    public static function homePageData(): array
    {
        return [
            // Section 1: Hero Slider (Ecozone Hero Layout 1)
            'hero_slides' => [
                [
                    'eyebrow' => "Powering Africa's Green Future",
                    'title' => 'Turning Public Awareness Into Clean, Reliable Energy Across Africa',
                    'description' => 'Ecowattage bridges renewable energy advocacy, community education, and clean-tech innovation—laying the foundation for sustainable power and future African clean energy manufacturing.',
                    'primary_cta' => ['label' => 'Explore Our Mission', 'url' => '#about-section'],
                    'secondary_cta' => ['label' => 'Our Advocacy & Solutions', 'url' => '#services-section'],
                    'main_image' => '/images/illustrative/hero-solar-microgrid.jpg',
                    'main_image_alt' => 'Illustrative documentary photo of African solar engineers inspecting a solar array',
                    'secondary_image' => '/images/illustrative/hero-energy-education.jpg',
                    'secondary_image_alt' => 'Illustrative documentary photo of a community renewable energy education session',
                    'image_caption' => 'Illustrative Photography — Depicting clean energy engineering and community education in West Africa',
                ],
                [
                    'eyebrow' => 'Advocacy • Education • Innovation',
                    'title' => 'Empowering Communities Through Renewable Energy Literacy & Action',
                    'description' => 'From grassroots workshops in Sierra Leone to regional policy engagement, we equip citizens, institutions, and future engineers with the knowledge to accelerate the clean energy transition.',
                    'primary_cta' => ['label' => 'View Active Campaigns', 'url' => '#campaigns-section'],
                    'secondary_cta' => ['label' => 'Partner With Us', 'url' => '#cta-section'],
                    'main_image' => '/images/illustrative/hero-energy-education.jpg',
                    'main_image_alt' => 'Illustrative documentary photo of an outdoor solar training demonstration in West Africa',
                    'secondary_image' => '/images/illustrative/about-engineering-field.jpg',
                    'secondary_image_alt' => 'Illustrative documentary photo of renewable energy specialists reviewing system plans',
                    'image_caption' => 'Illustrative Photography — Depicting public renewable energy education and technical training',
                ],
                [
                    'eyebrow' => 'Future Clean-Tech Manufacturing',
                    'title' => 'Building the Next Generation of African Renewable Energy Products',
                    'description' => 'Beyond advocacy and advisory, Ecowattage is preparing the roadmap for local assembly and manufacturing of high-efficiency LED lighting, solar components, and clean energy systems tailored for African grids and off-grid homes.',
                    'primary_cta' => ['label' => 'Discover Our Roadmap', 'url' => '#services-section'],
                    'secondary_cta' => ['label' => 'Read Latest Insights', 'url' => '#blog-section'],
                    'main_image' => '/images/illustrative/campaign-innovation-lab.jpg',
                    'main_image_alt' => 'Illustrative documentary photo of an African electrical technician testing battery and LED systems',
                    'secondary_image' => '/images/illustrative/campaign-clinic-solar.jpg',
                    'secondary_image_alt' => 'Illustrative documentary photo of a solar-powered community health clinic',
                    'image_caption' => 'Illustrative Photography — Depicting clean energy component testing and solar electrification',
                ],
            ],

            // Section 2: 3-Column Feature Strip (Ecozone AditionalFeature Layout 1)
            'core_pillars' => [
                [
                    'number' => '01',
                    'title' => 'Renewable Energy Advocacy',
                    'subtitle' => 'Championing supportive clean energy policies, climate resilience, and equitable access to sustainable electricity across Sierra Leone and the wider African continent.',
                    'icon' => 'advocacy',
                    'tag' => 'Policy & Public Voice',
                ],
                [
                    'number' => '02',
                    'title' => 'Public Education & Literacy',
                    'subtitle' => 'Demystifying solar, wind, hydro, and energy efficiency through community workshops, school outreach, research publications, and practical public guides.',
                    'icon' => 'education',
                    'tag' => 'Knowledge Centre',
                ],
                [
                    'number' => '03',
                    'title' => 'Innovation & Future Manufacturing',
                    'subtitle' => 'Pioneering practical renewable energy solutions today while developing the technical capacity to manufacture energy-efficient LED bulbs and solar products in Africa.',
                    'icon' => 'manufacturing',
                    'tag' => 'Clean-Tech Roadmap',
                ],
            ],

            // Section 3: About Us Split Section (Ecozone About Layout 1)
            'about' => [
                'subtitle' => 'About Ecowattage',
                'title' => "Creating a Lasting Alliance for Africa's Greener, Cleaner Energy Future",
                'description' => 'Ecowattage is a renewable energy organization committed to transforming how communities, businesses, and policymakers across Africa understand and adopt clean power. We believe that lasting energy independence begins with informed citizens, strong advocacy, and locally adapted engineering innovation.',
                'primary_image' => '/images/illustrative/about-engineering-field.jpg',
                'secondary_image' => '/images/illustrative/hero-energy-education.jpg',
                'image_disclaimer' => 'Illustrative documentary photography — Replace with official Ecowattage field photos via CMS',
                'features' => [
                    [
                        'title' => 'Our Mission',
                        'description' => 'To accelerate the adoption of renewable energy across Africa through relentless public advocacy, accessible energy education, and innovative, locally grounded clean energy solutions.',
                        'icon' => 'mission',
                    ],
                    [
                        'title' => 'Our Vision & Values',
                        'description' => 'A self-sustaining, green-powered Africa driven by scientific integrity, community inclusivity, environmental stewardship, and indigenous clean-technology manufacturing.',
                        'icon' => 'vision',
                    ],
                ],
                'cta_text' => 'Learn More About Us',
                'cta_route' => 'about',
            ],

            // Section 4: Services Showcase (Ecozone Service Layout 1)
            'services' => [
                'subtitle' => 'Solutions & Services',
                'title' => 'Our Renewable Energy Services & Strategic Focus Areas',
                'description' => 'Discover how Ecowattage combines grassroots advocacy, technical education, and clean energy innovation to drive measurable sustainability.',
                'items' => [
                    [
                        'title' => 'Advocacy & Policy Campaigns',
                        'subtitle' => 'Organizing public awareness drives, stakeholder dialogues, and clean-energy transition campaigns that mobilize communities and inform policy.',
                        'icon' => 'megaphone',
                        'badge' => 'Active Pillar',
                        'route' => 'campaigns',
                    ],
                    [
                        'title' => 'Public Energy Education',
                        'subtitle' => 'Delivering structured workshops, school seminars, and open-access publications covering solar power, energy conservation, and climate resilience.',
                        'icon' => 'book-open',
                        'badge' => 'Active Pillar',
                        'route' => 'publications',
                    ],
                    [
                        'title' => 'Renewable Energy Advisory',
                        'subtitle' => 'Providing technical guidance for institutions, NGOs, and communities planning solar microgrids, clean lighting retrofits, and off-grid energy systems.',
                        'icon' => 'sun-bolt',
                        'badge' => 'Advisory',
                        'route' => 'services',
                    ],
                    [
                        'title' => 'Future Clean-Tech Manufacturing',
                        'subtitle' => 'Developing Africa-based production capabilities for energy-efficient LED lighting, solar home kits, and durable renewable energy hardware.',
                        'icon' => 'cpu-chip',
                        'badge' => 'Future Phase',
                        'route' => 'services',
                    ],
                ],
            ],

            // Section 5: FunFact / Impact Counter Strip (Ecozone FunFact Layout 1)
            'funfacts' => [
                'disclaimer' => 'Company Data Needed: The figures below are structural layout placeholders matching the reference design. Supply official Ecowattage targets or verified metrics to replace them.',
                'items' => [
                    [
                        'value' => '[Metric 1]',
                        'sample_display' => 'Sierra Leone & Africa',
                        'label' => 'Geographic Advocacy Focus',
                        'note' => 'Confirm number of districts/regions reached',
                    ],
                    [
                        'value' => '[Metric 2]',
                        'sample_display' => '4 Core Pillars',
                        'label' => 'Solar, Wind, Hydro & Efficiency',
                        'note' => 'Confirm total educational modules or workshops held',
                    ],
                    [
                        'value' => '[Metric 3]',
                        'sample_display' => '100% Clean',
                        'label' => 'Commitment to Sustainable Power',
                        'note' => 'Confirm completed/active project count',
                    ],
                    [
                        'value' => '[Metric 4]',
                        'sample_display' => 'Open Network',
                        'label' => 'Volunteers, Partners & Advocates',
                        'note' => 'Confirm registered volunteer & partner count',
                    ],
                ],
            ],

            // Section 6: FAQ Split Section (Ecozone Faq Layout 2)
            'faq' => [
                'subtitle' => 'Frequently Asked Questions',
                'title' => 'Have Questions About Ecowattage?',
                'image' => '/images/illustrative/faq-community-workshop.jpg',
                'image_caption' => 'Illustrative Photography — Community energy literacy workshop setting in West Africa',
                'items' => [
                    [
                        'question' => '1. What is the primary mission of Ecowattage?',
                        'answer' => 'Ecowattage is dedicated to powering Africa’s green future through four interconnected pillars: renewable energy advocacy, public education, clean-technology innovation, and the future manufacturing of renewable energy products such as high-efficiency LED lighting and solar systems.',
                    ],
                    [
                        'question' => '2. How can organizations, donors, or communities partner with Ecowattage?',
                        'answer' => 'We collaborate with community groups, educational institutions, development agencies, grantmakers, and corporate partners on clean energy awareness campaigns, research publications, and pilot electrification projects. You can initiate a partnership directly through our Partners or Contact pages.',
                    ],
                    [
                        'question' => '3. Does Ecowattage currently sell renewable energy hardware online?',
                        'answer' => 'Our current focus is on advocacy, public education, stakeholder engagement, and project development while we establish our clean-technology manufacturing infrastructure. Future phases of our platform will introduce a product catalogue, LED showcase, and dealer network.',
                    ],
                    [
                        'question' => '4. How can I get involved as a volunteer or clean energy advocate?',
                        'answer' => 'Students, engineers, educators, and community organizers can register interest as volunteers or guest contributors to support our local workshops, awareness drives, and educational outreach across Sierra Leone and Africa.',
                    ],
                ],
            ],

            // Section 7: Advocacy Campaigns & Initiatives (Ecozone DonationCampaign Layout 1)
            'campaigns' => [
                'subtitle' => 'Advocacy & Action',
                'title' => "Supporting Our Renewable Energy\nAdvocacy & Community Initiatives",
                'disclaimer' => 'Illustrative Campaign Previews — Replace with official Ecowattage campaign titles, milestones, and field photos in the CMS.',
                'items' => [
                    [
                        'category' => 'Public Literacy Campaign',
                        'title' => 'Clean Energy Awareness for Schools & Youth Across Sierra Leone',
                        'description' => 'Equipping secondary schools and youth hubs with hands-on renewable energy educational toolkits, solar demonstration units, and climate literacy guides.',
                        'image' => '/images/illustrative/hero-energy-education.jpg',
                        'status_label' => 'Advocacy Milestone',
                        'progress_percent' => 75,
                        'target_note' => '[Supply Official Campaign Target / Reach]',
                        'cta_label' => 'Support This Campaign',
                    ],
                    [
                        'category' => 'Community Electrification Advocacy',
                        'title' => 'Solar Power Advocacy for Rural Health & Community Centres',
                        'description' => 'Mobilizing institutional partners and donors to prioritize reliable off-grid solar and battery storage for essential rural healthcare and community facilities.',
                        'image' => '/images/illustrative/campaign-clinic-solar.jpg',
                        'status_label' => 'Partnership Drive',
                        'progress_percent' => 60,
                        'target_note' => '[Supply Official Project Scope / Funding Goal]',
                        'cta_label' => 'Partner on This Initiative',
                    ],
                    [
                        'category' => 'Energy Efficiency & Innovation',
                        'title' => 'Transitioning Households & SMEs to High-Efficiency LED & Solar Tech',
                        'description' => 'Educating households and local enterprises on reducing electricity costs and grid strain through quality energy-efficient lighting and clean backup power.',
                        'image' => '/images/illustrative/campaign-innovation-lab.jpg',
                        'status_label' => 'Innovation Roadmap',
                        'progress_percent' => 45,
                        'target_note' => '[Supply Official Programme Timeline]',
                        'cta_label' => 'Learn How to Participate',
                    ],
                ],
            ],

            // Section 8: Stakeholder Voices / Testimonials (Ecozone Testimonial Layout 1)
            'testimonials' => [
                'subtitle' => 'Stakeholder Voices',
                'title' => 'Why Clean Energy Advocacy Matters to Our Communities',
                'disclaimer' => 'No Fabricated Testimonials Policy: The cards below demonstrate the Ecozone reference testimonial layout using clearly labeled illustrative stakeholder perspectives until verified quotes from Ecowattage partners and beneficiaries are provided.',
                'items' => [
                    [
                        'quote' => '[Official Testimonial Needed] — Insert a verified quote from a community leader or workshop participant describing the impact of Ecowattage’s renewable energy education sessions.',
                        'name' => '[Community Representative Name]',
                        'role' => 'Community Education Stakeholder (Placeholder)',
                        'badge' => 'Awaiting Official Quote',
                    ],
                    [
                        'quote' => '[Official Testimonial Needed] — Insert a verified statement from an institutional, NGO, or academic partner regarding collaboration on clean energy advocacy and research.',
                        'name' => '[Institutional Partner Name]',
                        'role' => 'Renewable Energy Partner (Placeholder)',
                        'badge' => 'Awaiting Official Quote',
                    ],
                    [
                        'quote' => '[Official Testimonial Needed] — Insert a verified reflection from a youth volunteer or clean energy advocate participating in Ecowattage outreach programmes.',
                        'name' => '[Volunteer / Advocate Name]',
                        'role' => 'Clean Energy Volunteer (Placeholder)',
                        'badge' => 'Awaiting Official Quote',
                    ],
                ],
            ],

            // Section 9: Leadership & Advocates Team (Ecozone Team Layout 1)
            'team' => [
                'subtitle' => 'Our Team & Leadership',
                'title' => "Meet Our Dedicated Renewable Energy\nAdvocates and Specialists",
                'disclaimer' => 'Staff Profiles Pending: Please supply official names, titles, biographies, and portraits for Ecowattage leadership and team members.',
                'members' => [
                    [
                        'name' => '[CEO / Founder Name Needed]',
                        'designation' => 'CHIEF EXECUTIVE OFFICER & FOUNDER',
                        'bio' => 'Leading Ecowattage’s strategic vision for renewable energy advocacy, institutional partnerships, and future African clean-tech manufacturing.',
                        'initials' => 'CEO',
                    ],
                    [
                        'name' => '[Advocacy Lead Name Needed]',
                        'designation' => 'HEAD OF ADVOCACY & CAMPAIGNS',
                        'bio' => 'Directing public awareness campaigns, policy engagement, and community mobilization across Sierra Leone and regional partner networks.',
                        'initials' => 'HA',
                    ],
                    [
                        'name' => '[Technical Lead Name Needed]',
                        'designation' => 'DIRECTOR OF INNOVATION & ENGINEERING',
                        'bio' => 'Overseeing renewable energy technical advisory, solar/storage system design, and future product manufacturing R&D.',
                        'initials' => 'IE',
                    ],
                    [
                        'name' => '[Education Lead Name Needed]',
                        'designation' => 'PUBLIC EDUCATION & RESEARCH OFFICER',
                        'bio' => 'Developing renewable energy training curricula, public literacy publications, and youth workshops.',
                        'initials' => 'ER',
                    ],
                ],
            ],

            // Section 10: Full-Width CTA Banner (Ecozone CTA Layout 1)
            'cta_banner' => [
                'eyebrow' => 'Join the Clean Energy Movement',
                'title' => "Enter the Realm of Sustainable Power — Together, We Can Power Africa's Green Future",
                'description' => 'Whether you are an educator, engineer, donor, policymaker, or passionate citizen, your voice and partnership can help accelerate clean energy access across Africa.',
                'primary_btn' => ['label' => 'Become a Volunteer', 'route' => 'partners-careers'],
                'secondary_btn' => ['label' => 'Partner With Ecowattage', 'route' => 'contact'],
                'background_image' => '/images/illustrative/hero-solar-microgrid.jpg',
            ],

            // Section 11: Latest News & Blog Updates (Ecozone Blog Layout 1)
            'blogs' => [
                'subtitle' => 'Blog & News Updates',
                'title' => 'Our Latest Renewable Energy Insights & Articles',
                'disclaimer' => 'Sample Editorial Articles — Ready to be managed dynamically through the Stage 2 Blog CMS.',
                'items' => [
                    [
                        'category' => 'Clean Energy Advocacy',
                        'date' => 'Editorial Preview',
                        'read_time' => '5 min read',
                        'author' => 'Ecowattage Editorial Team',
                        'title' => 'Why Public Energy Literacy Is the Missing Link in Africa’s Solar Transition',
                        'excerpt' => 'Explore how community-level understanding of solar photovoltaics, battery stewardship, and energy efficiency accelerates long-term project sustainability.',
                        'image' => '/images/illustrative/hero-energy-education.jpg',
                        'slug' => 'public-energy-literacy-africa-solar-transition',
                    ],
                    [
                        'category' => 'Energy Efficiency & Innovation',
                        'date' => 'Editorial Preview',
                        'read_time' => '4 min read',
                        'author' => 'Ecowattage Technical Desk',
                        'title' => 'How High-Efficiency LED Lighting Reduces Grid Peak Demand and Household Costs',
                        'excerpt' => 'Transitioning from legacy lighting to modern, durable LED technology frees up critical generation capacity while lowering monthly energy bills for families.',
                        'image' => '/images/illustrative/campaign-innovation-lab.jpg',
                        'slug' => 'high-efficiency-led-lighting-grid-demand',
                    ],
                    [
                        'category' => 'Community Electrification',
                        'date' => 'Editorial Preview',
                        'read_time' => '6 min read',
                        'author' => 'Ecowattage Research Team',
                        'title' => 'Powering Essential Healthcare: The Case for Resilient Solar Microgrids in Rural Clinics',
                        'excerpt' => 'Reliable electricity for vaccine refrigeration, night-time maternity care, and diagnostic equipment starts with well-maintained solar-plus-storage systems.',
                        'image' => '/images/illustrative/campaign-clinic-solar.jpg',
                        'slug' => 'resilient-solar-microgrids-rural-clinics',
                    ],
                ],
            ],
        ];
    }

    /**
     * Data specifically for the About Us (/about) page modeled on Ecozone /about + /team.
     *
     * @return array<string, mixed>
     */
    public static function aboutPageData(): array
    {
        return [
            // Section 1: Detailed Story / Mission (Ecozone About Layout 1)
            'overview' => [
                'subtitle' => 'Our Identity & Purpose',
                'title' => "Catalyzing Africa's Clean Energy Independence",
                'description_paragraphs' => [
                    'Ecowattage is a pioneering African renewable energy enterprise founded to dismantle the barriers hindering clean energy adoption across the continent. Operating primarily in West Africa, our focus spans high-impact public advocacy, grassroots and technical energy literacy, community electrification, and pioneering local manufacturing capabilities for renewable components.',
                    'We believe that energy poverty cannot be solved by simply importing equipment without building local agency, technical know-how, and domestic assembly lines. By bridging policy advocacy, academic outreach, and engineering innovation, Ecowattage is building an enduring ecosystem where clean power drives sustainable economic dignity.',
                ],
                'image' => '/images/illustrative/about-engineering-field.jpg',
                'image_caption' => 'Illustrative Photography — Ecowattage renewable energy engineers reviewing power schematics',
                'highlights' => [
                    [
                        'title' => 'Enduring Advocacy',
                        'desc' => 'Championing transparent renewable energy policies and supportive regulatory frameworks across Africa.',
                    ],
                    [
                        'title' => 'Grassroots Education',
                        'desc' => 'Equipping schools, local artisans, and community hubs with solar literacy and technical maintenance toolkits.',
                    ],
                    [
                        'title' => 'Indigenous Innovation',
                        'desc' => 'Fostering local assembly of LED lighting and robust solar hardware built specifically for tropical and off-grid conditions.',
                    ],
                ],
            ],

            // Section 2: Core Values & Pillars (Ecozone AditionalFeature Layout 7)
            'initiatives' => [
                'subtitle' => 'What We Do',
                'title' => 'Our Core Initiatives & Impact Pathways',
                'items' => [
                    [
                        'title' => 'Renewable Energy Advocacy',
                        'desc' => 'We lead nationwide and regional public campaigns to shift public perception and governmental priorities toward decentralized solar, micro-hydro, and wind resources.',
                        'tag' => 'Pillar I',
                    ],
                    [
                        'title' => 'Public Energy Education',
                        'desc' => 'Demystifying renewable energy technologies for youth, women-led agricultural cooperatives, and local businesses through immersive workshops and open-access publications.',
                        'tag' => 'Pillar II',
                    ],
                    [
                        'title' => 'Future Clean Manufacturing',
                        'desc' => 'Establishing the supply chain and engineering foundation for high-efficiency LED bulb production, assembly of durable solar charge kits, and battery management systems.',
                        'tag' => 'Pillar III',
                    ],
                    [
                        'title' => 'Community Electrification',
                        'desc' => 'Supporting rural clinics, schools, and off-grid settlements with reliable clean microgrid strategies designed for decades of resilient operation.',
                        'tag' => 'Pillar IV',
                    ],
                ],
            ],

            // Section 3: Vision, Mission & Philosophy Cards
            'vision_mission' => [
                'mission' => [
                    'title' => 'Our Mission',
                    'statement' => 'To accelerate the transition to sustainable energy across Africa through relentless public advocacy, transformative community education, and high-quality, locally assembled clean energy technologies.',
                ],
                'vision' => [
                    'title' => 'Our Vision',
                    'statement' => 'An electrified, carbon-resilient Africa where every household, clinic, and enterprise thrives on clean, reliable, and locally manufactured renewable energy.',
                ],
                'values' => [
                    'Scientific Integrity' => 'Every recommendation, campaign, and curriculum is rooted in verified engineering principles and empirical climate realities.',
                    'Community Inclusivity' => 'Energy solutions must empower local stakeholders, train youth technicians, and respect indigenous land realities.',
                    'Durable Innovation' => 'Refusing fragile imports in favor of repairable, robust clean energy products engineered for African environments.',
                ],
            ],

            // Section 4: Leadership Team (Ecozone Team Layout 1)
            'team' => [
                'subtitle' => 'Our Leadership & Advocates',
                'title' => 'The People Behind Ecowattage',
                'disclaimer' => 'Staff Profiles Pending: Please supply official biographies, designations, and portraits for Ecowattage leadership.',
                'members' => [
                    [
                        'name' => '[Founder / CEO Name Needed]',
                        'designation' => 'FOUNDER & CHIEF EXECUTIVE OFFICER',
                        'bio' => 'Drives the overarching strategic roadmap, institutional partnerships, and regional policy engagement for Ecowattage across Africa.',
                        'initials' => 'CEO',
                    ],
                    [
                        'name' => '[Head of Advocacy Needed]',
                        'designation' => 'HEAD OF ADVOCACY & POLICY',
                        'bio' => 'Coordinates grassroots energy campaigns, stakeholder summits, and regulatory advocacy to accelerate clean energy adoption.',
                        'initials' => 'HA',
                    ],
                    [
                        'name' => '[Director of Engineering Needed]',
                        'designation' => 'DIRECTOR OF INNOVATION & ENGINEERING',
                        'bio' => 'Directs technical field projects, clean technology benchmarking, and future LED/solar manufacturing R&D.',
                        'initials' => 'DE',
                    ],
                    [
                        'name' => '[Lead Education Specialist Needed]',
                        'designation' => 'HEAD OF EDUCATION & COMMUNITY OUTREACH',
                        'bio' => 'Designs educational modules, youth training curricula, and community solar literacy workshops across Sierra Leone.',
                        'initials' => 'ED',
                    ],
                ],
            ],

            // Section 5: Future Manufacturing Roadmap
            'manufacturing_roadmap' => [
                'subtitle' => 'Strategic Horizon',
                'title' => 'From Advocacy to Indigenous Clean-Tech Manufacturing',
                'description' => 'Our staged journey towards manufacturing renewable energy products directly in Africa.',
                'phases' => [
                    [
                        'phase' => 'Phase 1: Foundation',
                        'status' => 'Current Active Stage',
                        'desc' => 'High-intensity public advocacy, community education, nationwide stakeholder mobilization, and comprehensive energy feasibility studies.',
                    ],
                    [
                        'phase' => 'Phase 2: Product Showcase',
                        'status' => 'Upcoming Phase',
                        'desc' => 'Showcasing high-efficiency LED bulb prototypes, curated clean home kits, and establishing a verified local dealer and installer network.',
                    ],
                    [
                        'phase' => 'Phase 3: Assembly & Production',
                        'status' => 'Target Horizon',
                        'desc' => 'Opening clean-tech assembly facilities in Sierra Leone for commercial LED lighting, durable solar charge controllers, and battery modules.',
                    ],
                ],
            ],
        ];
    }

    /**
     * Data specifically for the Solutions & Services (/services) page modeled on Ecozone /service + /service-details.
     *
     * @return array<string, mixed>
     */
    public static function servicesPageData(): array
    {
        return [
            'header' => [
                'subtitle' => 'What We Deliver',
                'title' => 'Renewable Energy Solutions & Strategic Services',
                'description' => 'Ecowattage combines grassroots advocacy, structured community education, engineering advisory, and the preparation of domestic clean-tech manufacturing capabilities tailored for African power realities.',
            ],

            // 6 Comprehensive Service Offerings (Ecozone Service Layout 5)
            'services_list' => [
                [
                    'id' => 'advocacy-policy',
                    'number' => '01',
                    'title' => 'Renewable Energy Advocacy & Policy Engagement',
                    'category' => 'Advocacy & Public Voice',
                    'summary' => 'Championing transparent renewable energy policies, tariff equity, and regulatory frameworks that encourage distributed clean power adoption across Sierra Leone and Africa.',
                    'details' => [
                        'Public policy submissions and government agency dialogue.',
                        'Clean energy advocacy toolkits for local civil society and communities.',
                        'Stakeholder roundtables connecting donors, utility leaders, and developers.',
                    ],
                    'badge' => 'Active Core Pillar',
                    'image' => '/images/illustrative/hero-energy-education.jpg',
                    'image_caption' => 'Community advocacy and clean energy policy training in West Africa',
                ],
                [
                    'id' => 'public-education',
                    'number' => '02',
                    'title' => 'Public Energy Literacy & Community Workshops',
                    'category' => 'Education & Knowledge',
                    'summary' => 'Demystifying solar, micro-hydro, wind, and battery stewardship through hands-on community workshops, schools outreach, and open-access vernacular learning guides.',
                    'details' => [
                        'Hands-on solar demonstration kits for secondary schools and technical colleges.',
                        'Vernacular community training for local solar maintenance and battery care.',
                        'Workshops for small businesses on energy conservation and peak-demand management.',
                    ],
                    'badge' => 'Active Core Pillar',
                    'image' => '/images/illustrative/faq-community-workshop.jpg',
                    'image_caption' => 'Community renewable energy literacy workshop session',
                ],
                [
                    'id' => 'technical-advisory',
                    'number' => '03',
                    'title' => 'Renewable Energy Technical Advisory & System Design',
                    'category' => 'Engineering & Consulting',
                    'summary' => 'Providing independent feasibility studies, solar microgrid engineering designs, and technical audits for NGOs, clinics, schools, and commercial facilities.',
                    'details' => [
                        'Off-grid solar and battery storage sizing and system specification.',
                        'Site feasibility and energy yield assessments for rural health and educational institutions.',
                        'Energy audits for commercial facilities aiming to reduce reliance on diesel generators.',
                    ],
                    'badge' => 'Consulting & Advisory',
                    'image' => '/images/illustrative/about-engineering-field.jpg',
                    'image_caption' => 'Engineers inspecting solar inverters and battery storage facilities',
                ],
                [
                    'id' => 'clean-manufacturing',
                    'number' => '04',
                    'title' => 'Future Clean-Tech Manufacturing & Component Assembly',
                    'category' => 'Manufacturing Roadmap',
                    'summary' => 'Establishing domestic assembly lines in Sierra Leone for high-efficiency LED bulbs, resilient solar charge controllers, and modular renewable energy kits.',
                    'details' => [
                        'Testing and benchmarking LED lighting chips for high-heat and variable voltage grids.',
                        'Developing modular, repairable solar home kit assemblies built for African households.',
                        'Building technical partnerships with global equipment suppliers for technology transfer.',
                    ],
                    'badge' => 'Strategic Horizon',
                    'image' => '/images/illustrative/campaign-innovation-lab.jpg',
                    'image_caption' => 'Clean-tech electrical testing laboratory for LED and battery components',
                ],
                [
                    'id' => 'community-microgrids',
                    'number' => '05',
                    'title' => 'Community Microgrid & Essential Services Support',
                    'category' => 'Electrification Support',
                    'summary' => 'Supporting rural clinics, maternity wards, and water-pumping projects with solar-plus-storage designs engineered for round-the-clock reliability.',
                    'details' => [
                        'Solar power architectures for 24/7 vaccine cold chains and maternity lighting.',
                        'Solar-powered borehole and community clean water pumping solutions.',
                        'Local technician training ensuring long-term community ownership and upkeep.',
                    ],
                    'badge' => 'Community Focus',
                    'image' => '/images/illustrative/campaign-clinic-solar.jpg',
                    'image_caption' => 'Solar-powered community health centre in rural West Africa',
                ],
                [
                    'id' => 'research-publications',
                    'number' => '06',
                    'title' => 'Research, Policy Briefs & Knowledge Publications',
                    'category' => 'Research & Data',
                    'summary' => 'Authoring empirical white papers, market intelligence briefs, and public data summaries on African renewable energy opportunities and challenges.',
                    'details' => [
                        'Annual clean energy transition and rural electrification state-of-the-art reports.',
                        'Comparative cost-benefit studies: decentralized solar vs. fossil-fuel generators.',
                        'Policy recommendations for reducing import tariffs on renewable energy hardware.',
                    ],
                    'badge' => 'Knowledge Centre',
                    'image' => '/images/illustrative/hero-solar-microgrid.jpg',
                    'image_caption' => 'Field survey of solar photovoltaic infrastructure and microgrid telemetry',
                ],
            ],

            // 4-Step Process Section
            'process' => [
                'subtitle' => 'Our Methodology',
                'title' => 'How We Turn Clean Energy Awareness Into Enduring Impact',
                'steps' => [
                    [
                        'step' => '01',
                        'title' => 'Assessment & Dialogue',
                        'desc' => 'Engaging community members, local leadership, and institutional partners to understand real energy deficits and local context.',
                    ],
                    [
                        'step' => '02',
                        'title' => 'Education & Advocacy',
                        'desc' => 'Delivering tailored workshops, policy briefs, and open-access toolkits to foster informed local decision-making.',
                    ],
                    [
                        'step' => '03',
                        'title' => 'Engineering & Advisory',
                        'desc' => 'Designing robust, durable clean energy solutions specified to withstand tropical heat, dust, and off-grid demands.',
                    ],
                    [
                        'step' => '04',
                        'title' => 'Sustainable Stewardship',
                        'desc' => 'Training local technicians, establishing maintenance protocols, and paving the way for domestic component manufacturing.',
                    ],
                ],
            ],

            // FAQ for Services
            'faq' => [
                'subtitle' => 'Service Inquiries',
                'title' => 'Frequently Asked Questions on Our Solutions',
                'items' => [
                    [
                        'q' => 'Can Ecowattage provide advisory for our school or community health centre?',
                        'a' => 'Yes. We frequently collaborate with community representatives, educational institutions, and healthcare providers to assess energy needs, design off-grid solar-plus-storage solutions, and provide technical guidance.',
                    ],
                    [
                        'q' => 'When will Ecowattage LED bulbs and manufactured products be available?',
                        'a' => 'We are currently in Phase 1 of our roadmap—conducting component testing and establishing our assembly facility foundation. We will announce product showcase prototypes in Phase 2.',
                    ],
                    [
                        'q' => 'How do you ensure projects do not fail after installation?',
                        'a' => 'Sustainability requires local ownership. Every advisory and electrification initiative includes hands-on technical training for local caretakers, documented preventative maintenance guides, and high-durability component specifications.',
                    ],
                    [
                        'q' => 'How can our organisation partner with Ecowattage on advocacy campaigns?',
                        'a' => 'We welcome collaborations with national and international NGOs, donor organisations, and industry associations. Contact us via our partnership form or email to initiate a discussion.',
                    ],
                ],
            ],
        ];
    }

    /**
     * Data specifically for the Advocacy Campaigns (/campaigns) page modeled on Ecozone /campaigns.
     *
     * @return array<string, mixed>
     */
    public static function campaignsPageData(): array
    {
        return [
            'header' => [
                'subtitle' => 'Grassroots Mobilization & Policy Action',
                'title' => 'Advocacy Campaigns For Africa’s Clean Energy Future',
                'description' => 'Ecowattage designs and coordinates participatory campaigns that empower communities, advocate for fair energy policies, and accelerate renewable transitions across Sierra Leone and the continent.',
            ],

            // 6 Structured Campaigns (Ecozone Campaign Layout with Milestones)
            'campaigns_list' => [
                [
                    'id' => 'clean-energy-schools',
                    'title' => 'Clean Energy Awareness for Schools & Youth Across Sierra Leone',
                    'category' => 'Youth & Education',
                    'summary' => 'Equipping primary and secondary schools with hands-on renewable energy science kits, interactive solar demos, and climate literacy textbooks.',
                    'image' => '/images/illustrative/hero-energy-education.jpg',
                    'image_caption' => 'Students and teachers engaging with solar technology kits',
                    'milestone_label' => 'Curriculum Outreach',
                    'progress_percent' => 75,
                    'status' => 'Active Initiative',
                    'target_note' => '[Target: 50 Schools Across Sierra Leone — Supply Official Target via CMS]',
                    'achievements' => [
                        'Structured solar demonstration curricula tested in 12 community schools.',
                        'Engaged over 1,200 youth and educators in foundational energy literacy.',
                    ],
                    'cta_label' => 'Support This Campaign',
                ],
                [
                    'id' => 'solar-health-clinics',
                    'title' => 'Solar Power Advocacy for Rural Health & Maternity Centres',
                    'category' => 'Healthcare Electrification',
                    'summary' => 'Mobilizing healthcare administrators, local leaders, and institutional partners to replace polluting diesel generators with resilient solar-plus-storage.',
                    'image' => '/images/illustrative/campaign-clinic-solar.jpg',
                    'image_caption' => 'Off-grid solar healthcare facility in West Africa',
                    'milestone_label' => 'Healthcare Outreach',
                    'progress_percent' => 60,
                    'status' => 'Active Initiative',
                    'target_note' => '[Target: 20 Rural Maternity Centres — Supply Official Scope via CMS]',
                    'achievements' => [
                        'Conducted energy feasibility audits for off-grid district maternity clinics.',
                        'Advocacy brief presented to regional health boards on solar cold-chain reliability.',
                    ],
                    'cta_label' => 'Partner on This Initiative',
                ],
                [
                    'id' => 'efficient-lighting-sme',
                    'title' => 'High-Efficiency LED Lighting Transition for Households & SMEs',
                    'category' => 'Energy Efficiency',
                    'summary' => 'Educating households, market traders, and small businesses on reducing electricity tariffs and peak grid strain by upgrading to durable LED technology.',
                    'image' => '/images/illustrative/campaign-innovation-lab.jpg',
                    'image_caption' => 'Technician testing efficiency and heat tolerance of LED lighting units',
                    'milestone_label' => 'Market Adoption',
                    'progress_percent' => 50,
                    'status' => 'Active Initiative',
                    'target_note' => '[Target: 10,000 Household LED Conversions — Supply Official Metric via CMS]',
                    'achievements' => [
                        'Published educational guide on identifying durable LEDs vs. counterfeit products.',
                        'Organized market vendor workshops demonstrating 70% lighting electricity savings.',
                    ],
                    'cta_label' => 'Join the Transition',
                ],
                [
                    'id' => 'clean-water-solar-pumping',
                    'title' => 'Solar-Powered Clean Water & Agriculture for Rural Communities',
                    'category' => 'Agricultural Resilience',
                    'summary' => 'Championing solar groundwater pumping solutions for agricultural cooperatives and remote villages facing seasonal droughts.',
                    'image' => '/images/illustrative/hero-solar-microgrid.jpg',
                    'image_caption' => 'Solar borehole array providing irrigation and clean drinking water',
                    'milestone_label' => 'Community Water Security',
                    'progress_percent' => 40,
                    'status' => 'Field Development',
                    'target_note' => '[Target: 15 Agricultural Cooperatives — Supply Official Scope via CMS]',
                    'achievements' => [
                        'Mapped high-potential solar irrigation zones across agricultural districts.',
                        'Held stakeholder seminars with women farmers on micro-solar pump maintenance.',
                    ],
                    'cta_label' => 'Co-Sponsor Clean Water',
                ],
                [
                    'id' => 'renewable-tariff-policy',
                    'title' => 'Fair Tariffs & Import Duty Relief for Renewable Energy Hardware',
                    'category' => 'Policy & Governance',
                    'summary' => 'Engaging parliamentary committees, energy ministries, and trade authorities to eliminate punitive tariffs on solar panels, inverters, and battery storage.',
                    'image' => '/images/illustrative/about-engineering-field.jpg',
                    'image_caption' => 'Clean energy policy advisors reviewing regulatory submissions',
                    'milestone_label' => 'Policy Dialogues',
                    'progress_percent' => 65,
                    'status' => 'Ongoing Advocacy',
                    'target_note' => '[Target: National Policy White Paper Submission — Supply Official Status via CMS]',
                    'achievements' => [
                        'Authored policy brief on economic impact of renewable equipment import taxes.',
                        'Participated in West Africa clean energy regulatory harmonisation panels.',
                    ],
                    'cta_label' => 'Support Policy Engagement',
                ],
                [
                    'id' => 'youth-solar-technicians',
                    'title' => 'Next-Gen African Solar Technician & Installer Apprenticeship',
                    'category' => 'Vocational Skills',
                    'summary' => 'Advocating for nationwide vocational solar installation standards and providing practical training so young African technicians lead maintenance.',
                    'image' => '/images/illustrative/faq-community-workshop.jpg',
                    'image_caption' => 'Practical solar technician hands-on training workshop',
                    'milestone_label' => 'Vocational Training',
                    'progress_percent' => 55,
                    'status' => 'Apprenticeship Cohort',
                    'target_note' => '[Target: 200 Certified Young Technicians — Supply Official Metric via CMS]',
                    'achievements' => [
                        'Graduated first cohort of community youth technicians with toolkits.',
                        'Established apprenticeship pathway with local solar engineering contractors.',
                    ],
                    'cta_label' => 'Sponsor a Technician',
                ],
            ],

            // Campaign Impact Metrics
            'impact_summary' => [
                'subtitle' => 'Measurable Progress',
                'title' => 'Advocacy Driven By Real Community Transformation',
                'description' => 'Our campaigns are not theoretical—they translate into documented community awareness, policy engagement, and practical field pilots.',
            ],

            // How to Take Action Section
            'action_options' => [
                'subtitle' => 'How You Can Participate',
                'title' => 'Three Ways to Power Our Advocacy Campaigns',
                'items' => [
                    [
                        'number' => '01',
                        'title' => 'Institutional Co-Sponsorship',
                        'desc' => 'Partner with Ecowattage on high-impact public awareness, rural healthcare solarization, and clean-tech vocational initiatives.',
                        'cta' => 'Become a Partner',
                        'route' => 'contact',
                    ],
                    [
                        'number' => '02',
                        'title' => 'Volunteer & Community Organizing',
                        'desc' => 'Join our active roster of grassroots volunteers, educators, and field advocates hosting local energy literacy workshops.',
                        'cta' => 'Volunteer With Us',
                        'route' => 'partners-careers',
                    ],
                    [
                        'number' => '03',
                        'title' => 'Amplify & Share Research',
                        'desc' => 'Share our policy briefs, educational graphics, and campaign stories across your networks to accelerate clean energy literacy.',
                        'cta' => 'Explore Publications',
                        'route' => 'blog',
                    ],
                ],
            ],
        ];
    }

    /**
     * Data specifically for the Projects Showcase (/projects) page modeled on Ecozone Projects Layout 1 + ProjectDetails Layout 1.
     *
     * @return array<string, mixed>
     */
    public static function projectsPageData(): array
    {
        return [
            'header' => [
                'subtitle' => 'Our Projects & Blueprints',
                'title' => 'Pioneering Renewable Energy Solutions Across Africa',
                'description' => 'Explore Ecowattage’s structured project portfolio and technical blueprints spanning community solar microgrids, rural health electrification, micro-hydro feasibility, and future local clean-tech assembly.',
                'disclaimer' => 'Illustrative Project Showcase: Because no official Ecowattage completed project logs have been supplied yet, the cards below demonstrate the CMS-ready project blueprint structure using illustrative documentary photography. Replace or publish verified project records in Stage 2.',
            ],

            'categories' => ['All', 'Solar Microgrid', 'Health & Education', 'Micro-Hydro & Wind', 'Clean-Tech R&D'],

            // Featured Blueprint Spotlight (Modeled on Ecozone ProjectDetails Layout 1)
            'featured_blueprint' => [
                'badge' => 'Featured Initiative Blueprint',
                'title' => 'Community Clean Energy & Rural Clinic Resilience Blueprint',
                'subtitle' => 'Objectives & Technical Scope',
                'description' => 'Designed to demonstrate how decentralized solar-plus-storage and high-efficiency LED lighting can eliminate diesel dependence for essential rural health clinics and adjacent community hubs across Sierra Leone.',
                'image' => '/images/illustrative/campaign-clinic-solar.jpg',
                'image_caption' => 'Illustrative Documentary Photo — Solar-equipped rural health clinic in West Africa',
                'location_placeholder' => '[District / Community Name to Be Supplied]',
                'capacity_placeholder' => '[Planned kWp / kWh Storage Spec Needed]',
                'status' => 'Blueprint & Partner Readiness',
                'scope_pillars' => [
                    [
                        'title' => 'Solar PV & Lithium Storage Integration',
                        'subtitle' => 'Reliable 24/7 clean power engineered for vaccine cold chains, maternity lighting, and basic diagnostics.',
                    ],
                    [
                        'title' => 'Energy-Efficient LED Retrofitting',
                        'subtitle' => 'Replacing high-draw legacy bulbs with durable, surge-tolerant LED luminaires suited for local voltage profiles.',
                    ],
                    [
                        'title' => 'Local Caretaker Training & Literacy',
                        'subtitle' => 'Hands-on maintenance instruction for community technicians so systems remain operational long-term.',
                    ],
                    [
                        'title' => 'Transparent Monitoring Readiness',
                        'subtitle' => 'Structured for future telemetry integration and periodic performance audits by institutional partners.',
                    ],
                ],
            ],

            // Filterable Project Showcase Grid (Modeled on Ecozone Projects Layout 1)
            'projects_list' => [
                [
                    'id' => 'rural-clinic-solar',
                    'title' => 'Rural Health Clinic Solarization Blueprint',
                    'category' => 'Health & Education',
                    'status' => 'Proposed Pilot',
                    'location' => '[Target District: Supply via CMS]',
                    'capacity' => '[Capacity Spec Pending]',
                    'image' => '/images/illustrative/campaign-clinic-solar.jpg',
                    'summary' => 'Delivering clean, uninterrupted solar electricity for rural primary healthcare centres, maternity wards, and cold-chain refrigeration.',
                    'objectives' => [
                        'Eliminate costly diesel backup fuel reliance at off-grid clinics.',
                        'Support safe night-time maternal deliveries and medical lighting.',
                        'Train local facility maintenance staff on basic solar battery care.',
                    ],
                ],
                [
                    'id' => 'community-solar-microgrid',
                    'title' => 'Peri-Urban Community Solar Microgrid Concept',
                    'category' => 'Solar Microgrid',
                    'status' => 'Feasibility Stage',
                    'location' => '[Target Community: Supply via CMS]',
                    'capacity' => '[kWp Array Spec Pending]',
                    'image' => '/images/illustrative/hero-solar-microgrid.jpg',
                    'summary' => 'Modular ground-mounted solar photovoltaic generation designed to power agro-processing cooperatives, cold storage, and small workshops.',
                    'objectives' => [
                        'Enable daytime productive use of energy for local agricultural processing.',
                        'Provide technical training for youth solar apprentices on site.',
                        'Establish transparent community energy governance guidelines.',
                    ],
                ],
                [
                    'id' => 'river-valley-micro-hydro',
                    'title' => 'Run-of-River Micro-Hydro & Watershed Assessment',
                    'category' => 'Micro-Hydro & Wind',
                    'status' => 'Resource Mapping',
                    'location' => '[River Basin Site: Supply via CMS]',
                    'capacity' => '[Hydro Potential Pending]',
                    'image' => '/images/illustrative/project-micro-hydro.jpg',
                    'summary' => 'Evaluating low-impact run-of-river micro-hydro potential in high-rainfall hill regions alongside community watershed protection.',
                    'objectives' => [
                        'Assess seasonal river flow profiles for small community turbines.',
                        'Pair clean hydro generation with local tree conservation advocacy.',
                        'Document technical feasibility for donor and ministry review.',
                    ],
                ],
                [
                    'id' => 'coastal-wind-solar-hybrid',
                    'title' => 'Coastal Hybrid Wind & Solar Resource Study',
                    'category' => 'Micro-Hydro & Wind',
                    'status' => 'Research Phase',
                    'location' => '[Coastal Corridor: Supply via CMS]',
                    'capacity' => '[Hybrid Yield Data Pending]',
                    'image' => '/images/illustrative/project-wind-solar-hybrid.jpg',
                    'summary' => 'Collecting wind-speed and solar irradiance benchmarks along coastal West African corridors to inform resilient hybrid energy planning.',
                    'objectives' => [
                        'Correlate coastal wind patterns with dry/rainy season solar yields.',
                        'Publish open-access empirical findings in our Knowledge Centre.',
                        'Identify suitable sites for future small-scale hybrid pilots.',
                    ],
                ],
                [
                    'id' => 'led-assembly-benchmark-lab',
                    'title' => 'High-Efficiency LED & Battery Testing Initiative',
                    'category' => 'Clean-Tech R&D',
                    'status' => 'R&D / Phase 1',
                    'location' => 'Freetown Innovation Desk [Confirm Address]',
                    'capacity' => 'Product Quality R&D',
                    'image' => '/images/illustrative/campaign-innovation-lab.jpg',
                    'summary' => 'Pre-manufacturing research testing LED drivers, thermal durability, and LiFePO4 battery packs ahead of Ecowattage local assembly.',
                    'objectives' => [
                        'Benchmark energy-efficient LED prototypes under tropical voltage conditions.',
                        'Develop repairable modular solar lantern and home kit schematics.',
                        'Prepare quality-assurance standards for future domestic production.',
                    ],
                ],
                [
                    'id' => 'school-solar-literacy-kits',
                    'title' => 'School Clean Energy Literacy & Demo Installations',
                    'category' => 'Health & Education',
                    'status' => 'Education Outreach',
                    'location' => '[Partner Schools: Supply via CMS]',
                    'capacity' => 'Educational Demo Kits',
                    'image' => '/images/illustrative/hero-energy-education.jpg',
                    'summary' => 'Installing compact teaching solar kits and hosting hands-on practical energy workshops for secondary school science students.',
                    'objectives' => [
                        'Give students direct hands-on exposure to PV panels, charge controllers, and multimeters.',
                        'Inspire the next generation of African clean-tech engineers and advocates.',
                        'Provide teachers with structured renewable energy lesson guides.',
                    ],
                ],
            ],
        ];
    }

    /**
     * Data specifically for the Blog & News (/blog) page modeled on Ecozone Blogs/Index.
     *
     * @return array<string, mixed>
     */
    public static function blogPageData(): array
    {
        return [
            'header' => [
                'subtitle' => 'Blog & Industry Insights',
                'title' => 'Clean Energy Journalism, Policy Notes & Field Perspectives',
                'description' => 'Read Ecowattage editorial briefs, community energy discussions, and practical renewable technology explainers built to strengthen public energy literacy across Africa.',
                'disclaimer' => 'Editorial Preview Notice: The articles below serve as structured CMS-ready editorial templates. Official dated press releases, named author bylines, and live comment workflows will be published through the Stage 2 Blog & News CMS.',
            ],

            'categories' => [
                'All',
                'Clean Energy Advocacy',
                'Energy Efficiency & Innovation',
                'Community Electrification',
                'Policy & Governance',
                'Technical Guides',
            ],

            'tags' => [
                'Solar PV',
                'Energy Literacy',
                'LED Transition',
                'Rural Clinics',
                'Micro-Hydro',
                'Battery Storage',
                'West Africa Policy',
                'Local Assembly',
            ],

            'articles' => [
                [
                    'slug' => 'public-energy-literacy-africa-solar-transition',
                    'featured' => true,
                    'category' => 'Clean Energy Advocacy',
                    'date' => 'Editorial Preview',
                    'read_time' => '5 min read',
                    'author' => 'Ecowattage Editorial Team',
                    'title' => 'Why Public Energy Literacy Is the Missing Link in Africa’s Solar Transition',
                    'excerpt' => 'Explore how community-level understanding of solar photovoltaics, battery stewardship, and energy efficiency accelerates long-term project sustainability.',
                    'image' => '/images/illustrative/blog-energy-forum.jpg',
                    'tags' => ['Energy Literacy', 'Solar PV', 'West Africa Policy'],
                    'body' => [
                        'Across West Africa and the wider continent, hardware costs for solar panels and lithium iron phosphate (LiFePO4) batteries have fallen dramatically over the past decade. Yet equipment affordability alone does not guarantee durable clean energy access. Without practical community understanding of load management, battery depth-of-discharge limits, and basic preventive cleaning, even well-funded installations risk premature failure.',
                        'At Ecowattage, we treat public energy education as essential infrastructure—just as critical as inverters and solar arrays. When household users, clinic staff, and student cohorts understand how kilowatt-hours, surge loads, and shading affect system longevity, clean energy shifts from a temporary donor intervention into a trusted community utility.',
                        'Integrating hands-on energy literacy workshops alongside every advocacy dialogue empowers local technicians to troubleshoot minor faults rapidly and inspires young engineers to pursue clean-tech careers within their own districts.',
                    ],
                    'key_takeaways' => [
                        'Hardware deployment must be paired with accessible user and caretaker training.',
                        'Understanding load prioritization extends solar battery lifespan significantly.',
                        'School and youth workshops cultivate domestic clean-tech maintenance capacity.',
                    ],
                ],
                [
                    'slug' => 'high-efficiency-led-lighting-grid-demand',
                    'featured' => false,
                    'category' => 'Energy Efficiency & Innovation',
                    'date' => 'Editorial Preview',
                    'read_time' => '4 min read',
                    'author' => 'Ecowattage Technical Desk',
                    'title' => 'How High-Efficiency LED Lighting Reduces Grid Peak Demand and Household Costs',
                    'excerpt' => 'Transitioning from legacy lighting to modern, durable LED technology frees up critical generation capacity while lowering monthly energy bills for families.',
                    'image' => '/images/illustrative/campaign-innovation-lab.jpg',
                    'tags' => ['LED Transition', 'Local Assembly', 'Energy Literacy'],
                    'body' => [
                        'Before expanding generation capacity, the fastest and most cost-effective clean energy gain often comes from reducing wasted watts. Legacy incandescent and low-grade fluorescent fixtures convert a substantial share of electricity into unwanted heat while struggling with voltage fluctuations common on fragile feeders.',
                        'Modern, surge-protected LED luminaires deliver equivalent or superior illumination at a fraction of the wattage. Across hundreds of households or municipal buildings, coordinated LED retrofitting trims evening peak demand and stretches the autonomous runtime of off-grid solar-battery systems.',
                        'Through Ecowattage’s Clean-Tech R&D focus, we advocate for ruggedized, repair-friendly LED standards tailored specifically for tropical heat, humidity, and African voltage realities—laying groundwork for future domestic assembly.',
                    ],
                    'key_takeaways' => [
                        'Efficiency is the lowest-cost first step before scaling solar generation.',
                        'Surge tolerance is essential for fixture longevity in developing grids.',
                        'Lower household wattage translates directly into longer solar backup hours.',
                    ],
                ],
                [
                    'slug' => 'resilient-solar-microgrids-rural-clinics',
                    'featured' => false,
                    'category' => 'Community Electrification',
                    'date' => 'Editorial Preview',
                    'read_time' => '6 min read',
                    'author' => 'Ecowattage Research Team',
                    'title' => 'Powering Essential Healthcare: The Case for Resilient Solar Microgrids in Rural Clinics',
                    'excerpt' => 'Reliable electricity for vaccine refrigeration, night-time maternity care, and diagnostic equipment starts with well-maintained solar-plus-storage systems.',
                    'image' => '/images/illustrative/campaign-clinic-solar.jpg',
                    'tags' => ['Rural Clinics', 'Solar PV', 'Battery Storage'],
                    'body' => [
                        'Primary healthcare clinics in rural Sierra Leone and neighboring West African communities frequently face an impossible choice: spend scarce operating budgets on diesel generator fuel, or risk losing power during critical night-time deliveries and vaccine cold-chain storage.',
                        'Dedicated healthcare solar microgrids eliminate noisy exhaust, volatile fuel supply chains, and recurring fuel expenses. Properly sized systems prioritize critical medical circuits—ensuring maternal wards, laboratory microscopes, and cold-chain refrigerators remain continuously energized.',
                        'Equally important is clear maintenance governance: pairing system commissioning with on-site clinic caretaker orientation and transparent diagnostic logs ensures health workers can focus on saving lives rather than troubleshooting power outages.',
                    ],
                    'key_takeaways' => [
                        'Prioritized medical circuits protect cold chains and maternity lighting.',
                        'Replacing diesel reduces ongoing clinic operating costs and emissions.',
                        'Clear operational checklists keep rural systems dependable year-round.',
                    ],
                ],
                [
                    'slug' => 'fair-clean-tech-tariffs-west-africa-policy',
                    'featured' => false,
                    'category' => 'Policy & Governance',
                    'date' => 'Editorial Preview',
                    'read_time' => '5 min read',
                    'author' => 'Ecowattage Policy Desk',
                    'title' => 'Unlocking Clean Energy Adoption Through Predictable Import Duties & Quality Standards',
                    'excerpt' => 'How transparent customs classifications and minimum quality benchmarks can accelerate trustworthy solar access while protecting consumers from substandard hardware.',
                    'image' => '/images/illustrative/hero-solar-microgrid.jpg',
                    'tags' => ['West Africa Policy', 'Solar PV', 'Local Assembly'],
                    'body' => [
                        'Policy certainty plays a decisive role in whether clean energy remains a luxury item or becomes an everyday household utility. Ambiguous tariff classifications on inverters, deep-cycle batteries, and balance-of-system components frequently delay shipments and inflate retail prices for rural communities.',
                        'At the same time, tariff relief must go hand in hand with enforceable technical standards. Flooded markets with counterfeit solar panels or undersized batteries erode public trust in renewable technology.',
                        'Ecowattage champions balanced policy frameworks that reward verified quality components, support domestic clean-tech assembly startups, and streamline grid-tie or mini-grid licensing pathways.',
                    ],
                    'key_takeaways' => [
                        'Clear customs schedules reduce clean-tech bottlenecks and end-user prices.',
                        'Component quality benchmarks protect consumer confidence in solar systems.',
                        'Incentives for local assembly build long-term domestic engineering jobs.',
                    ],
                ],
                [
                    'slug' => 'run-of-river-micro-hydro-seasonal-planning',
                    'featured' => false,
                    'category' => 'Technical Guides',
                    'date' => 'Editorial Preview',
                    'read_time' => '6 min read',
                    'author' => 'Ecowattage Engineering Desk',
                    'title' => 'Assessing Run-of-River Micro-Hydro & Hybrid Renewables for Tropical River Valleys',
                    'excerpt' => 'Balancing wet-season hydro potential with dry-season solar generation creates resilient community power corridors in hilly West African watersheds.',
                    'image' => '/images/illustrative/project-micro-hydro.jpg',
                    'tags' => ['Micro-Hydro', 'Battery Storage', 'Rural Clinics'],
                    'body' => [
                        'Sierra Leone’s topography and seasonal rainfall create compelling opportunities for small-scale, low-impact run-of-river micro-hydro schemes—especially when evaluated alongside community watershed preservation.',
                        'Because tropical river flows vary sharply between wet and dry seasons, hybrid planning is vital. Combining seasonal hydro turbines with solar PV arrays and modular storage helps smooth annual generation profiles without requiring massive ecological disruption.',
                        'Early-stage feasibility assessments focus on hydrological measurement, intake sediment protection, and community stewardship of upstream forest cover to safeguard water flow over decades.',
                    ],
                    'key_takeaways' => [
                        'Watershed conservation directly sustains dry-season hydro reliability.',
                        'Hybridizing micro-hydro with solar PV stabilizes year-round community loads.',
                        'Pre-feasibility flow logging prevents costly turbine oversizing.',
                    ],
                ],
                [
                    'slug' => 'coastal-wind-solar-hybrid-resilience-brief',
                    'featured' => false,
                    'category' => 'Technical Guides',
                    'date' => 'Editorial Preview',
                    'read_time' => '4 min read',
                    'author' => 'Ecowattage Research Team',
                    'title' => 'Complementary Power: Why Coastal Corridors Benefit From Wind & Solar Resource Mapping',
                    'excerpt' => 'Understanding diurnal wind regimes alongside daytime solar irradiance helps planners reduce battery bank sizing for coastal workshops and schools.',
                    'image' => '/images/illustrative/project-wind-solar-hybrid.jpg',
                    'tags' => ['Solar PV', 'Battery Storage', 'West Africa Policy'],
                    'body' => [
                        'While solar irradiance peaks reliably around midday, coastal sea breezes often strengthen in late afternoon and evening—precisely when community lighting, cold-storage compressors, and residential loads begin to climb.',
                        'Empirical anemometer and pyranometer measurements along coastal West African corridors help engineers verify where compact wind-solar hybrid systems make technical and economic sense compared to oversized battery banks alone.',
                        'Ecowattage’s research agenda prioritizes open, transparent resource baselines so universities, local councils, and development partners can design grounded energy projects.',
                    ],
                    'key_takeaways' => [
                        'Afternoon coastal winds can offset early-evening battery discharge.',
                        'Site-specific resource data avoids assumptions imported from other climates.',
                        'Salt-mist corrosion protection is essential for coastal clean-tech hardware.',
                    ],
                ],
            ],
        ];
    }
}

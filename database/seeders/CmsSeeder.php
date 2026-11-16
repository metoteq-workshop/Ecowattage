<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\CmsPage;
use App\Models\CmsPost;
use App\Models\MediaItem;
use App\Models\User;
use App\Support\StageOneData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CmsSeeder extends Seeder
{
    /**
     * Seed the Stage 2 CMS pages, users, modular content, and media library.
     */
    public function run(): void
    {
        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@ecowattage.com'],
            [
                'name' => 'Ecowattage Super Admin',
                'password' => Hash::make('Ecowattage2026!'),
                'role' => UserRole::SuperAdmin->value,
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        $pages = [
            [
                'title' => 'Home',
                'slug' => 'home',
                'route_name' => 'home',
                'nav_group' => 'root',
                'nav_label' => 'Home',
                'nav_order' => 1,
                'summary' => "Powering Africa's Green Future through renewable energy advocacy, public education, and clean-tech innovation.",
                'meta_title' => "Ecowattage — Powering Africa's Green Future",
                'meta_description' => 'Ecowattage advances renewable energy advocacy, public energy literacy, community electrification, and clean-tech innovation across Sierra Leone and Africa.',
            ],
            [
                'title' => 'About Us',
                'slug' => 'about',
                'route_name' => 'about',
                'nav_group' => 'root',
                'nav_label' => 'About Us',
                'nav_order' => 2,
                'summary' => 'Our identity, vision, mission, core values, and leadership structure.',
                'meta_title' => 'About Us — Ecowattage',
                'meta_description' => 'Learn about Ecowattage’s mission, vision, core values, and phased roadmap for clean energy independence across Africa.',
            ],
            [
                'title' => 'Solutions & Services',
                'slug' => 'services',
                'route_name' => 'services',
                'nav_group' => 'root',
                'nav_label' => 'Services',
                'nav_order' => 3,
                'summary' => 'Renewable energy advocacy, public energy education, technical advisory, and future local clean-tech assembly.',
                'meta_title' => 'Solutions & Services — Ecowattage',
                'meta_description' => 'Explore Ecowattage renewable energy services: advocacy, STEM literacy, microgrid advisory, and future clean-tech manufacturing.',
            ],
            [
                'title' => 'Advocacy Campaigns',
                'slug' => 'campaigns',
                'route_name' => 'campaigns',
                'nav_group' => 'initiatives',
                'nav_label' => 'Advocacy Campaigns',
                'nav_description' => 'Public awareness drives & policy engagement across Africa',
                'nav_order' => 4,
                'summary' => 'Public energy literacy, solar healthcare advocacy, LED efficiency transitions, and fair clean-tech tariff reform.',
                'meta_title' => 'Advocacy Campaigns — Ecowattage',
                'meta_description' => 'Discover Ecowattage renewable energy advocacy campaigns across Sierra Leone and Africa.',
            ],
            [
                'title' => 'Projects Showcase',
                'slug' => 'projects',
                'route_name' => 'projects',
                'nav_group' => 'initiatives',
                'nav_label' => 'Projects Showcase',
                'nav_description' => 'Solar, wind, hydro & community electrification initiatives',
                'nav_order' => 5,
                'summary' => 'Technical blueprints for rural health clinic solarization, community solar microgrids, micro-hydro, and LED testing.',
                'meta_title' => 'Projects Showcase — Ecowattage',
                'meta_description' => 'Explore Ecowattage renewable energy project blueprints across Sierra Leone and Africa.',
            ],
            [
                'title' => 'Blog & News',
                'slug' => 'blog',
                'route_name' => 'blog',
                'nav_group' => 'resources',
                'nav_label' => 'Blog & News',
                'nav_description' => 'Renewable energy articles, press updates & insights',
                'nav_order' => 6,
                'summary' => 'Clean energy journalism, policy notes, and field perspectives.',
                'meta_title' => 'Blog & News — Ecowattage',
                'meta_description' => 'Read Ecowattage renewable energy articles, policy insights, and technical briefs.',
            ],
            [
                'title' => 'Publications & Research',
                'slug' => 'publications',
                'route_name' => 'publications',
                'nav_group' => 'resources',
                'nav_label' => 'Publications & Research',
                'nav_description' => 'Policy briefs, white papers & educational toolkits',
                'nav_order' => 7,
                'summary' => 'Evidence-based policy briefs, technical white papers, and school energy literacy toolkits.',
                'meta_title' => 'Publications & Research — Ecowattage',
                'meta_description' => 'Access Ecowattage renewable energy policy briefs, white papers, and educational toolkits.',
            ],
            [
                'title' => 'Events & Media Gallery',
                'slug' => 'events-gallery',
                'route_name' => 'events-gallery',
                'nav_group' => 'resources',
                'nav_label' => 'Events & Media Gallery',
                'nav_description' => 'Workshops, conferences, photo & video documentation',
                'nav_order' => 8,
                'summary' => 'Clean energy symposiums, field demonstrations, and documentary visual archives.',
                'meta_title' => 'Events & Media Gallery — Ecowattage',
                'meta_description' => 'Explore Ecowattage renewable energy workshops, policy symposiums, and documentary media galleries.',
            ],
            [
                'title' => 'Partners & Careers',
                'slug' => 'partners-careers',
                'route_name' => 'partners-careers',
                'nav_group' => 'root',
                'nav_label' => 'Partners & Careers',
                'nav_order' => 9,
                'summary' => 'Strategic institutional alliances, engineering fellowships, and solar technician apprenticeship cohorts.',
                'meta_title' => 'Partners & Careers — Ecowattage',
                'meta_description' => 'Partner with Ecowattage or explore renewable energy engineering and apprenticeship pathways.',
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact',
                'route_name' => 'contact',
                'nav_group' => 'root',
                'nav_label' => 'Contact',
                'nav_order' => 10,
                'summary' => 'Multi-channel coordination desk in Freetown, Sierra Leone for proposals, workshops, and partnerships.',
                'meta_title' => 'Contact Us — Ecowattage',
                'meta_description' => 'Contact Ecowattage in Freetown, Sierra Leone to propose community solar blueprints or explore partnerships.',
            ],
        ];

        foreach ($pages as $pageData) {
            CmsPage::query()->updateOrCreate(
                ['slug' => $pageData['slug']],
                [
                    ...$pageData,
                    'status' => 'published',
                    'is_visible' => true,
                    'show_in_header_nav' => true,
                    'show_in_footer_nav' => true,
                    'robots' => 'index, follow',
                    'published_at' => now(),
                    'created_by' => $admin->id,
                    'updated_by' => $admin->id,
                ]
            );
        }

        // Seed initial Blog Articles into cms_posts
        foreach (StageOneData::blogPageData()['articles'] as $article) {
            CmsPost::query()->updateOrCreate(
                ['slug' => $article['slug']],
                [
                    'type' => 'article',
                    'title' => $article['title'],
                    'category' => $article['category'],
                    'status' => 'published',
                    'is_visible' => true,
                    'featured' => (bool) ($article['featured'] ?? false),
                    'summary' => $article['excerpt'],
                    'body' => implode("\n\n", $article['body']),
                    'featured_image' => $article['image'],
                    'author_name' => $article['author'],
                    'meta_json' => [
                        'read_time' => $article['read_time'],
                        'tags' => $article['tags'],
                        'key_takeaways' => $article['key_takeaways'],
                    ],
                    'published_at' => now(),
                    'created_by' => $admin->id,
                ]
            );
        }

        // Seed initial Publications into cms_posts
        foreach (StageOneData::publicationsPageData()['publications_list'] as $pub) {
            CmsPost::query()->updateOrCreate(
                ['slug' => $pub['id']],
                [
                    'type' => 'publication',
                    'title' => $pub['title'],
                    'category' => $pub['type'],
                    'status' => 'published',
                    'is_visible' => true,
                    'featured' => false,
                    'summary' => $pub['abstract'],
                    'body' => implode("\n\n", $pub['key_findings']),
                    'featured_image' => $pub['image'],
                    'author_name' => 'Ecowattage Knowledge Centre',
                    'meta_json' => [
                        'topic' => $pub['topic'],
                        'audience' => $pub['audience'],
                        'file_status' => $pub['file_status'],
                    ],
                    'published_at' => now(),
                    'created_by' => $admin->id,
                ]
            );
        }

        // Seed initial Projects into cms_posts
        foreach (StageOneData::projectsPageData()['projects_list'] as $project) {
            CmsPost::query()->updateOrCreate(
                ['slug' => $project['id']],
                [
                    'type' => 'project',
                    'title' => $project['title'],
                    'category' => $project['category'],
                    'status' => 'published',
                    'is_visible' => true,
                    'featured' => false,
                    'summary' => $project['summary'],
                    'body' => implode("\n\n", $project['objectives']),
                    'featured_image' => $project['image'],
                    'author_name' => 'Ecowattage Engineering Desk',
                    'meta_json' => [
                        'project_status' => $project['status'],
                        'location' => $project['location'],
                        'capacity' => $project['capacity'],
                    ],
                    'published_at' => now(),
                    'created_by' => $admin->id,
                ]
            );
        }

        // Seed initial Media Library items
        $mediaFiles = [
            ['file' => '/images/illustrative/hero-solar-microgrid.jpg', 'title' => 'Community Solar Microgrid Array', 'cat' => 'Field Engineering'],
            ['file' => '/images/illustrative/hero-energy-education.jpg', 'title' => 'Classroom Clean Energy Literacy', 'cat' => 'Workshops & Education'],
            ['file' => '/images/illustrative/about-engineering-field.jpg', 'title' => 'Field Renewable Engineering Review', 'cat' => 'Field Engineering'],
            ['file' => '/images/illustrative/campaign-clinic-solar.jpg', 'title' => 'Rural Health Clinic Solarization', 'cat' => 'Community Impact'],
            ['file' => '/images/illustrative/campaign-innovation-lab.jpg', 'title' => 'Clean-Tech LED & Battery R&D Lab', 'cat' => 'Clean-Tech R&D'],
            ['file' => '/images/illustrative/project-micro-hydro.jpg', 'title' => 'Run-of-River Micro-Hydro Inspection', 'cat' => 'Field Engineering'],
            ['file' => '/images/illustrative/project-wind-solar-hybrid.jpg', 'title' => 'Coastal Hybrid Wind & Solar Study', 'cat' => 'Field Engineering'],
            ['file' => '/images/illustrative/blog-energy-forum.jpg', 'title' => 'Clean Energy Policy Briefing Forum', 'cat' => 'Research & Policy'],
            ['file' => '/images/illustrative/publications-research-desk.jpg', 'title' => 'University Clean-Tech Research Library', 'cat' => 'Research & Policy'],
            ['file' => '/images/illustrative/events-energy-conference.jpg', 'title' => 'Clean Energy Symposium Panel', 'cat' => 'Events'],
            ['file' => '/images/illustrative/events-solar-field-demo.jpg', 'title' => 'Outdoor Community Solar Demonstration', 'cat' => 'Events'],
            ['file' => '/images/illustrative/partners-careers-teamwork.jpg', 'title' => 'Engineering & Apprentice Studio Collaboration', 'cat' => 'Workforce'],
        ];

        foreach ($mediaFiles as $media) {
            MediaItem::query()->updateOrCreate(
                ['file_path' => $media['file']],
                [
                    'title' => $media['title'],
                    'disk' => 'public',
                    'mime_type' => 'image/jpeg',
                    'file_size' => 950000,
                    'category' => $media['cat'],
                    'alt_text' => Str::limit($media['title'], 120),
                    'caption' => 'Illustrative Documentary Photography — Manage or replace via Stage 2 Media Library.',
                    'is_illustrative' => true,
                    'uploaded_by' => $admin->id,
                ]
            );
        }
    }
}

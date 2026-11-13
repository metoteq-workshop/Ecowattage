<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class BlogPageTest extends TestCase
{
    public function test_blog_page_renders_successfully_with_articles_categories_and_sidebar(): void
    {
        $response = $this->get(route('blog'));

        $response->assertOk();
        $response->assertSee('Blog & News');
        $response->assertSee('Clean Energy Journalism, Policy Notes & Field Perspectives');
        $response->assertSee('Clean Energy Advocacy');
        $response->assertSee('Energy Efficiency & Innovation');
        $response->assertSee('Community Electrification');
        $response->assertSee('Policy & Governance');
        $response->assertSee('Technical Guides');
        $response->assertSee('Why Public Energy Literacy Is the Missing Link in Africa’s Solar Transition');
        $response->assertSee('How High-Efficiency LED Lighting Reduces Grid Peak Demand and Household Costs');
        $response->assertSee('Powering Essential Healthcare: The Case for Resilient Solar Microgrids in Rural Clinics');
        $response->assertSee('Unlocking Clean Energy Adoption Through Predictable Import Duties & Quality Standards');
        $response->assertSee('Assessing Run-of-River Micro-Hydro & Hybrid Renewables for Tropical River Valleys');
        $response->assertSee('Complementary Power: Why Coastal Corridors Benefit From Wind & Solar Resource Mapping');
        $response->assertSee('Search Articles');
        $response->assertSee('Featured Highlights');
        $response->assertSee('Popular Topics');
        $response->assertSee('Contribute Research Notes or Feature a Community Energy Story');
    }
}

<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_homepage_renders_successfully_with_all_reference_sections(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee("Powering Africa's Green Future");
        $response->assertSee('Turning Public Awareness Into Clean, Reliable Energy Across Africa');
        $response->assertSee('Renewable Energy Advocacy');
        $response->assertSee('Public Education & Literacy');
        $response->assertSee('Innovation & Future Manufacturing');
        $response->assertSee('About Ecowattage');
        $response->assertSee('Our Renewable Energy Services & Strategic Focus Areas');
        $response->assertSee('Have Questions About Ecowattage?');
        $response->assertSee('Supporting Our Renewable Energy');
        $response->assertSee('Why Clean Energy Advocacy Matters to Our Communities');
        $response->assertSee('Meet Our Dedicated Renewable Energy');
        $response->assertSee('Our Latest Renewable Energy Insights & Articles');
        $response->assertSee('Illustrative Photography');
    }

    public function test_all_stage_one_primary_routes_render_completed_pages(): void
    {
        $routes = [
            'home',
            'about',
            'services',
            'campaigns',
            'projects',
            'blog',
            'publications',
            'events-gallery',
            'partners-careers',
            'contact',
        ];

        foreach ($routes as $routeName) {
            $response = $this->get(route($routeName));
            $response->assertOk();
            $response->assertDontSee('Stage 1 Page-by-Page Build Queue');
        }
    }

    public function test_newsletter_subscription_demo_validates_and_redirects_with_flash_message(): void
    {
        $response = $this->from(route('home'))->post(route('newsletter.subscribe'), [
            'email' => 'advocate@ecowattage.org',
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('newsletter_status');
    }
}

<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class ServicesPageTest extends TestCase
{
    public function test_services_page_renders_successfully_with_all_sections(): void
    {
        $response = $this->get(route('services'));

        $response->assertOk();
        $response->assertSee('Solutions & Services');
        $response->assertSee('Renewable Energy Solutions & Strategic Services');
        $response->assertSee('Renewable Energy Advocacy & Policy Engagement');
        $response->assertSee('Public Energy Literacy & Community Workshops');
        $response->assertSee('Renewable Energy Technical Advisory & System Design');
        $response->assertSee('Future Clean-Tech Manufacturing & Component Assembly');
        $response->assertSee('Community Microgrid & Essential Services Support');
        $response->assertSee('Research, Policy Briefs & Knowledge Publications');
        $response->assertSee('How We Turn Clean Energy Awareness Into Enduring Impact');
        $response->assertSee('Frequently Asked Questions on Our Solutions');
        $response->assertSee('Have a Renewable Energy Project, School Workshop, or Advisory Inquiry?');
    }
}

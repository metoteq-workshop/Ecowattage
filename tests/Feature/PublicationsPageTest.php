<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class PublicationsPageTest extends TestCase
{
    public function test_publications_page_renders_successfully_with_all_sections_and_reports(): void
    {
        $response = $this->get(route('publications'));

        $response->assertOk();
        $response->assertSee('Publications & Research');
        $response->assertSee('Evidence-Based Policy Briefs, Technical Papers & Learning Toolkits');
        $response->assertSee('Advancing Energy Literacy & Domestic Clean-Tech Readiness in Sierra Leone');
        $response->assertSee('Policy Brief');
        $response->assertSee('Technical White Paper');
        $response->assertSee('Educational Toolkit');
        $response->assertSee('Feasibility Study');
        $response->assertSee('Clean-Tech Import Tariffs & Component Quality Standards in West Africa');
        $response->assertSee('Solar-Plus-Storage Sizing Guide for Rural Primary Healthcare Clinics');
        $response->assertSee('Hands-On Renewable Energy Literacy Curriculum & Workshop Toolkit');
        $response->assertSee('High-Efficiency LED Luminaires & Voltage-Surge Resilience Study');
        $response->assertSee('Run-of-River Micro-Hydro & Upstream Watershed Assessment Framework');
        $response->assertSee('Coastal Hybrid Wind & Solar Irradiance Mapping Methodology');
        $response->assertSee('Field-Verified Baselines');
        $response->assertSee('Co-Author Clean Energy Studies or Request Educational Toolkits');
    }
}

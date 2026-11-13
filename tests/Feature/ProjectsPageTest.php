<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class ProjectsPageTest extends TestCase
{
    public function test_projects_page_renders_successfully_with_all_sections_and_blueprints(): void
    {
        $response = $this->get(route('projects'));

        $response->assertOk();
        $response->assertSee('Projects Showcase');
        $response->assertSee('Pioneering Renewable Energy Solutions Across Africa');
        $response->assertSee('Community Clean Energy & Rural Clinic Resilience Blueprint');
        $response->assertSee('Solar PV & Lithium Storage Integration');
        $response->assertSee('Solar Microgrid');
        $response->assertSee('Health & Education');
        $response->assertSee('Micro-Hydro & Wind');
        $response->assertSee('Clean-Tech R&D');
        $response->assertSee('Rural Health Clinic Solarization Blueprint');
        $response->assertSee('Peri-Urban Community Solar Microgrid Concept');
        $response->assertSee('Run-of-River Micro-Hydro & Watershed Assessment');
        $response->assertSee('Coastal Hybrid Wind & Solar Resource Study');
        $response->assertSee('High-Efficiency LED & Battery Testing Initiative');
        $response->assertSee('School Clean Energy Literacy & Demo Installations');
        $response->assertSee('Propose a Site, Fund a Microgrid Pilot, or Request a Technical Brief');
    }
}

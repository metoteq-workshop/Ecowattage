<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class PartnersCareersPageTest extends TestCase
{
    public function test_partners_careers_page_renders_successfully_with_partnership_tracks_and_roles(): void
    {
        $response = $this->get(route('partners-careers'));

        $response->assertOk();
        $response->assertSee('Partners & Careers');
        $response->assertSee('Building Alliances & Empowering Africa’s Clean Energy Workforce');
        $response->assertSee('Ministries, Regulators & Municipal Councils');
        $response->assertSee('Universities, Technical Colleges & Secondary Schools');
        $response->assertSee('Component OEMs, Testing Labs & Supply Chain Allies');
        $response->assertSee('Primary Healthcare, Water & Rural Livelihood Organizations');
        $response->assertSee('Renewable Energy & Solar Microgrid Systems Engineer');
        $response->assertSee('Clean-Tech R&D & Electronic Testing Technician');
        $response->assertSee('Public Energy Literacy & School Outreach Coordinator');
        $response->assertSee('Clean Energy Policy & Empirical Research Fellow');
        $response->assertSee('Next-Gen Solar Technician & Field Apprentice Cohort');
        $response->assertSee('Ready to Partner With Ecowattage or Join Our Clean Energy Talent Pool?');
    }
}

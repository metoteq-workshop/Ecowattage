<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class CampaignsPageTest extends TestCase
{
    public function test_campaigns_page_renders_successfully_with_all_sections(): void
    {
        $response = $this->get(route('campaigns'));

        $response->assertOk();
        $response->assertSee('Advocacy Campaigns');
        $response->assertSee('Advocacy Campaigns For Africa’s Clean Energy Future');
        $response->assertSee('Clean Energy Awareness for Schools & Youth Across Sierra Leone');
        $response->assertSee('Solar Power Advocacy for Rural Health & Maternity Centres');
        $response->assertSee('High-Efficiency LED Lighting Transition for Households & SMEs');
        $response->assertSee('Solar-Powered Clean Water & Agriculture for Rural Communities');
        $response->assertSee('Fair Tariffs & Import Duty Relief for Renewable Energy Hardware');
        $response->assertSee('Next-Gen African Solar Technician & Installer Apprenticeship');
        $response->assertSee('Three Ways to Power Our Advocacy Campaigns');
        $response->assertSee('Co-Sponsor or Support a Clean Energy Campaign in Your Region');
    }
}

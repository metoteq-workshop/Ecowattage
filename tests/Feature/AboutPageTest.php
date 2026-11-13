<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class AboutPageTest extends TestCase
{
    public function test_about_page_renders_successfully_with_all_sections(): void
    {
        $response = $this->get(route('about'));

        $response->assertOk();
        $response->assertSee('About Us');
        $response->assertSee("Catalyzing Africa's Clean Energy Independence");
        $response->assertSee('Our Identity & Purpose');
        $response->assertSee('Our Mission, Vision & Core Values');
        $response->assertSee('Our Core Initiatives & Impact Pathways');
        $response->assertSee('From Advocacy to Indigenous Clean-Tech Manufacturing');
        $response->assertSee('The People Behind Ecowattage');
        $response->assertSee('Help Us Power Africa');
    }
}

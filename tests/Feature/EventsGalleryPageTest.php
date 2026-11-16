<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class EventsGalleryPageTest extends TestCase
{
    public function test_events_gallery_page_renders_successfully_with_events_and_media_items(): void
    {
        $response = $this->get(route('events-gallery'));

        $response->assertOk();
        $response->assertSee('Events & Media Gallery');
        $response->assertSee('Clean Energy Dialogues, Field Trainings & Documentary Media');
        $response->assertSee('Workshops & Training');
        $response->assertSee('Policy Symposiums');
        $response->assertSee('Community Outreach');
        $response->assertSee('Technical Seminars');
        $response->assertSee('Sierra Leone Clean Energy Policy & Local Assembly Dialogue');
        $response->assertSee('Hands-On Community Solar & Microgrid Orientation Workshop');
        $response->assertSee('Secondary School Clean Energy Literacy & STEM Outreach');
        $response->assertSee('Primary Healthcare Solar Resilience & Cold-Chain Technical Seminar');
        $response->assertSee('Field Highlights & Clean Energy Media Gallery');
        $response->assertSee('Clean Energy Policy Symposium & Engineering Dialogue');
        $response->assertSee('Live Courtyard Solar PV & Inverter Orientation');
        $response->assertSee('Invite Ecowattage to Lead a Clean Energy Workshop or Policy Panel');
    }
}

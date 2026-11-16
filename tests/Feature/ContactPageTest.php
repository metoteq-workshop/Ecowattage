<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class ContactPageTest extends TestCase
{
    public function test_contact_page_renders_successfully_with_cards_form_and_desks(): void
    {
        $response = $this->get(route('contact'));

        $response->assertOk();
        $response->assertSee('Contact Us');
        $response->assertSee('Start a Clean Energy Conversation Across Sierra Leone & Africa');
        $response->assertSee('Headquarters & Operations');
        $response->assertSee('Telephone & Field Line');
        $response->assertSee('Electronic Mail Desk');
        $response->assertSee('Office & Field Hours');
        $response->assertSee('Send Us an Inquiry or Project Proposal');
        $response->assertSee('Advocacy & Public Literacy Desk');
        $response->assertSee('Technical Blueprints & R&D Desk');
        $response->assertSee('Partnerships, Policy & Talent Desk');
    }

    public function test_contact_form_validates_and_redirects_with_confirmation_status(): void
    {
        $response = $this->from(route('contact'))->post(route('contact.submit'), [
            'name' => 'Aminata Kamara',
            'email' => 'aminata@example.org',
            'organization' => 'Freetown Community Clinic',
            'inquiry_type' => 'Project Blueprint & Site Proposal',
            'subject' => 'Solar Cold-Chain Assessment Inquiry',
            'message' => 'We would like to discuss a solar-plus-storage assessment for our rural maternity clinic.',
        ]);

        $response->assertRedirect(route('contact'));
        $response->assertSessionHas('contact_status');
    }
}

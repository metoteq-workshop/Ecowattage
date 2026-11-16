<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\ActivityLog;
use App\Models\CmsPage;
use App\Models\CmsPost;
use App\Models\ContactSubmission;
use App\Models\MediaItem;
use App\Models\NewsletterSubscriber;
use App\Models\User;
use App\Support\CmsContentService;
use Database\Seeders\CmsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StageTwoCmsTest extends TestCase
{
    use RefreshDatabase;

    public function test_cms_seeder_populates_all_ten_pages_admin_user_posts_and_media(): void
    {
        $this->seed(CmsSeeder::class);

        $this->assertDatabaseHas('users', [
            'email' => 'admin@ecowattage.com',
            'role' => UserRole::SuperAdmin->value,
        ]);

        $this->assertSame(10, CmsPage::query()->count());
        $this->assertGreaterThanOrEqual(18, CmsPost::query()->count());
        $this->assertSame(12, MediaItem::query()->count());
    }

    public function test_hiding_and_unhiding_a_page_preserves_content_updates_nav_and_enforces_visibility(): void
    {
        $this->seed(CmsSeeder::class);

        $admin = User::query()->where('email', 'admin@ecowattage.com')->firstOrFail();
        $aboutPage = CmsPage::query()->where('route_name', 'about')->firstOrFail();
        $originalSummary = $aboutPage->summary;

        // 1. Admin hides the About Us page without deleting it
        $this->actingAs($admin)
            ->patch(route('admin.pages.toggle-visibility', $aboutPage))
            ->assertRedirect();

        $aboutPage->refresh();
        $this->assertFalse($aboutPage->is_visible);
        $this->assertSame($originalSummary, $aboutPage->summary);

        // 2. Navigation no longer includes 'about'
        $navRoutes = collect(CmsContentService::navigation())->pluck('route')->all();
        $this->assertNotContains('about', $navRoutes);

        // 3. Public visitor receives 404 on hidden page
        auth()->logout();
        $this->get(route('about'))->assertNotFound();

        // 4. Authenticated admin can preview hidden page with ?preview=1
        $this->actingAs($admin)
            ->get(route('about', ['preview' => 1]))
            ->assertOk()
            ->assertSee('CMS Preview Mode');

        // 5. Admin unhides the page -> public access and navigation are restored
        $this->actingAs($admin)
            ->patch(route('admin.pages.toggle-visibility', $aboutPage))
            ->assertRedirect();

        $aboutPage->refresh();
        $this->assertTrue($aboutPage->is_visible);

        auth()->logout();
        $this->get(route('about'))->assertOk();

        $this->assertDatabaseHas('activity_logs', [
            'action' => 'page.hidden',
            'auditable_id' => $aboutPage->id,
        ]);
        $this->assertDatabaseHas('activity_logs', [
            'action' => 'page.unhidden',
            'auditable_id' => $aboutPage->id,
        ]);
    }

    public function test_custom_cms_page_creation_and_seo_metadata_override(): void
    {
        $this->seed(CmsSeeder::class);
        $admin = User::query()->where('email', 'admin@ecowattage.com')->firstOrFail();

        $this->actingAs($admin)->post(route('admin.pages.store'), [
            'title' => 'Solar Manufacturing Roadmap 2027',
            'slug' => 'solar-manufacturing-roadmap-2027',
            'nav_group' => 'root',
            'nav_label' => '2027 Roadmap',
            'nav_order' => 15,
            'summary' => 'Phased plan for local LED and solar battery assembly in Sierra Leone.',
            'content' => 'Detailed technical milestones for domestic clean-tech assembly.',
            'status' => 'published',
            'is_visible' => '1',
            'show_in_header_nav' => '1',
            'show_in_footer_nav' => '1',
            'meta_title' => '2027 Solar Assembly Roadmap — Ecowattage SEO',
            'meta_description' => 'Official SEO description for the 2027 roadmap.',
            'robots' => 'index, follow',
        ])->assertRedirect(route('admin.pages.index'));

        $this->get(route('pages.custom', ['slug' => 'solar-manufacturing-roadmap-2027']))
            ->assertOk()
            ->assertSee('2027 Solar Assembly Roadmap — Ecowattage SEO')
            ->assertSee('Detailed technical milestones for domestic clean-tech assembly.');

        $this->assertGreaterThan(0, ActivityLog::query()->where('action', 'page.created')->count());
    }

    public function test_rbac_blocks_unauthorized_roles_from_protected_cms_actions(): void
    {
        $this->seed(CmsSeeder::class);

        $guestAuthor = User::factory()->withRole(UserRole::GuestAuthor)->create();
        $homePage = CmsPage::query()->where('route_name', 'home')->firstOrFail();

        // Guest Author can view dashboard and manage content posts
        $this->actingAs($guestAuthor)->get(route('admin.dashboard'))->assertOk();
        $this->actingAs($guestAuthor)->get(route('admin.posts.index'))->assertOk();

        // Guest Author is forbidden (403) from managing site pages, toggling visibility, or managing users
        $this->actingAs($guestAuthor)->get(route('admin.pages.index'))->assertForbidden();
        $this->actingAs($guestAuthor)->patch(route('admin.pages.toggle-visibility', $homePage))->assertForbidden();
        $this->actingAs($guestAuthor)->get(route('admin.users.index'))->assertForbidden();
    }

    public function test_contact_inquiries_and_newsletter_subscriptions_persist_to_database(): void
    {
        $this->seed(CmsSeeder::class);

        $this->post(route('contact.submit'), [
            'name' => 'Ibrahim Sesay',
            'email' => 'ibrahim@example.org',
            'organization' => 'Bo District Secondary School',
            'inquiry_type' => 'School Workshop or Speaker Request',
            'subject' => 'Science Week Solar Demo',
            'message' => 'We would love to host an Ecowattage solar demonstration for our senior science students.',
        ])->assertRedirect();

        $this->post(route('newsletter.subscribe'), [
            'email' => 'researcher@sierra-energy.org',
        ])->assertRedirect();

        $this->assertSame(1, ContactSubmission::query()->where('email', 'ibrahim@example.org')->count());
        $this->assertSame(1, NewsletterSubscriber::query()->where('email', 'researcher@sierra-energy.org')->count());
    }
}

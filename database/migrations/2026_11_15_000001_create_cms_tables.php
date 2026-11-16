<?php

declare(strict_types=1);

use App\Enums\UserRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->string('role', 50)->default(UserRole::Editor->value)->after('email');
            $table->boolean('is_active')->default(true)->after('role');
        });

        Schema::create('cms_pages', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('route_name')->nullable()->unique();
            $table->string('nav_group', 50)->default('root');
            $table->string('nav_label')->nullable();
            $table->string('nav_description')->nullable();
            $table->unsignedInteger('nav_order')->default(10);
            $table->text('summary')->nullable();
            $table->longText('content')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('status', 30)->default('published')->index();
            $table->boolean('is_visible')->default(true)->index();
            $table->boolean('show_in_header_nav')->default(true);
            $table->boolean('show_in_footer_nav')->default(true);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('robots', 50)->default('index, follow');
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('cms_posts', function (Blueprint $table): void {
            $table->id();
            $table->string('type', 40)->default('article')->index();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->nullable()->index();
            $table->string('status', 30)->default('published')->index();
            $table->boolean('is_visible')->default(true)->index();
            $table->boolean('featured')->default(false);
            $table->text('summary')->nullable();
            $table->longText('body')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('attachment_path')->nullable();
            $table->string('author_name')->nullable();
            $table->json('meta_json')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('media_items', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('file_path');
            $table->string('disk', 40)->default('public');
            $table->string('mime_type', 100)->nullable();
            $table->unsignedBigInteger('file_size')->default(0);
            $table->string('category', 60)->default('General');
            $table->string('alt_text')->nullable();
            $table->text('caption')->nullable();
            $table->boolean('is_illustrative')->default(true);
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('contact_submissions', function (Blueprint $table): void {
            $table->id();
            $table->string('name', 120);
            $table->string('email');
            $table->string('organization', 150)->nullable();
            $table->string('inquiry_type', 120);
            $table->string('subject', 180);
            $table->text('message');
            $table->string('status', 30)->default('new')->index();
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });

        Schema::create('newsletter_subscribers', function (Blueprint $table): void {
            $table->id();
            $table->string('email')->unique();
            $table->string('status', 30)->default('active')->index();
            $table->timestamp('subscribed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('activity_logs', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action', 100)->index();
            $table->string('auditable_type')->nullable();
            $table->unsignedBigInteger('auditable_id')->nullable();
            $table->string('description');
            $table->json('properties')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('newsletter_subscribers');
        Schema::dropIfExists('contact_submissions');
        Schema::dropIfExists('media_items');
        Schema::dropIfExists('cms_posts');
        Schema::dropIfExists('cms_pages');

        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn(['role', 'is_active']);
        });
    }
};

<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRole: string
{
    case SuperAdmin = 'super_admin';
    case Ceo = 'ceo';
    case Administrator = 'administrator';
    case ContentManager = 'content_manager';
    case AdvocacyOfficer = 'advocacy_officer';
    case MarketingOfficer = 'marketing_officer';
    case GraphicDesigner = 'graphic_designer';
    case Editor = 'editor';
    case GuestAuthor = 'guest_author';

    /**
     * Human-readable role title.
     */
    public function label(): string
    {
        return match ($this) {
            self::SuperAdmin => 'Super Administrator',
            self::Ceo => 'CEO / Executive',
            self::Administrator => 'Administrator',
            self::ContentManager => 'Content Manager',
            self::AdvocacyOfficer => 'Advocacy Officer',
            self::MarketingOfficer => 'Marketing Officer',
            self::GraphicDesigner => 'Graphic Designer',
            self::Editor => 'Editor',
            self::GuestAuthor => 'Guest Author',
        };
    }

    /**
     * Whether this role can manage site pages, SEO, and navigation menus.
     */
    public function canManagePages(): bool
    {
        return in_array($this, [
            self::SuperAdmin,
            self::Ceo,
            self::Administrator,
            self::ContentManager,
        ], true);
    }

    /**
     * Whether this role can publish, hide, or unhide pages and content.
     */
    public function canPublish(): bool
    {
        return in_array($this, [
            self::SuperAdmin,
            self::Ceo,
            self::Administrator,
            self::ContentManager,
            self::AdvocacyOfficer,
            self::MarketingOfficer,
            self::Editor,
        ], true);
    }

    /**
     * Whether this role can create/edit modular content (blogs, campaigns, projects, events, publications).
     */
    public function canManageContent(): bool
    {
        return in_array($this, [
            self::SuperAdmin,
            self::Ceo,
            self::Administrator,
            self::ContentManager,
            self::AdvocacyOfficer,
            self::MarketingOfficer,
            self::Editor,
            self::GuestAuthor,
        ], true);
    }

    /**
     * Whether this role can upload and manage media library items.
     */
    public function canManageMedia(): bool
    {
        return in_array($this, [
            self::SuperAdmin,
            self::Ceo,
            self::Administrator,
            self::ContentManager,
            self::MarketingOfficer,
            self::GraphicDesigner,
            self::Editor,
        ], true);
    }

    /**
     * Whether this role can manage users, roles, and inspect full security audit logs.
     */
    public function canManageUsers(): bool
    {
        return in_array($this, [
            self::SuperAdmin,
            self::Ceo,
            self::Administrator,
        ], true);
    }
}

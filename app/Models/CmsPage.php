<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'title',
    'slug',
    'route_name',
    'nav_group',
    'nav_label',
    'nav_description',
    'nav_order',
    'summary',
    'content',
    'featured_image',
    'status',
    'is_visible',
    'show_in_header_nav',
    'show_in_footer_nav',
    'meta_title',
    'meta_description',
    'og_image',
    'robots',
    'published_at',
    'created_by',
    'updated_by',
])]
class CmsPage extends Model
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'nav_order' => 'integer',
            'is_visible' => 'boolean',
            'show_in_header_nav' => 'boolean',
            'show_in_footer_nav' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Scope to publicly accessible (published and visible) pages.
     *
     * @param  Builder<self>  $query
     * @return Builder<self>
     */
    public function scopePubliclyAccessible(Builder $query): Builder
    {
        return $query->where('status', 'published')->where('is_visible', true);
    }

    /**
     * Whether this page is currently accessible to regular public visitors.
     */
    public function isPubliclyAccessible(): bool
    {
        return $this->status === 'published' && $this->is_visible === true;
    }

    /**
     * Creator relationship.
     *
     * @return BelongsTo<User, $this>
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Updater relationship.
     *
     * @return BelongsTo<User, $this>
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

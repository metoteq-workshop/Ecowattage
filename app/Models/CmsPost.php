<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'type',
    'title',
    'slug',
    'category',
    'status',
    'is_visible',
    'featured',
    'summary',
    'body',
    'featured_image',
    'attachment_path',
    'author_name',
    'meta_json',
    'published_at',
    'created_by',
])]
class CmsPost extends Model
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_visible' => 'boolean',
            'featured' => 'boolean',
            'meta_json' => 'array',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Scope to publicly accessible posts.
     *
     * @param  Builder<self>  $query
     * @return Builder<self>
     */
    public function scopePubliclyAccessible(Builder $query): Builder
    {
        return $query->where('status', 'published')->where('is_visible', true);
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Resolve the public URL where this modular content item appears on the frontend.
     */
    public function publicUrl(): string
    {
        $routeName = match ($this->type) {
            'article' => 'blog',
            'publication' => 'publications',
            'project' => 'projects',
            'campaign' => 'campaigns',
            'event' => 'events-gallery',
            default => 'blog',
        };

        return route($routeName).'#'.$this->slug;
    }
}

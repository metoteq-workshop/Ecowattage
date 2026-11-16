<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

#[Fillable([
    'user_id',
    'action',
    'auditable_type',
    'auditable_id',
    'description',
    'properties',
    'ip_address',
])]
class ActivityLog extends Model
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'properties' => 'array',
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Record an administrative audit log entry.
     *
     * @param  array<string, mixed>  $properties
     */
    public static function record(
        string $action,
        string $description,
        ?Model $auditable = null,
        array $properties = []
    ): self {
        return self::query()->create([
            'user_id' => Auth::id(),
            'action' => $action,
            'auditable_type' => $auditable !== null ? $auditable::class : null,
            'auditable_id' => $auditable?->getKey(),
            'description' => $description,
            'properties' => $properties,
            'ip_address' => request()?->ip(),
        ]);
    }
}

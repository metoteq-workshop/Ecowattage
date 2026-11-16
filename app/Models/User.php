<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'is_active'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
            'is_active' => 'boolean',
        ];
    }

    /**
     * Activity logs recorded for this user.
     *
     * @return HasMany<ActivityLog, $this>
     */
    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }

    /**
     * Resolve the UserRole enum instance safely.
     */
    public function roleEnum(): UserRole
    {
        if ($this->role instanceof UserRole) {
            return $this->role;
        }

        return UserRole::tryFrom((string) $this->role) ?? UserRole::Editor;
    }

    public function canManagePages(): bool
    {
        return $this->is_active && $this->roleEnum()->canManagePages();
    }

    public function canPublish(): bool
    {
        return $this->is_active && $this->roleEnum()->canPublish();
    }

    public function canManageContent(): bool
    {
        return $this->is_active && $this->roleEnum()->canManageContent();
    }

    public function canManageMedia(): bool
    {
        return $this->is_active && $this->roleEnum()->canManageMedia();
    }

    public function canManageUsers(): bool
    {
        return $this->is_active && $this->roleEnum()->canManageUsers();
    }
}

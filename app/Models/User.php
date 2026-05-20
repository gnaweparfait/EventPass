<?php

namespace App\Models;

use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'avatar_path',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function isOrganizer(): bool
    {
        return $this->role === UserRole::Organisateur;
    }

    public function isParticipant(): bool
    {
        return $this->role === UserRole::Participant;
    }

    public function hasRole(UserRole|string $role): bool
    {
        $roleValue = $role instanceof UserRole ? $role->value : $role;

        return $this->role->value === $roleValue;
    }

    public function homeUrl(): string
    {
        return $this->isOrganizer()
            ? route('dashboard')
            : route('profile.edit');
    }

    public function avatarUrl(): ?string
    {
        return $this->avatar_path
            ? asset('storage/'.$this->avatar_path)
            : null;
    }

    public function initials(): string
    {
        $parts = preg_split('/\s+/', trim($this->name), 2);

        if (count($parts) >= 2) {
            return strtoupper(substr($parts[0], 0, 1).substr($parts[1], 0, 1));
        }

        return strtoupper(substr($this->name, 0, 1));
    }
}

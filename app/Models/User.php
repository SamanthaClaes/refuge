<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
        ];
    }
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isVolunteer(): bool
    {
        return $this->role === 'volunteer';
    }

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class, 'created_by');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function getAvatarUrl(): string
    {
        if ($this->avatar && Storage::disk('s3')->exists($this->avatar)) {
            return asset('storage/' . $this->avatar);
        }

        return asset('img/default.jpg');
    }

    public function getOriginalAvatarUrl(): string
    {
        if (
            $this->avatar &&
            Storage::disk('s3')->exists($this->avatar)
        ) {
            return asset("storage/{$this->avatar}");
        }

        return asset('img/default.jpg');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Animal extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'age',
        'gender',
        'specie',
        'description',
        'status',
        'vaccine',
        'avatar_path',
        'file',
        'breed',
        'species',
        'path',
        'animal_id',
        'started_at',
        'created_by'
    ];

    protected $casts = ['age' => 'date', 'avatar_path'=>'array'];

    public function getAvatarUrl($size = 400)
    {
        if (!$this->avatar_path) {
            return null;
        }

        $fileName = basename($this->avatar_path);
        return asset("storage/avatars/{$size}/{$fileName}");
    }


    public function getOriginalAvatarUrl()
    {
        if (!$this->avatar_path) {
            return null;
        }

        return asset("storage/{$this->avatar_path}");
    }

    public function avatars(): HasMany
    {
        return $this->hasMany(Avatar::class);
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'available' => 'Disponible',
            'pending' => 'En attente',
            'in_care' => 'En soins',
            'adopted' => 'Adopté(e)',
            default => $this->status,
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'disponible' => 'bg-green-600',
            'en attente' => 'bg-yellow-500',
            'en soins'   => 'bg-blue-600',
            'adopté(e)'  => 'bg-red-600',
            default      => 'bg-gray-400',
        };
    }

    public function adoptions(): HasMany
    {
        return $this->hasMany(Adoption::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Animal extends Model
{
    use HasFactory, Notifiable;

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
        'path'
    ];

    protected $casts = ['age' => 'integer', 'avatar_path'=>'array'];

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

}


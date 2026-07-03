<?php

namespace App\Models;

use App\Policies\AnimalPolicy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Storage;

#[UsePolicy(AnimalPolicy::class)]
class Animal extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'age',
        'gender',
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
        'created_by',
        'breed_id',
        'animal_type_id'
    ];

    protected $casts = ['age' => 'date', 'avatar_path'=>'array'];


    public function getAvatarUrl(int $size = 400): string
    {
        if ($this->avatar_path) {
            $fileName = basename($this->avatar_path);
            $path = "avatars/{$size}/{$fileName}";

            if (Storage::disk('public')->exists($path)) {
                return asset("storage/{$path}");
            }
        }

        return match ($this->animalType?->name) {
            'Chien' => asset('img/default/dog.jpg'),
            'Chat' => asset('img/default/cat.jpg'),
            'Oiseau' => asset('img/default/bird.jpg'),
            'Lapin' => asset('img/default/rabbit.jpg'),
            'Rat' => asset('img/default/rat.jpg'),
            'Furet' => asset('img/default/ferret.jpg'),
            default => asset('img/default/default-animal.jpg'),
        };
    }

    public function getOriginalAvatarUrl(): string
    {
        if (
            $this->avatar_path &&
            Storage::disk('public')->exists($this->avatar_path)
        ) {
            return asset("storage/{$this->avatar_path}");
        }

        return asset('img/default-animal.jpg');
    }

    public function avatars(): HasMany
    {
        return $this->hasMany(Avatar::class);
    }

    public function birthDateFormat(): string
    {
        $birthdate = Carbon::parse($this->age);
        $months = floor($birthdate->diffInMonths(Carbon::now()));
        $years = floor($birthdate->diffInYears(Carbon::now()));


        if ($years < 1){
            return $months . ' ' . "mois";
        }
        return $years . ' ' . ($years == 1 ? 'an' : 'ans');

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
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function animalType(): BelongsTo
    {
        return $this->belongsTo(AnimalTypes::class);
    }

    public function breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class);
    }

    public function adoptionRequests(): HasMany
    {
        return $this->hasMany(AdoptionRequest::class);
    }
}


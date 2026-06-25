<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Breed extends Model
{
    use HasFactory, SoftDeletes;

    public function animalType(): BelongsTo
    {
            return $this->belongsTo(AnimalTypes::class);
    }

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }
}

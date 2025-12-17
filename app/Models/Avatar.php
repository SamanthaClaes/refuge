<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avatar extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'path',
        'description' ,
        'animal_id'
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }
}

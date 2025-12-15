<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Animal extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'age', 'gender', 'specie', 'description', 'status', 'vaccine', 'avatar', 'race', 'file',
        'breed',
        'species'
    ];

    protected $casts = ['age' => 'integer'];

}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
     protected $table = 'contact_messages';
    protected $fillable = [
        'name',
        'first_name',
        'email',
        'phone',
        'message',
        'read',
    ];

    protected $casts = [
        'read' => 'boolean',
    ];
}

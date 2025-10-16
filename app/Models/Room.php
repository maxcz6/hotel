<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'type',
        'price',
        'description',
        'capacity',
        'status',
        'amenities',
    ];

    protected $casts = [
        'amenities' => 'array',
        'price' => 'decimal:2',
    ];
}

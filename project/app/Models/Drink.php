<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    protected $fillable = [
        'name',
        'price',
        'is_available',
        'order_count',
        'category'
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'order_count' => 'integer'
    ];
} 
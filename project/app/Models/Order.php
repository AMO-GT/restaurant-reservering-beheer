<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * De velden die mass assignment toestaan.
     *
     * @var array
     */
    protected $fillable = [
        'table_number',
        'item_name',
        'quantity',
    ];
}<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
}

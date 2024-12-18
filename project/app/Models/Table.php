<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = ['table_number', 'capacity', 'is_available'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

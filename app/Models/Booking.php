<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';

    protected $fillable = [
        'userId', 'namaTeam', 'date', 'jam', 'image', 'endDate', 'tanggal',
    ];

}

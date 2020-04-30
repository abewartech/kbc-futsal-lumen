<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingComplete extends Model
{
    protected $table = 'complete_booking';

    protected $fillable = [
        'prevId', 'userId', 'namaTeam', 'date', 'jam', 'endDate', 'tanggal',
    ];

}

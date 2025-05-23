<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'date',
        'time',
        'name',
        'email',
        'phone',
    ];

    public $timestamps = true;
}

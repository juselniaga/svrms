<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mukim extends Model
{
    protected $fillable = [
        'mukim_no',
        'short_mukim',
        'mukim',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}

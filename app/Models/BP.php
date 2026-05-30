<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BP extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'bp_short',
        'bp_name',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}

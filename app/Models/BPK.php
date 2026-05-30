<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BPK extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'bp_id',
        'bpk_short',
        'bpk_name',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // Relationship with BP
    public function bp()
    {
        return $this->belongsTo(BP::class, 'bp_id', 'id');
    }
}

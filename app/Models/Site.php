<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $primaryKey = 'site_id';

    protected $fillable = [
        'application_id',
        'mukim',
        'bp',
        'bpk',
        'luas',
        'google_lat',
        //'google_long',
        'map',
        'lot',
        'lembaran',
        'kategori_tanah',
        'status_tanah',
        'status',
        'is_active',
    ];

    protected $casts = [
        'map' => 'array',
        'luas' => 'decimal:4',
       // 'google_lat' => 'decimal:8',
       // 'google_long' => 'decimal:8',
        'is_active' => 'boolean',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id', 'application_id');
    }

    public function mukim_relation()
    {
        return $this->belongsTo(Mukim::class, 'mukim', 'mukim_no');
    }

    public function bp_relation()
    {
        return $this->belongsTo(BP::class, 'bp', 'id');
    }

    public function bpk_relation()
    {
        return $this->belongsTo(BPK::class, 'bpk', 'id');
    }
}

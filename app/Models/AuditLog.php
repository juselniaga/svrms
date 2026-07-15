<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'application_id',
        'user_id',
        'action',
        'previous_status',
        'new_status',
        'snapshot_old',
        'snapshot_new',
        'remarks',
        'timestamp',
    ];

    protected $casts = [
        'snapshot_old' => 'array',
        'snapshot_new' => 'array',
        'timestamp' => 'datetime',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id', 'application_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}

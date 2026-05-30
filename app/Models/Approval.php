<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $primaryKey = 'approval_id';

    protected $fillable = [
        'application_id',
        'director_id',
        'decision',
        'conditions',
        'remarks',
        'remarks_history',
        'approval_status',
        'approved_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'approval_status' => 'string',
        'remarks_history' => 'array',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id', 'application_id');
    }

    public function director()
    {
        return $this->belongsTo(User::class, 'director_id', 'user_id');
    }
}

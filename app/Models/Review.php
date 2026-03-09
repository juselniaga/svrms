<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $primaryKey = 'review_id';

    protected $fillable = [
        'application_id',
        'officer_id',
        'review_content',
        'recommendation',
        'self_check_completed',
        'submitted_at',
    ];

    protected $casts = [
        'self_check_completed' => 'boolean',
        'submitted_at' => 'datetime',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id', 'application_id');
    }

    public function officer()
    {
        return $this->belongsTo(User::class, 'officer_id', 'user_id');
    }
}

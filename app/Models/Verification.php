<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    protected $primaryKey = 'verify_id';

    protected $fillable = [
        'application_id',
        'assistant_director_id',
        'verification_status',
        'remarks',
        'verified_at',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id', 'application_id');
    }

    public function assistantDirector()
    {
        return $this->belongsTo(User::class, 'assistant_director_id', 'user_id');
    }
}

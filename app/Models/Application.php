<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;
    protected $primaryKey = 'application_id';

    protected $fillable = [
        'reference_no',
        'developer_id',
        'tajuk',
        'lokasi',
        'no_fail',
        'status',
        'officer_id',
        'is_active',
    ];

    public function developer()
    {
        return $this->belongsTo(Developer::class, 'developer_id', 'developer_id');
    }

    public function officer()
    {
        return $this->belongsTo(User::class, 'officer_id', 'user_id');
    }

    public function site()
    {
        return $this->hasOne(Site::class, 'application_id', 'application_id');
    }

    public function siteVisits()
    {
        return $this->hasMany(SiteVisit::class, 'application_id', 'application_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'application_id', 'application_id')->latest('review_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'application_id', 'application_id');
    }

    public function verification()
    {
        return $this->hasOne(Verification::class, 'application_id', 'application_id')->latest('verify_id');
    }

    public function verifications()
    {
        return $this->hasMany(Verification::class, 'application_id', 'application_id');
    }

    public function approval()
    {
        return $this->hasOne(Approval::class, 'application_id', 'application_id')->latest('approval_id');
    }

    public function approvals()
    {
        return $this->hasMany(Approval::class, 'application_id', 'application_id');
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class, 'application_id', 'application_id');
    }
}

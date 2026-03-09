<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteVisit extends Model
{
    protected $primaryKey = 'site_visit_id';

    protected $fillable = [
        'application_id',
        'officer_id',
        'visit_date',
        'finding_north',
        'photos_north',
        'findings_south',
        'photos_south',
        'findings_east',
        'photo_east',
        'finding_west',
        'photo_west',
        'attachments',
        'activity',
        'facility',
        'entrance_way',
        'parit',
        'tree',
        'topography',
        'land_use_zone',
        'density',
        'recommend_road',
        'parking',
        'anjakan',
        'social_facility',
        'location_data',
        'status',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'photos_north' => 'array',
        'photos_south' => 'array',
        'photo_east' => 'array',
        'photo_west' => 'array',
        'attachments' => 'array',
        'recommend_road' => 'boolean',
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

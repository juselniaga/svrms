<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Developer extends Model
{
    use HasFactory;
    protected $primaryKey = 'developer_id';

    protected $fillable = [
        'name',
        'address1',
        'address2',
        'poskod',
        'city',
        'state',
        'email',
        'fax',
        'tel',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class, 'developer_id', 'developer_id');
    }
}

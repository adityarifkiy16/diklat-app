<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MVillage extends Model
{
    use HasFactory;
    protected $table = 'MVillages';

    protected $hidden = [
        'district_id'
    ];

    public function district()
    {
        return $this->belongsTo(MDistrict::class);
    }
}

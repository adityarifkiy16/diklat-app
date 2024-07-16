<?php

namespace App\Models;

use App\Models\MRegency;
use App\Models\MVillage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MDistrict extends Model
{
    use HasFactory;
    protected $table = 'MDistricts';
    protected $hidden = [
        'regency_id'
    ];

    public function regency()
    {
        return $this->belongsTo(MRegency::class);
    }

    public function villages()
    {
        return $this->hasMany(MVillage::class);
    }
}

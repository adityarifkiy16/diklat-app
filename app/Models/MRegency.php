<?php

namespace App\Models;

use App\Models\MPeserta;
use App\Models\MDistrict;
use App\Models\MProvince;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MRegency extends Model
{
    use HasFactory;

    protected $table = 'MRegencies';

    protected $hidden = [
        'province_id'
    ];

    public function province()
    {
        return $this->belongsTo(MProvince::class);
    }

    public function districts()
    {
        return $this->hasMany(MDistrict::class);
    }

    public function peserta()
    {
        return $this->hasMany(MPeserta::class);
    }
}

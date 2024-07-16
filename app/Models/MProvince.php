<?php

namespace App\Models;

use App\Models\MRegency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MProvince extends Model
{
    use HasFactory;

    protected $table = 'MProvinces';

    public function regencies()
    {
        return $this->hasMany(MRegency::class, 'province_id', 'id');
    }
}

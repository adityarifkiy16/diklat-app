<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MDiklat extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'MDiklat';

    protected $guarded = 'id';

    public function peserta()
    {
        $this->belongsToMany(MPeserta::class, 'TDiklat_peserta', 'diklat_id', 'peserta_id');
    }
}

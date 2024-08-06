<?php

namespace App\Models;

use App\Models\MPeserta;
use App\Models\MInstructor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MDiklat extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'MDiklat';

    protected $guarded = ['id'];

    public function peserta()
    {
        return $this->belongsToMany(MPeserta::class, 'TDiklat_peserta', 'diklat_id', 'peserta_id');
    }

    public function instructor()
    {
        return $this->belongsTo(MInstructor::class);
    }
}

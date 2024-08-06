<?php

namespace App\Models;

use App\Models\MDiklat;
use App\Models\MInstructor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TPenjadwalan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Tpenjadwalan';

    protected $guarded = ['id'];

    public function diklat()
    {
        return $this->belongsTo(MDiklat::class);
    }
    public function instruct()
    {
        // return $this->belongsTo(MInstructor::class, 'instruct_id', 'id'); explisit parameter
        return $this->belongsTo(MInstructor::class);
    }
}

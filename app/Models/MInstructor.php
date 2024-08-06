<?php

namespace App\Models;

use App\Models\TPenjadwalan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MInstructor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'MInstructor';

    protected $guarded = ['id'];

    public function penjadwalan()
    {
        return $this->hasMany(TPenjadwalan::class);
    }
}

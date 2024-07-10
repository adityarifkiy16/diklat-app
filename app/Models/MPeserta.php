<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class MPeserta extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'MPeserta';

    protected $guarded = 'id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function diklat()
    {
        return $this->belongsToMany(MDiklat::class, 'TDiklat_peserta', 'peserta_id', 'diklat_id');
    }
}

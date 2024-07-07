<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MRole extends Model
{
    use HasFactory;

    protected $table = 'MRole';

    protected $guarded = 'id';

    public function users()
    {
        $this->hasOne(User::class);
    }
}

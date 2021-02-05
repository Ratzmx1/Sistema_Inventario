<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function check_ins()
    {
        return $this->hasMany(Check_in::class);
    }
}

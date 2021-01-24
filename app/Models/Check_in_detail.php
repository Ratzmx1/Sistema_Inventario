<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check_in_detail extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function entry(){
         return $this->belongsTo(Check_in::class);
    }


}

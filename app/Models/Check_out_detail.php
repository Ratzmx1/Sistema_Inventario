<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check_out_detail extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function check_out()
    {
        return $this->belongsTo(Check_out::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

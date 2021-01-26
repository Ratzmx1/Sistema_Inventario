<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check_in_detail extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function check_in()
    {
        return $this->belongsTo(Check_in::class,"check_in_id");
    }

    public function product()
    {
        return $this->belongsTo(Product::class,"product_id");
    }


}

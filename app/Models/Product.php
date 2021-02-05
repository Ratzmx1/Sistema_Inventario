<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function check_ins()
    {
        return $this->hasManyThrough(Check_in::class, "check_in_details");
    }

    public function check_outs()
    {
        return $this->hasManyThrough(Check_out::class, "check_out_details");
    }
}

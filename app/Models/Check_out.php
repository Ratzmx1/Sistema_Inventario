<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check_out extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, "check_out_details", "product_id");
    }
}

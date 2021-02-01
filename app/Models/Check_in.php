<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check_in extends Model
{
    use HasFactory;

    public function provider()
    {
        return $this->belongsTo(Provider::class,);
    }

    public function user()
    {
        return $this->belongsTo(User::class);   // N x 1 (Lado del 1)
        // hasMany (Lado del N)
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,"check_in_details"); // N x M
    }

    public function details()
    {
        return $this->hasMany(Check_in_detail::class);
    }

}

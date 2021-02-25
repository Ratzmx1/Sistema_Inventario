<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Check_out_detail
 *
 * @property int $id
 * @property int $product_id
 * @property int $check_out_id
 * @property int $quantity
 * @property-read \App\Models\Check_out $check_out
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|Check_out_detail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Check_out_detail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Check_out_detail query()
 * @method static \Illuminate\Database\Eloquent\Builder|Check_out_detail whereCheckOutId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Check_out_detail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Check_out_detail whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Check_out_detail whereQuantity($value)
 * @mixin \Eloquent
 */
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

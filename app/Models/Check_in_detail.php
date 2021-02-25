<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Check_in_detail
 *
 * @property int $id
 * @property int $check_in_id
 * @property int $product_id
 * @property int $quantity
 * @property-read \App\Models\Check_in $check_in
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|Check_in_detail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Check_in_detail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Check_in_detail query()
 * @method static \Illuminate\Database\Eloquent\Builder|Check_in_detail whereCheckInId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Check_in_detail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Check_in_detail whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Check_in_detail whereQuantity($value)
 * @mixin \Eloquent
 */
class Check_in_detail extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function check_in()
    {
        return $this->belongsTo(Check_in::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

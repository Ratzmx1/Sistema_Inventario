<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property int $subcategory_id
 * @property int $stock
 * @property string $marca
 * @property int $stock_min
 * @property string $status
 * @property-read \App\Models\Subcategory $subcategory
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMarca($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStockMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSubcategoryId($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;
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

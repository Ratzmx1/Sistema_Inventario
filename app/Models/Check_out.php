<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Check_out
 *
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Check_out newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Check_out newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Check_out query()
 * @method static \Illuminate\Database\Eloquent\Builder|Check_out whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Check_out whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Check_out whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Check_out whereUserId($value)
 * @mixin \Eloquent
 */
class Check_out extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, "check_out_details");
    }
}

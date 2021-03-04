<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Check_in
 *
 * @property int $id
 * @property int $provider_id
 * @property int $order_number
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Check_in_detail[] $details
 * @property-read int|null $details_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\Provider $provider
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Check_in newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Check_in newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Check_in query()
 * @method static \Illuminate\Database\Eloquent\Builder|Check_in whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Check_in whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Check_in whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Check_in whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Check_in whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Check_in whereUserId($value)
 * @mixin \Eloquent
 */
class Check_in extends Model
{
    use HasFactory, SoftDeletes;

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

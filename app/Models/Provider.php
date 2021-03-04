<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Provider
 *
 * @property int $id
 * @property string $name
 * @property string $direction
 * @property int $telephone
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Check_in[] $check_ins
 * @property-read int|null $check_ins_count
 * @method static \Illuminate\Database\Eloquent\Builder|Provider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider query()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereDirection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereTelephone($value)
 * @mixin \Eloquent
 */
class Provider extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;

    public function check_ins()
    {
        return $this->hasMany(Check_in::class);
    }
}

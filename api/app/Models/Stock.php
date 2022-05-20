<?php

namespace App\Models;

use Database\Factories\StockFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Stock
 *
 * @property int $id
 * @property string $name
 * @property float $unit_price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static StockFactory factory(...$parameters)
 * @method static Builder|Stock newModelQuery()
 * @method static Builder|Stock newQuery()
 * @method static \Illuminate\Database\Query\Builder|Stock onlyTrashed()
 * @method static Builder|Stock query()
 * @method static Builder|Stock whereCreatedAt($value)
 * @method static Builder|Stock whereDeletedAt($value)
 * @method static Builder|Stock whereId($value)
 * @method static Builder|Stock whereName($value)
 * @method static Builder|Stock whereUnitPrice($value)
 * @method static Builder|Stock whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Stock withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Stock withoutTrashed()
 * @mixin Eloquent
 */
class Stock extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'stocks';
    /**
     * @var string
     */
    protected $primaryKey = 'id';

}

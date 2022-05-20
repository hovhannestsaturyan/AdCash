<?php

namespace App\Models;

use Database\Factories\ClientFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Client
 *
 * @property int $id
 * @property string $name
 * @property string $cash_balance
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static ClientFactory factory(...$parameters)
 * @method static Builder|Client newModelQuery()
 * @method static Builder|Client newQuery()
 * @method static \Illuminate\Database\Query\Builder|Client onlyTrashed()
 * @method static Builder|Client query()
 * @method static Builder|Client whereCashBalance($value)
 * @method static Builder|Client whereCreatedAt($value)
 * @method static Builder|Client whereDeletedAt($value)
 * @method static Builder|Client whereId($value)
 * @method static Builder|Client whereName($value)
 * @method static Builder|Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Client withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Client withoutTrashed()
 * @mixin Eloquent
 */
class Client extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'clients';
    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $attributes = [
        'cash_balance' => 1000,
        'currency' => '€',
    ];

    /**
     * @return BelongsToMany
     */
    public function purchases(): BelongsToMany
    {
        return $this->belongsToMany(Stock::class, 'purchase_stocks', 'client_id', 'stock_id')->withPivot('value', 'purchase_price');
    }
}

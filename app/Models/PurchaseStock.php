<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\PurchaseStock
 *
 * @property int $id
 * @property int $stock_id
 * @property int $client_id
 * @property int $value
 * @property float $purchase_price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|PurchaseStock newModelQuery()
 * @method static Builder|PurchaseStock newQuery()
 * @method static Builder|PurchaseStock query()
 * @method static Builder|PurchaseStock whereClientId($value)
 * @method static Builder|PurchaseStock whereCreatedAt($value)
 * @method static Builder|PurchaseStock whereDeletedAt($value)
 * @method static Builder|PurchaseStock whereId($value)
 * @method static Builder|PurchaseStock wherePurchasePrice($value)
 * @method static Builder|PurchaseStock whereStockId($value)
 * @method static Builder|PurchaseStock whereUpdatedAt($value)
 * @method static Builder|PurchaseStock whereValue($value)
 * @mixin Eloquent
 */
class PurchaseStock extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'purchase_stocks';
    /**
     * @var string
     */
    protected $primaryKey = 'id';

}

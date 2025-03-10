<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class WarehouseStock extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'warehouse_stocks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'warehouse_id',
        'product_id',

        'quantity',
        'cost',
        'production_date',
        'expiration_date',
        'notes',
        'createable_type',
        'createable_id',
    ];

    public $timestamps = true;




    public function createable(): MorphTo
    {
        return $this->morphTo();
    }

        
    // Relationship to get the parent product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    public function movements()
    {
        return $this->hasMany(WarehouseStockMovement::class, 'warehouse_stock_id');
    }

    public function scopeofWarehouse($query, $warehouse)
    {
        return $query->where('warehouse_id', $warehouse);
    }

}

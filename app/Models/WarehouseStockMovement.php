<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class WarehouseStockMovement extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'warehouse_stock_movements';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'warehouse_stock_id',

        'type',
        'date',
        'quantity',
        'notes',
        'createable_type',
        'createable_id',
    ];

    public $timestamps = true;




    public function createable(): MorphTo
    {
        return $this->morphTo();
    }

    public function warehouseStock()
    {
        return $this->belongsTo(WarehouseStock::class, 'warehouse_stock_id');
    }
}

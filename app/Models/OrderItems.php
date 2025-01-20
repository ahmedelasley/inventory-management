<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'warehouse_stock_id',

        'quantity_request',
        'quantity_available',
        'cost',
        'notes',
    ];

    public $timestamps = true;

        // Relationship to get the parent purchase
        public function order()
        {
            return $this->belongsTo(Order::class, 'order_id');
        }
    
        
        // Relationship to get the parent product
        public function stock()
        {
            return $this->belongsTo(WarehouseStock::class, 'warehouse_stock_id');
        }
}

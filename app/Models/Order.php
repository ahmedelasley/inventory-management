<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kitchen_id',
        'warehouse_id',

        'code',
        'items',
        'quantities',
        'subtotal',
        'tax',

        'request_date',
        'response_date',
        
        'type',
        'status',
        'notes',

        'createable_type',
        'createable_id',

        'updateable_type',
        'updateable_id',

    ];

    public $timestamps = true;
    

    // Relationship to get the kitchen
    public function kitchen()
    {
        return $this->belongsTo(Kitchen::class, 'kitchen_id');
    }

    // Relationship to get the warehouse
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    // Relationship to get the products
    public function products(): HasMany
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }

    /**
     * Get the parent createable model (Admin or User or Keeper).
     */

     public function createable(): MorphTo
     {
         return $this->morphTo();
     }

    /**
     * Get the parent createable model (Admin or User or Keeper).
     */

     public function updateable(): MorphTo
     {
         return $this->morphTo();
     }

     public function movements()
     {
         return $this->hasMany(OrderStatus::class, 'order_id');
     }
     public function scopeofKitchen($query, $kitchen)
     {
         return $query->where('kitchen_id', $kitchen);
     }
}

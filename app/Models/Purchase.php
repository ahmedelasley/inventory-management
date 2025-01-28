<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purchase extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'purchases';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'warehouse_id',
        'supplier_id',

        'code',
        'invoice_number',
        'items',
        'quantities',
        'subtotal',
        'tax',
        'additional_cost',
        'invoice_date',
        'business_date',
        'status',
        'notes',

        'createable_type',
        'createable_id',

        'updateable_type',
        'updateable_id',

    ];

    public $timestamps = true;
    

    // Relationship to get the warehouse
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }


    // Relationship to get the supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }


    // Relationship to get the products
    public function products(): HasMany
    {
        return $this->hasMany(PurchaseItems::class, 'purchase_id');
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
  
    public function scopeofWarehouse($query, $warehouse)
    {
        return $query->where('warehouse_id', $warehouse);
    }

    // // Relationship to get the parent category
    // public function creator()
    // {
    //     return $this->belongsTo(Admin::class, 'created_id');
    // }

    // // Relationship to get the parent category
    // public function updater()
    // {
    //     return $this->belongsTo(Admin::class, 'updated_id');
    // }

    // // Relationship to get the parent category
    // public function keeper()
    // {
    //     return $this->belongsTo(Keeper::class, 'keeper_id');
    // }
}

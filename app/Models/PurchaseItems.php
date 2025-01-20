<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItems extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'purchase_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'purchase_id',
        'product_id',

        'quantity',
        'cost',
        'production_date',
        'expiration_date',
        'notes',
    ];

    public $timestamps = true;
    
    protected $casts = [
        'production_date' => 'date:Y-m-d',
        'expiration_date' => 'date:Y-m-d',
    ];

    // Relationship to get the parent purchase
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

    
    // Relationship to get the parent product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

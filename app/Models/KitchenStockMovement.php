<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class KitchenStockMovement extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kitchen_stock_movements';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kitchen_stock_id',

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

    public function kitchenStock()
    {
        return $this->belongsTo(KitchenStock::class, 'kitchen_stock_id');
    }
}

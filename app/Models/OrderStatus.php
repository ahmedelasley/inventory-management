<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class OrderStatus extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_statuses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'old_status',
        'new_status',
        'date',
    ];

    public $timestamps = true;

    public function statusable(): MorphTo
    {
        return $this->morphTo();
    }
    
    // Relationship to get the parent purchase
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    
}

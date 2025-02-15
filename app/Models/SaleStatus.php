<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SaleStatus extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sale_statuses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sale_id',
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
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }
}

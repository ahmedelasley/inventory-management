<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItems extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sale_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sale_id',
        'menu_id',

        'quantity',
        'cost',
        'notes',
    ];

    public $timestamps = true;

    // Relationship to get the parent purchase
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }

    
    // Relationship to get the parent product
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}

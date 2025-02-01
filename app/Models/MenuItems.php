<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{
    use HasFactory;
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu_items';

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'menu_id',
        'product_id',
        'quantity',
        'createable_type',
        'createable_id',

        'updateable_type',
        'updateable_id',
    ];
    public $timestamps = true;
    
   /**
    * Get the parent creator model (Admin or User or Keeper).
    */
    public function creator(): MorphTo
    {
        return $this->morphTo();
    }

    /**
    * Get the parent editor model (Admin or User or Keeper).
    */
    public function editor(): MorphTo
    {
        return $this->morphTo();
    }

    
    // Relationship to get the menu
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }


    
    // Relationship to get the product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}

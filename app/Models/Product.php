<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'name_localized',
        'sku',
        'description',
        'storge_unit',
        'intgredtiant_unit',
        'storage_to_intgredient',
        'costing_method',
        'category_id',
        'created_id',
        'updated_id',
    ];
    public $timestamps = true;
    

    // Relationship to get the parent category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relationship to get the parent category
    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_id');
    }

    // Relationship to get the parent category
    public function updater()
    {
        return $this->belongsTo(Admin::class, 'updated_id');
    }

    
    // Relationship to get the parent category
    public function warehouseStocks()
    {
        return $this->hasMany(WarehouseStock::class, 'product_id');
    }

    // علاقة المنتج إلى KitchenStock (كل منتج يمكن أن يكون له عدة سجلات في المخزون)
    public function kitchenStocks()
    {
        return $this->hasMany(KitchenStock::class);
    }

    // علاقة المنتج إلى MenuItems (كل منتج يمكن أن يكون له عدة سجلات في القائمة)
    public function menuItems()
    {
        return $this->hasMany(MenuItems::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Scopes\MenuTypeScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([MenuTypeScope::class])]
class Menu extends Model
{
    use HasFactory;

    /**
     * اسم الجدول المرتبط بالموديل
     */
    protected $table = 'menus';

    /**
     * الحقول القابلة للتعبئة
     */
    protected $fillable = [
        'restaurant_id',
        'kitchen_id',
        'sku',
        'name',
        'description',
        'price',
        'cost',
        'tax',
        'barcode',
        'calories',
        'preparation_time',
        'walking_minutes_to_burn_calories',
        'is_high_salt',
        'image',
        'name_localized',
        'description_localized',
        'is_active',
        'category_id',

        'createable_type',
        'createable_id',
        'updateable_type',
        'updateable_id',
    ];

    public $timestamps = true;

    /**
     * العلاقة مع المنشئ (Admin أو User أو Keeper)
     */
    public function creator(): MorphTo
    {
        return $this->morphTo('createable');
    }

    /**
     * العلاقة مع المعدّل (Admin أو User أو Keeper)
     */
    public function editor(): MorphTo
    {
        return $this->morphTo('updateable');
    }

    /**
     * العلاقة مع الفئة (التصنيف)
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * العلاقة مع المطعم الذي ينتمي إليه العنصر
     */
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

        /**
     * العلاقة مع المطبخ الذي ينتمي إليه العنصر
     */
    public function kitchen()
    {
        return $this->belongsTo(Kitchen::class, 'kitchen_id');
    }

    // Relationship to get the products
    public function items(): HasMany
    {
        return $this->hasMany(MenuItems::class, 'menu_id');
    }
}

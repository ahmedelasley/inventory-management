<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Sale extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sales';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'restaurant_id',
        'client_id',

        'code',
        'items',
        'quantities',
        'subtotal',
        'tax',

        'request_date',
        'response_date',
        
        'type',
        'status',
        'date',
        'notes',

        'createable_type',
        'createable_id',

        'updateable_type',
        'updateable_id',

    ];

    public $timestamps = true;
    

    // Relationship to get the restaurant
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

    // Relationship to get the client
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    // Relationship to get the products
    public function products(): HasMany
    {
        return $this->hasMany(SaleItems::class, 'sale_id');
    }

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

    public function movements()
    {
        return $this->hasMany(SaleStatus::class, 'sale_id');
    }

    public function scopeofRestaurant($query, $restaurant)
    {
        return $query->where('restaurant_id', $restaurant);
    }

    public function scopeofClient($query, $client)
    {
        return $query->where('client_id', $client);
    }

}

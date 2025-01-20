<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Warehouse extends Model
{

    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'warehouses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'location',
        'keeper_id',
        'created_id',
        'updated_id',
    ];

    public $timestamps = true;
    
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
    public function keeper()
    {
        return $this->belongsTo(Keeper::class, 'keeper_id');
    }

    // Relationship to get child stocks
    public function stocks()
    {
        return $this->hasMany(WarehouseStock::class, 'warehouse_id');
    }

    
    // Relationship to get child categories

}

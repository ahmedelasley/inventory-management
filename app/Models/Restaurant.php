<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'restaurants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'location',
        'user_id',
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
    public function editor()
    {
        return $this->belongsTo(Admin::class, 'updated_id');
    }

    // Relationship to get the parent category
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship to get the kitchen
    public function kitchens()
    {
        return $this->hasMany(Kitchen::class);
    }

    
    // Relationship to get the warehouse
    public function warehouses()
    {
        return $this->hasMany(Warehouse::class);
    }

}

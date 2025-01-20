<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kitchen extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kitchens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'location',
        'supervisor_id',
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
    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_id');
    }

    // Relationship to get child stocks
    public function stocks()
    {
        return $this->hasMany(KitchenStock::class, 'kitchen_id');
    }

}

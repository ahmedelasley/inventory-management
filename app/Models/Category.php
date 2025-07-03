<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'type',
        'is_default',
        'created_id',
        'updated_id',
        'created_at',
        'updated_at',
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
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Relationship to get child categories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

}

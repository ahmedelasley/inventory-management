<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clients';

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'phone',
        'email',
        'address',
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
}

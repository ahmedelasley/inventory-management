<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'created_id',
        'updated_id',
    ];


    public function scopeType($query, $value)
    {
        return $query->where('type', $value);
    }
    
}

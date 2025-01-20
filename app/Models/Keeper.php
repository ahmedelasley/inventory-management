<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\KeeperResetPassword;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Keeper extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;


    public function sendPasswordResetNotification($token) {
        $this->notify(new KeeperResetPassword($token));
        
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'created_id',
        'updated_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /*
     * ACCESSORS & MUTATORS
    */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                if ($value != null) {
                    return bcrypt($value);
                }
            }
        );
    }

    // Relationship to get the creator
    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_id');
    }

    // Relationship to get the updater
    public function updater()
    {
        return $this->belongsTo(Admin::class, 'updated_id');
    }

    // Relationship to get the warehouse
    public function warehouse()
    {
        return $this->hasOne(Warehouse::class);
    }

    /**
     * Get all of the post's purchases.
     */
    public function purchases(): MorphMany
    {
        return $this->morphMany(Purchase::class, 'createable');
    }
}

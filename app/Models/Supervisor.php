<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\SupervisorResetPassword;
use Spatie\Permission\Traits\HasRoles;

class Supervisor extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;


    public function sendPasswordResetNotification($token) {
        $this->notify(new SupervisorResetPassword($token));
        
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

    // Relationship to get the parent creator
    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_id');
    }

    // Relationship to get the updater
    public function updater()
    {
        return $this->belongsTo(Admin::class, 'updated_id');
    }

    // Relationship to get the kitchen
    public function kitchen()
    {
        return $this->hasOne(Kitchen::class);
    }

}

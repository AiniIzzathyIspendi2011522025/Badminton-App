<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function thisAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user is an owner.
     *
     * @return bool
     */
    public function thisOwner()
    {
        return $this->role === 'owner';
    }

    /**
     * Check if the user is a customer.
     *
     * @return bool
     */
    public function thisCustomer()
    {
        return $this->role === 'customer';
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }
    public function pointTransactions()
    {
        return $this->hasMany(PointTransaction::class);
    }
    public function pointBalance()
    {
        return $this->hasOne(PointBalance::class);
    }
}

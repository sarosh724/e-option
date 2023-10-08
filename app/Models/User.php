<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'country',
        'demo_account_balance'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'google_id',
        'is_admin',
        'deleted_at',
        'is_restricted'
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

    protected function accountBalance(): Attribute
    {
        return Attribute::make(
            get: fn($value) => round($value, 2),
            set: fn($value) => round($value, 2),
        );
    }

    public function trades()
    {
        return $this->hasMany(Trade::class, "user_id");
    }

    public function countDeposit(): int
    {
        return $this->hasMany(Deposit::class, "user_id")
            ->where("status", "approved")
            ->count();
    }

    public function countWithdraw(): int
    {
        return $this->hasMany(Withdraw::class, "user_id")
            ->where("status", "approved")
            ->count();
    }

    public function countTrades(): int
    {
        return $this->hasMany(Trade::class, "user_id")
            ->count();
    }

    public function countReferral(): int
    {
        return $this->hasMany(Referral::class, "referred_by")->count();
    }
}

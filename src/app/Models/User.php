<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
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
        'image',
        'post_code',
        'address',
        'building',
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

    public function soldItem()
    {
        return $this->belongsToMany(Item::class, Order::class);
    }
    public function buyerTradingItem()
    {
        return $this->belongsToMany(Item::class, Order::class)->where('is_completed', false);
    }
    public function sellerTradingItem()
    {
        return $this->hasMany(Item::class)->whereHas('order', function ($query) {
            $query->where('is_completed', false);
        });
    }
    public function ratingAverage()
    {
        // 売り手の評価と買い手の評価を平均して返す
        return $this->hasManyThrough(Order::class, Item::class)
            ->where('is_completed', true)->pluck('seller_rating')->merge(
                $this->hasMany(Order::class)
                    ->where('is_completed', true)->pluck('buyer_rating')
            )->avg();
    }
}

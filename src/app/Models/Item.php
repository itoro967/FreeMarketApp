<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image', 'brand', 'price', 'description', 'condition', 'user_id'];

    public function scopeSearch(Builder $query, $name, $tab)
    {
        if (Auth::check()) {
            $query->where('user_id', '<>', Auth::user()->id);
        };

        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }
        if ($tab == 'mylist') {
            $query->whereRelation(
                'favorites',
                'user_id',
                Auth::user()->id
            );
        }
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'item_categories')->withTimestamps();
    }
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }
    public function isFavorite($user_id)
    {
        return $this->favorites()->where('user_id', $user_id)->exists();
    }
    public function favorite($user_id)
    {
        if ($this->isFavorite($user_id)) {
            $this->favorites()->detach($user_id);
            return "お気に入りを解除しました";
        } else {
            $this->favorites()->attach($user_id);
            return "お気に入りを登録しました";
        }
    }
    public function order()
    {
        return $this->hasOne(Order::class);
    }
    public function isSold()
    {
        return $this->order()->exists();
    }
    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function buyer()
    {
        return $this->hasOneThrough(User::class, Order::class,'item_id', 'id', 'id', 'user_id');
    }
}

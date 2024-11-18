<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;

class Item extends Model
{
    use HasFactory;

    public function scopeSearch(Builder $query, $name)
    {
        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }
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
        } else {
            $this->favorites()->attach($user_id);
        }
    }
}

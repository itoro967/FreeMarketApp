<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_id',
        'message',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function images()
    {
        return $this->hasMany(TradeMessageImage::class);
    }
}

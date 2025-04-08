<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',
        'user_id',
        'payment',
        'post_code',
        'address',
        'building',
        'seller_rating',
        'buyer_rating',
        'is_completed'
    ];
    public function tradingMessages()
    {
        return $this->hasMany(TradeMessage::class);
    }
    public function unreadMessageCounts($user_id)
    {
        // 取引メッセージの中で、相手からの未読メッセージをカウント
        return $this->tradingMessages()->where('user_id', '!=', $user_id)->where('is_read', false)->count();
    }
    public function readMessage($user_id)
    {
        // 取引メッセージの中で、相手からの未読メッセージを全て既読にする
        $this->tradingMessages()->where('user_id', '!=', $user_id)->update(['is_read' => true]);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}

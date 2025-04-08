<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeMessageImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'trade_message_id',
        'image_path',
    ];
}

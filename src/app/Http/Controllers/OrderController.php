<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TradeCompleted;
class OrderController extends Controller
{
    public function editAddress($item_id)
    {
        return view('auth.editAddress', compact('item_id'));
    }

    public function sold(PurchaseRequest $request)
    {
        $param = $request->only(['item_id', 'payment', 'post_code', 'address', 'building']);
        $param['user_id'] = Auth::user()->id;
        Order::create($param);
        return redirect()->route('tradingMessage.chat', ['item_id' => $param['item_id']])
                ->with('message', '購入が完了しました');
    }
    public function complete(Request $request)
    {
        $order = Order::find($request->input('order_id'));
        if ($order->user_id == Auth::user()->id) {
            // 自身が売り手の場合
            // 売り手の評価を更新
            $order->update(['seller_rating' => $request->input('rating')]);
            $item = $order->item;
            $item->seller->notify(new TradeCompleted($item, $item->buyer->name));
        }
        else {
            // 買い手の評価を更新
            $order->update(['buyer_rating' => $request->input('rating'),
                'is_completed' => true]);
        }
        return redirect('/')->with('message', '取引が完了しました');
    }
}

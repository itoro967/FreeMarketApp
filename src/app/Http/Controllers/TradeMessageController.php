<?php

namespace App\Http\Controllers;

use App\Http\Requests\TradingMessageRequest;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\TradeMessage;
use Illuminate\Support\Facades\Storage;

class TradeMessageController extends Controller
{
    private function checkUser(Item $item, User $user)
    {
        // 購入者と出品者の判定及びその他ユーザーの判定
        if ($item->seller->id == $user->id) {
            $user_type = 'seller';
        } else if ($item->buyer->id == $user->id) {
            $user_type = 'buyer';
        } else {
            $user_type = 'other';
        }
        return $user_type;
    }
    public function chat(Request $request, $item_id)
    {
        $item = Item::find($item_id);
        $user = Auth::user();
        $user_type = $this->checkUser($item, $user);
        if ($user_type == 'other') {
            // 購入者でも出品者でもない場合は403エラーを返す
            return abort(403);
        }
        $to_user = $user_type == 'buyer' ? $item->seller : $item->buyer;
        // 取引中アイテムを新着メッセージ順でソート 既読未読は考慮しない
        $others_items = Auth::user()->buyerTradingItem
            ->merge(Auth::user()->sellerTradingItem)
            ->where('id', '!=', $item->id)->sortByDesc(function ($item) {
                return $item->order->tradingMessages->last();
            });
        // 取引メッセージの未読を既読にする
        $item->order->readMessage($user->id);
        return view('tradingmessage', compact('item', 'user_type', 'to_user', 'others_items'));
    }
    public function store(TradingMessageRequest $request)
    {

        $data = $request->only(['message', 'order_id']);
        $tradeMessage = TradeMessage::create([
            'order_id' => $data['order_id'],
            'message' => $data['message'],
            'user_id' => Auth::id(),
        ]);
        if ($request->file('image')) {
            // 画像の保存
            $imagePath = $request->file('image')->store('public/message');
            $tradeMessage->images()->create(['image_path' => $imagePath]);
        }
        return redirect()->back()->with('message', 'メッセージを送信しました');
    }
    public function destroy()
    {
        $id = request()->input('message_id');
        $message = TradeMessage::find($id);
        if ($message->user_id == Auth::id()) {
            // 画像の削除
            foreach ($message->images as $image) {
                Storage::delete($image->image_path);
                $image->delete();
            }
            $message->delete();
            return redirect()->back()->with('message', 'メッセージを削除しました');
        } else {
            return redirect()->back()->with('message', 'メッセージの削除に失敗しました');
        }
    }
    public function correct(TradingMessageRequest $request)
    {
        $id = $request->input('message_id');
        $message = $request->input('message');
        TradeMessage::find($id)->update(['message' => $message]);
        return redirect()->back()->with('message', 'メッセージを修正しました');
    }
    
}

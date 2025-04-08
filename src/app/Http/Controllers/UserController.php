<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AddressRequest;
use App\Models\Item;

class UserController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function editProfile()
    {
        return view('auth.editProfile');
    }

    public function mypage(Request $request)
    {
        $user = Auth::user();
        $tab = $request->input('tab');
        $base_url = $tab == 'trading' ? '/trading/' : '/';

        // 取引中アイテムを新着メッセージ順でソート 既読未読は考慮しない
        $trading_items = $user->buyerTradingItem->merge($user->sellerTradingItem)
            ->sortByDesc(function ($item) {
                return $item->order->tradingMessages->last();
            });

        if ($tab == 'buy' or $tab == null) {
            $items = $user->soldItem;
        } else if ($tab == 'sell') {
            $items = Item::where('user_id', $user->id)->get();
        } else if ($tab == 'trading') {
            $items = $trading_items;
        }
        // 取引メッセージの合計を取得
        $sum_unread_messages = 0;
        foreach ($trading_items as $item) {
            $sum_unread_messages += $item->order->unreadMessageCounts($user->id);
        }
        return view('mypage', compact('base_url','items', 'sum_unread_messages'));
    }

    public function changeProfile(AddressRequest $request)
    {
        $user = Auth::user();
        $newProfile = $request->input();
        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('public/user');
            $newProfile['image'] = $imagePath;
            // 過去プロフィール画像を削除
            if ($user->image = ! Null)
                Storage::delete($user->image);
        }
        $user->update($newProfile);
        return redirect('/mypage/profile')->with('message', 'プロフィールを更新しました');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function editAddress($item_id)
    {
        return view('auth.editAddress', compact('item_id'));
    }

    public function sold(Request $request)
    {
        $param = $request->only(['item_id', 'payment', 'post_code', 'address', 'building']);
        $param['user_id'] = Auth::user()->id;
        Order::create($param);
        return redirect('/')->with('message', '購入が完了しました');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Item;

class FavoriteController extends Controller
{
    public function favorite(Request $request)
    {
        $data = $request->all();
        $user_id = Auth::user()->id;
        $result = Item::find($data['item_id'])->favorite($user_id);
        return redirect('/item/' . $data['item_id'])->with('message', $result);
    }
}

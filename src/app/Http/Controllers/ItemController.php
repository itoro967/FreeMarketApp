<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Comment;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('search');
        $tab = $request->input('tab');
        $items = Item::search($name, $tab)->select('id', 'image', 'name')->get();
        return view('index', compact('items'));
    }

    public function detail($item_id)
    {
        $item = Item::find($item_id);
        $comments = Comment::where('item_id', $item_id)->get();
        return view('detail', compact('item', 'comments'));
    }

    public function addComment(Request $request)
    {
        $data = $request->all();
        $user_id = Auth::user()->id;
        Comment::create(['user_id' => $user_id, 'item_id' => $data['item_id'], 'content' => $data['comment']]);
        return redirect('/item/' . $data['item_id']);
    }
    public function favorite(Request $request)
    {
        $data = $request->all();
        $user_id = Auth::user()->id;
        $result = Item::find($data['item_id'])->favorite($user_id);

        return redirect('/item/' . $data['item_id'])->with('message', $result);
    }
    public function purchase($item_id)
    {
        $item = Item::find($item_id);
        return view('purchase', compact('item'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Comment;
use App\Models\Category;

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
        $categories = $item->categories->pluck('content');
        $comments = Comment::where('item_id', $item_id)->get();
        return view('detail', compact('item', 'categories', 'comments'));
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
    public function sell()
    {
        $categories = Category::all();
        return view('sell', compact('categories'));
    }
    public function store(Request $request)
    {
        $param = $request->only('name', 'condition', 'description', 'price');
        $category_id_list = $request->only('categories');
        // TODO phpはデフォルトでアップロードファイルサイズ2M?後でphp.ini修正
        $image = $request->file('image')->store('public/item');
        $param += compact('image');
        $item = Item::create($param);
        $item->categories()->attach($category_id_list['categories']);
    }
}

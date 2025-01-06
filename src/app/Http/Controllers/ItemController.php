<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Comment;
use App\Models\Category;
use App\Http\Requests\ExhibitionRequest;
use App\Http\Requests\PurchaseRequest;
use Illuminate\Support\Facades\Auth;

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
    public function purchase(PurchaseRequest $request, $item_id)
    {
        #配送先変更時のデータ保持
        $request->flash();

        $param = $request->only(['post_code', 'address', 'building']);
        if (!$param) {
            $param = [
                'post_code' => Auth::user()->post_code,
                'address' => Auth::user()->address,
                'building' => Auth::user()->building
            ];
        }
        $item = Item::find($item_id);
        return view('purchase', compact('item'), $param);
    }
    public function sell()
    {
        $categories = Category::all();
        return view('sell', compact('categories'));
    }

    public function store(ExhibitionRequest $request)
    {
        $param = $request->only('item_name', 'brand', 'condition', 'description', 'price');
        $param['user_id'] = Auth::user()->id;
        $param['name'] = $param['item_name'];
        unset($param['item_name']);
        $category_id_list = $request->only('categories');
        $image = $request->file('image')->store('public/item');
        $param += compact('image');
        $item = Item::create($param);
        $item->categories()->attach($category_id_list['categories']);
        return redirect('/')->with('message', '出品が完了しました');
    }
}

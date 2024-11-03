<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function detail($item_id)
    {
        return view('detail', ['item_name' => $item_id]);
    }
}

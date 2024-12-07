<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function addComment(CommentRequest $request)
    {
        $data = $request->all();
        $user_id = Auth::user()->id;
        Comment::create(['user_id' => $user_id, 'item_id' => $data['item_id'], 'content' => $data['comment']]);
        return redirect('/item/' . $data['item_id']);
    }
}

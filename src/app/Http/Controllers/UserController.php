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
        $tab = $request->input('tab');
        $items = Item::where('user_id', Auth::user()->id)->get();
        return view('mypage', compact('items'));
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
        return view('auth.editProfile');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

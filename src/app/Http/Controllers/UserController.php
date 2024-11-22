<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function mypage()
    {
        return view('mypage');
    }

    public function changeProfile(Request $request)
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

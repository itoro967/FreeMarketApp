@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('main')
<div class="profile">
  <img src="{{Storage::url(Auth::user()->image)}}" class="profile-image">
  <a class="profile-name">{{Auth::user()->name}}</a>
  <a class="edit-profile" href="/mypage/profile">プロフィール変更</a>
</div>
<div class="main__tab">
  <a class="tab-recommend" href="">購入した商品</a>
  <a class="tab-mylist" href="">出品した商品</a>
</div>
@endsection
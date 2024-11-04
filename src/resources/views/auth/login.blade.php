@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/authcommon.css') }}">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('main')
<div class="main__inner">
  <div class="title">ログイン</div>
  <form class="form" action="">
    <label for="name" class="label">ユーザー名</label>
    <input type="text" class="input" name="name" id="name">
    <label for="email" class="label">メールアドレス</label>
    <input type="email" class="input" name="email" id="email">
    <input type="submit" class="submit-button" value="ログインする">
  </form>
  <a href="/register" class="link">会員登録はこちら</a>
</div>
@endsection
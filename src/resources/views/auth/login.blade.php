@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/authcommon.css') }}">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('main')
<div class="main__inner">
  <div class="title">ログイン</div>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form class="form" action="/login" method="post">
    @csrf
    <label for="email" class="label">メールアドレス</label>
    <input type="email" class="input" name="email" id="email" value="{{old('email')}}">
    <label for="pass" class="label">パスワード</label>
    <input type="password" class="input" name="password" id="pass">
    <input type="submit" class="submit-button" value="ログインする">
  </form>
  <a href="/register" class="link">会員登録はこちら</a>
</div>
@endsection
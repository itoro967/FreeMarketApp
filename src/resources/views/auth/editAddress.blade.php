@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/authcommon.css') }}">
@endsection

@section('main')
<div class="main__inner">
  <div class="title">住所変更</div>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form class="form" action="/purchase/{{$item_id}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label for="post_code" class="label">郵便番号</label>
    <input type="text" class="input" name="post_code" id="post_code" value="{{Auth::user()->post_code}}">
    <label for="address" class="label">住所</label>
    <input type="text" class="input" name="address" id="address" value="{{Auth::user()->address}}">
    <label for="building" class="label">建物名</label>
    <input type="text" class="input" name="building" id="building" value="{{{Auth::user()->building}}}">
    <input type="submit" class="submit-button" value="更新する">
  </form>
  @endsection
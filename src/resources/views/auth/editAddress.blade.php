@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/authcommon.css') }}">
@endsection

@section('main')
<div class="main__inner">
  <div class="title">住所変更</div>
  <form class="form" action="/purchase/{{$item_id}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label for="post_code" class="label">郵便番号</label>
    <x-error name="post_code" />
    <input type="text" class="input" name="post_code" id="post_code" value="{{old('post_code',Auth::user()->post_code)}}">
    <label for="address" class="label">住所</label>
    <x-error name="address" />
    <input type="text" class="input" name="address" id="address" value="{{old('address',Auth::user()->address)}}">
    <label for="building" class="label">建物名</label>
    <x-error name="building" />
    <input type="text" class="input" name="building" id="building" value="{{old('building',Auth::user()->building)}}">
    <input type="submit" class="submit-button" value="更新する">
  </form>
</div>
@endsection
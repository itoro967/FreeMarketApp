@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/authcommon.css') }}">
<link rel="stylesheet" href="{{ asset('css/editProfile.css') }}">
@endsection

@section('main')
<div class="main__inner">
  <div class="title">プロフィール設定</div>
  <form class="form" action="/mypage/profile" method="post" enctype="multipart/form-data">
    @csrf
    <div class="plofile-image">
      <img class="image" src="{{Storage::url(Auth::user()->image)}}" onerror=this.src="{{asset('img/userImage.svg')}}"></img>
      <label for="image" class="image-label">画像を選択する</label>
      <input type="file" name="image" id="image" class="image-select-button" onchange="previewImage(this)"></input>
    </div>
    <label for="name" class="label">ユーザー名</label>
    <x-error name="name" />
    <input type="text" class="input" name="name" id="name" value="{{old('name',Auth::user()->name)}}">
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

<script>
  function previewImage(obj) {
    let file = obj.files[0];
    let fr = new FileReader();
    let image = document.getElementsByClassName('image')[0];
    fr.onload = function() {
      image.src = fr.result;
    }
    fr.readAsDataURL(file);
  }
</script>

@endsection
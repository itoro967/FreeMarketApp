@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/authcommon.css') }}">
<link rel="stylesheet" href="{{ asset('css/editProfile.css') }}">
@endsection

@section('main')
<div class="main__inner">
  <div class="title">プロフィール設定</div>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form class="form" action="/mypage/profile" method="post" enctype="multipart/form-data">
    @csrf
    <div class="plofile-image">
      <img class="image" @if(Auth::user()->image) src="{{Storage::url(Auth::user()->image)}}" @endif alt=""></img>
      <label for="image" class="image-label">画像を選択する</label>
      <input type="file" name="image" id="image" class="image-select-button" onchange="previewImage(this)"></input>
    </div>
    <label for="name" class="label">ユーザー名</label>
    <input type="text" class="input" name="name" id="name" value="{{Auth::user()->name}}">
    <label for="post_code" class="label">郵便番号</label>
    <input type="text" class="input" name="post_code" id="post_code" value="{{Auth::user()->post_code}}">
    <label for="address" class="label">住所</label>
    <input type="text" class="input" name="address" id="address" value="{{Auth::user()->address}}">
    <label for="building" class="label">建物名</label>
    <input type="text" class="input" name="building" id="building" value="{{{Auth::user()->building}}}">
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
@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('main')
<form class="main__inner" action="/sell" method="post" enctype="multipart/form-data">
  @csrf
  <div class="title">商品の出品</div>
  <div class="item-image">
    <div class="item-image__title">商品画像</div>
    <x-error name="image" />
    <div class="item-image__content">
      <img class="image">
      <label for="image" class="select-image-button">画像を選択する</label>
      <input type="file" name="image" id="image" class="image-select-button" onchange="previewImage(this)" value="old('image')">
    </div>
  </div>
  <div class="item-detail">商品の詳細</div>
  <div class="item-category">
    <div class="item-category__title">カテゴリー</div>
    <x-error name="categories" />
    <div class="item-category__content">
      @foreach($categories as $category)
      <label class="categories"><input type="checkbox" name="categories[]" value="{{$category->id}}"
          class="category-checkbox" @checked(in_array($category->id,old('categories',[])))>{{$category->content}}</label>
      @endforeach
    </div>
  </div>
  <div class="item-condition">
    <div class="item-condition__title">商品の状態</div>
    <x-error name="condition" />
    <select name="condition" class="item-condition__select">
      <option value="良好">良好</option>
      <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
      <option value="やや傷や汚れあり">やや傷や汚れあり</option>
      <option value="状態が悪い">状態が悪い</option>
    </select>
  </div>
  <div class="item-name-description">商品名と説明</div>
  <div class="item-name">
    <div class="item-name__title">商品名</div>
    <x-error name="item_name" />
    <input type="text" name="item_name" class="item-name__input" value="{{old('item_name')}}">
  </div>
  <div class="item-brand">
    <div class="item-brand__title">ブランド名</div>
    <input type="text" name="brand" class="item-brand__input" value="{{old('brand')}}">
  </div>
  <div class="item-description">
    <div class="item-description__title">商品の説明</div>
    <x-error name="description" />
    <textarea name="description" class="item-description__input">{{old('description')}}</textarea>
  </div>
  <div class="item-price">
    <div class="item-price__title">販売価格</div>
    <x-error name="price" />
    <div class="item-price__input-box">
      \<input type="number" name="price" class="item-price__input" min="0" value="{{old('price')}}">
    </div>

    </input>
    <button type=" submit" class="button">出品する</button>
</form>
<script>
  function previewImage(obj) {
    let file = obj.files[0];
    let fr = new FileReader();
    let image = document.getElementsByClassName('image')[0];
    fr.onload = function() {
      image.src = fr.result;
      image.style.display = "block";
    }
    fr.readAsDataURL(file);
  }
</script>
@endsection
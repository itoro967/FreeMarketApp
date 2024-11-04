@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('main')
<div class="main__inner">
  <div class="image">
    <img class="item-image" src="{{$item->image}}" alt="{{$item->name}}"></img>
  </div>
  <div class="detail">
    <div class="item-name">{{$item->name}}</div>
    <div class="item-brand">{{$item->brand}}</div>
    <div class="item-price">\<span class="price--value">{{ number_format($item->price)}}</span>(税込)</div>
    <a href="" class="button">商品手続きへ</a>
    <div class="item-description">
      <div class="description-title">商品説明</div>
      <div class="description-contents">
        {{$item->description}}
      </div>
    </div>
    <div class="item-info">
      <div class="info-title">商品の情報</div>
      <div class="category">
        <span href="" class="category-title">カテゴリー</span>
        <span href="" class="category-content">ここにカテゴリ</span>
      </div>
      <div class="condition">
        <span href="" class="condition-title">商品の状態</span>
        <span href="" class="condition-content">{{$item->condition}}</span>
      </div>

    </div>
    <div class="item-comments">
      <div class="comments-title">コメント(n)</div>
      <div class="comment">
        こちらにコメントが入ります
      </div>
      <form class="comment-form">
        <div class="comment-form__title">商品へのコメント</div>
        <textarea name="" class="comment-form__textarea">
      </textarea>
        <button type="submit" class="button">コメントを送信する</button>
      </form>
    </div>
  </div>
</div>
@endsection
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
    <span class="favorite-icon">
      <img src="{{ asset('img/star.svg') }}" alt="" class="favorite-image">
      1
    </span>
    <span class="comment-icon">
      <img src="{{ asset('img/chat.svg') }}" alt="" class="comment-image">
      {{count($comments)}}
    </span>
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
      <div class="comments-title">コメント({{count($comments)}})</div>
      @foreach($comments as $comment)
      <div class="comment">
        <div class="user">
          <img src="{{Storage::url($comment->user->image)}}" alt="" class="user-icon">
          <span class="user-name">{{$comment->user->name}}</span>
        </div>
        <div class="comment-content">{{$comment->content}}
          <div class="comment-created-at">{{$comment->created_at->diffForHumans()}}</div>
        </div>
      </div>
      @endforeach
      <form class="comment-form" action="addcomment" method="post">
        @csrf
        <div class="comment-form__title">商品へのコメント</div>
        <input type="hidden" name="item_id" value="{{$item->id}}">
        <textarea name="comment" class="comment-form__textarea"></textarea>
        <button type="submit" class="button">コメントを送信する</button>
      </form>
    </div>
  </div>
</div>
@endsection
@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('main')
<div class="image">
  <div class="item-image" src="" alt="" style="height: 600px;width:600px; background:gray"></div>
</div>
<div class="detail">
  <div class="item-name">{{$item_name}}</div>
  <div class="item-brand">ブランド名</div>
  <div class="item-price">\<span class="price--value">47,000</span>(税込)</div>
  <a href="" class="">商品手続きへ</a>
  <div class="item-description">商品説明
    <dev class="contents">
      カラー：グレー
    </dev>
  </div>
  <div class="item-info">商品の情報
  </div>
  <div class="item-comments">コメント(n)
    <div class="comment">
      こちらにコメントが入ります
    </div>
    <form class="comment-form">
      商品へのコメント
      <textarea name="" id="">
      </textarea>
      <button type="submit">コメントを送信する</button>
    </form>
  </div>
</div>
@endsection
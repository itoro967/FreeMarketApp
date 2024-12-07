@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('main')
<div class="main__inner">
  <div class="image">
    <img class="item-image" src="{{$item->image}}" alt="{{$item->name}}" onerror='this.src="{{Storage::url($item->image)}}";'></img>
  </div>
  <div class="detail">
    <div class="item-name">{{$item->name}}</div>
    <div class="item-brand">{{$item->brand}}</div>
    <div class="item-price">\<span class="price--value">{{ number_format($item->price)}}</span>(税込)</div>
    <div>
      <span class="favorite-icon">
        <form action="favorite" class="favorite-form" method="post">
          @csrf
          <input type="hidden" name="item_id" value="{{$item->id}}">
          @auth
          <button type="submit" class="favorite-submit">
            @if($item->isFavorite(Auth::user()->id))
            <img src="{{ asset('img/star-yellow.svg') }}" alt="" class="favorite-image">
            @else
            <img src="{{ asset('img/star.svg') }}" alt="" class="favorite-image">
            @endif
          </button>
          @endauth
          @guest
          <img src="{{ asset('img/star.svg') }}" alt="" class="favorite-image" onclick="favoriteAlert()">
          @endguest
        </form>
        <span>{{$item->favorites->count()}}</span>
      </span>

      <span class="comment-icon">
        <img src="{{ asset('img/chat.svg') }}" alt="" class="comment-image">
        <span>{{count($comments)}}</span>
      </span>
    </div>
    <a href="/purchase/{{$item->id}}" class="button">商品手続きへ</a>
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
        <span href="" class="category-content">
          @foreach($categories as $category)
          <span class="categories">{{$category}}</span>
          @endforeach
        </span>
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
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        @auth
        <input type="hidden" name="item_id" value="{{$item->id}}">
        <textarea name="comment" class="comment-form__textarea"></textarea>
        <button type="submit" class="button">コメントを送信する</button>
        @endauth
        @guest
        <div class="comment--guest">コメントは会員のみ投稿できます</div>
        @endguest
      </form>
    </div>
  </div>
</div>
<script>
  function favoriteAlert() {
    alert("お気に入り登録は会員のみご利用いただけます。")
  }
</script>
@endsection
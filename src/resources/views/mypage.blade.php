@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('main')
<div class="profile">
  <img src="{{Storage::url(Auth::user()->image)}}" class="profile-image" onerror=this.src="{{asset('img/userImage.svg')}}">
  <div>
    <a class="profile-name">{{Auth::user()->name}}</a>
    <div class="profile_user-rating">
      @if(Auth::user()->ratingAverage() != null)
        @foreach (range(1, 5) as $i)
        @if(round(Auth::user()->ratingAverage()) >= $i)
        <img src="{{asset('img/star-yellow.svg')}}" class="profile_user-star">
        @else
        <img src="{{asset('img/star-gray.svg')}}" class="profile_user-star">
        @endif
        @endforeach
      @endif
    </div>
  </div>
  <a class="edit-profile" href="/mypage/profile">プロフィール変更</a>
</div>
<div class="main__tab">
  <a @class(['tab-buy','tab--active'=>request()->get('tab') == 'buy' || request()->get('tab') == ''])] href="?tab=buy">購入した商品</a>
  <a @class(['tab-sell','tab--active'=>request()->get('tab') == 'sell']) href="?tab=sell">出品した商品</a>
  <a @class(['tab-trading','tab--active'=>request()->get('tab') == 'trading']) href="?tab=trading">
    取引中の商品
    @if($sum_unread_messages>0)<span class="unread">{{$sum_unread_messages}}@endif</span>
  </a>
</div>
<div class="main__items">
  @foreach($items as $item)
  <a href="{{$base_url}}item/{{$item->id}}" @class(['item','item--sold'=>($item->isSold() && request()->get('tab') != 'trading')])>
    <img class="item-image" src="{{$item->image}}" alt="{{$item->name}}" onerror='this.src="{{Storage::url($item->image)}}";'>
    {{$item->name}}
    @if(request()->get('tab') == 'trading')
    @php
    $count = $item->order->unreadMessageCounts(Auth::user()->id);
    @endphp
    @if($count > 0)
    <span class="unread unread-each">
      {{$count}}
    </span>
    @endif
    @endif
  </a>
  @endforeach
</div>
@endsection
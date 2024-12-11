@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('main')
<div class="main__tab">
  <a href="?tab=&search={{request()->query('search')}}" @class(['tab-recommend','tab--active'=>(request()->query('tab')!='mylist')])>おすすめ</a>
  @auth
  <a href="?tab=mylist&search={{request()->query('search')}}" @class(['tab-mylist','tab--active'=>(request()->query('tab')=='mylist')])>マイリスト</a>
  @endauth
</div>
<div class="main__items">
  @foreach($items as $item)
  <a href="/item/{{$item->id}}" @class(['item','item--sold'=>($item->isSold())])>
    <img class="item-image" src="{{$item->image}}" alt="{{$item->name}}" onerror='this.src="{{Storage::url($item->image)}}";'>
    {{$item->name}}
  </a>
  @endforeach
</div>
@endsection
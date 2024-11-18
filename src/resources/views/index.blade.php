@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('main')
<div class="main__tab">
  <a href="?tab=&search={{request()->query('search')}}" @class(['tab-recommend','tab--active'=>(request()->query('tab')!='mylist')])>おすすめ</a>
  <a href="?tab=mylist&search={{request()->query('search')}}" @class(['tab-mylist','tab--active'=>(request()->query('tab')=='mylist')])>マイリスト</a>
</div>
<div class="main__items">
  @foreach($items as $item)
  <a href="/item/{{$item->id}}" class="item">
    <img class="item-image" src="{{$item->image}}" alt="{{$item->name}}">
    {{$item->name}}
  </a>
  @endforeach
</div>
@endsection
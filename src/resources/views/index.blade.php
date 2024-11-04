@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('main')
<div class="main__tab">
  <a class="tab-recommend" href="">おすすめ</a>
  <a class="tab-mylist" href="">マイリスト</a>
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
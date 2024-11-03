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
  @for($i=1;$i<30;$i++)
    <a href="/item/test" class="item">
    <div class="item-image" src="" alt="" style="height: 290px;width:290px; background:gray"></div>
    商品名{{$i}}</a>
    @endfor
</div>
@endsection
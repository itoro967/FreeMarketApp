@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('main')
<div class="main__inner">
  <div class="item-purchase">
    <div class="item">
      <img class="item-image" src="{{$item->image}}" alt="{{$item->name}}"></img>
      <div class="item-detail">
        <div class="item-name">{{$item->name}}</div>
        <div class="item-price">\<span class="price--value">{{ number_format($item->price)}}</span>(税込)</div>
      </div>
    </div>
    <div class="payment">
      <div class="payment-title">支払い方法</div>
      <div class="payment-content">
        <select name="payment-select" class="payment-select">
          <option hidden>選択してください</option>
          <option value="コンビニ払い">コンビニ払い</option>
        </select>
      </div>
    </div>
    <div class="sipping">
      <div class="sipping-title">配送先</div>
      <div class="sipping-content">
        <span class="post-code">〒XXX-YYYY</span>
        <div class="address">ここには住所と建物が入ります
        </div>
      </div>
    </div>
  </div>
  <div class="result">
    <table class="result-table">
      <tr class="result-table-tr">
        <th>商品代金</th>
        <td>\{{ number_format($item->price)}}</td>
      </tr>
      <tr>
        <th>支払い方法</th>
        <td>コンビニ払い</td>
      </tr>
    </table>
    <a href="" class="button">購入する</a>
  </div>
</div>
@endsection
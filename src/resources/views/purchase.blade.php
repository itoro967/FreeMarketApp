@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('main')
<form action="" class="main__inner" method="post">
  @csrf
  <div class="item-purchase">
    <div class="item">
      <img class="item-image" src="{{Storage::url($item->image)}}" alt="{{$item->name}}"></img>
      <div class="item-detail">
        <div class="item-name">{{$item->name}}</div>
        <div class="item-price">\<span class="price--value">{{ number_format($item->price)}}</span>(税込)</div>
      </div>
    </div>
    <div class="payment">
      <div class="payment-title">支払い方法</div>
      <x-error name="payment" />
      <div class="payment-content">
        <select name="payment" class="payment-select" onchange="changePayment(this.value)">
          <option hidden value="">選択してください</option>
          <option value="コンビニ支払い">コンビニ支払い</option>
          <option value="カード支払い">カード支払い</option>
        </select>
      </div>
    </div>
    <div class="sipping">
      <div class="sipping__header">
        <div class="sipping-title">配送先</div>
        <!-- TODO　後で住所変更画面を作る -->
        <a href="/purchase/address/{{$item->id}}" class="address-edit-button">変更する</a>
      </div>
      <div class="sipping-content">
        <span class="post-code">〒{{old('post_code',$post_code)}}</span>
        <div class="address">{{old('address',$address) . ' ' . old('building',$building)}}
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
        <td id="payment">選択してください</td>
      </tr>
    </table>
    <input type="hidden" name="item_id" value="{{$item->id}}">
    <input type="hidden" name="post_code" value="{{old('post_code',$post_code)}}">
    <input type="hidden" name="address" value="{{old('address',$address)}}">
    <input type="hidden" name="building" value="{{old('building',$building)}}">
    <button type="submit" class="button">購入する</button>
  </div>
  </div>
  <script>
    function changePayment(value) {
      document.getElementById('payment').innerText = value;
    }
  </script>
</form>
@endsection
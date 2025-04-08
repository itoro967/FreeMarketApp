@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/tradingmessage.css') }}">
<link rel="stylesheet" href="{{ asset('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset('css/correctModal.css') }}">
@endsection

@section('main')
<div class="main__inner">
  <div class="others-trading">
    <div class="trading__title">その他の取引</div>
    <div class="tradings">
      @foreach ($others_items as $others_item)
      <a href="{{route('tradingMessage.chat', ['item_id' => $others_item->id])}}" class="trading">{{$others_item->name}}</a>
      @endforeach
    </div>
  </div>
  <div class="trading-message">
    <div class="message__header">
      <div class="message_title">
        <div>
          <img src="{{Storage::url($to_user->image)}}" class="profile-image" onerror=this.src="{{asset('img/userImage.svg')}}">
          {{$to_user->name}}さんとの取引画面
        </div>
        @if ($user_type == 'buyer' )
        <span class="complete-button" id="complete-button">取引を完了する</span>
        @endif
      </div>
      <div class="item">
        <img src="{{Storage::url($item->image)}}" class="item-image">
        <div>
          <div class="item-name">{{$item->name}}</div>
          <div class="item-price">&yen;{{number_format($item->price)}}</div>
        </div>
      </div>
    </div>
    <div class="chats">
      <div id="chats__inner">
        @foreach ($item->order->tradingMessages as $message)
        <div @class(['chat','chat--to-user'=>$message->user_id == $to_user->id])>
          <div @class(['user','to-user'=>$message->user_id == $to_user->id])>
            <img src="{{Storage::url($message->user->image)}}" class="profile-image" onerror=this.src="{{asset('img/userImage.svg')}}">
            <span class="user-name">{{$message->user->name}}</span>
          </div>
          <div class="chat_content">{{$message->message}}</div>
          @foreach ($message->images as $image)
          <img src="{{Storage::url($image->image_path)}}" @class(['chat_image','chat_image--to-user'=>$message->user_id == $to_user->id])>
          @endforeach
          @if($message->user_id != $to_user->id)
          <div class="chat_menu">
            <span onclick="collect('{{$message->id}}','{{$message->message}}')">修正</span>
            <form action="{{route('tradingMessage.destroy')}}" method="POST">
              @csrf
              <input type="hidden" name="message_id" value="{{$message->id}}">
              <button type="submit" class="delete-button">削除</button>
            </form>
          </div>
          @endif
        </div>
        @endforeach
      </div>
    </div>
    <form class="input-box" action="{{ route('tradingMessage.store', ['item' => $item->id]) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="order_id" value="{{ $item->order->id }}">
      <x-error name="message" />
      <x-error name="image" />
      <input type="text" class="input-message" id="input-message" name="message" placeholder="メッセージを入力" value="{{ old('message') }}">
      <label class="input-image-label" for="input-image">画像を追加</label>
      <input type="file" name="image" id="input-image" class="input-image" accept="image/*">
      <input type="image" src="{{ asset('img/send.svg') }}" class="send-button" alt="Submit">
    </form>
  </div>

  <x-modal :order_id="$item->order->id" @class(['modal__overlay--active'=>$user_type=='seller' && $item->order->seller_rating])/>
  @if ($user_type == 'buyer' && $item->order->seller_rating)
    <div class="modal__overlay modal__overlay--active">
      <div class="modal">
        <div class="modal__message">{{$to_user->name}}さんが評価中です。</div>
        <a href="{{ back()->getTargetUrl() }}" class="back-link">戻る</a>
        <a href="{{ route('mypage') }}" class="mypage-link">マイページへ</a>
      </div>
    </div>
  @endif
  <x-correctModal/>
</div>

<script>
  // スクロール位置を最下部に移動
  let chats = document.getElementById('chats__inner');
  chats.scrollIntoView({
    block: 'end'
  });

  const orderId = '{{ $item->order->id }}';
  // メッセージ入力欄にクッキーの値をセット
  const messageValue=document.cookie.split("; ").find((row) => row.startsWith('message'+orderId+'='))?.split("=")[1]
  if (messageValue) {
    document.getElementById('input-message').value = messageValue;
  }
  // メッセージ入力欄の値が変更されたらクッキーに保存
  const inputMessage = document.getElementById('input-message');
  inputMessage.addEventListener('change', function() {
    document.cookie = 'message'+orderId+'=' + inputMessage.value;
    console.log('message'+orderId+'=' + inputMessage.value);
  });

  // フォーム送信時にクッキーを削除
  onsubmit = function() {
    // クッキーを削除
    document.cookie = 'message'+orderId+'=';
    console.log('message'+orderId+'=' + inputMessage.value);
  }
  // 評価モーダルの表示
  @if ($user_type == 'buyer')
  document.getElementById('complete-button').addEventListener('click', function() {
    document.querySelector('.modal__overlay').classList.add('modal__overlay--active');
  });
  @endif

  // 画像選択時のラベルの色変更
  document.getElementById('input-image').addEventListener('change', function() {
    const file = this.files[0];
    const inputImageLabel = document.querySelector('.input-image-label');
    if (file) {
      inputImageLabel.style.color = 'white';
      inputImageLabel.style.backgroundColor = '#ff7a7a';
    }
    else {
      inputImageLabel.style.color = '';
      inputImageLabel.style.backgroundColor = '';
    }
  });
  // 修正モーダルの表示
  function collect(messageId, message) {
    document.querySelector('.correct-message').value = message;
    document.querySelector('.correct-message-id').value = messageId;
    document.querySelector('.correct-modal__overlay').classList.add('correct-modal__overlay--active');
  }
</script>
@endsection
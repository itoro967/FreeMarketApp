<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css/authcommon.css') }}">
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a href="/">
        <img src="{{ asset('img/logo.svg') }}" alt="">
      </a>
    </div>
  </header>
  <main class="main">
    <div class="main__inner">

      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif


      <div class="title">会員登録</div>
      <form class="form" action="/register" method="post">
        @csrf
        <label for="name" class="label">ユーザー名</label>
        <input type="text" class="input" name="name" id="name" value="{{old('name')}}">
        <label for="email" class="label">メールアドレス</label>
        <input type="email" class="input" name="email" id="email" value="{{old('email')}}">

        <label for="pass" class="label">パスワード</label>
        <input type="password" class="input" name="password" id="pass">
        <label for="confirm-pass" class="label">確認用パスワード</label>
        <input type="password" class="input" name="password_confirmation" id="confirm-pass">
        <input type="submit" class="submit-button" value="登録する">
      </form>
      <a href="/login" class="link">ログインはこちら</a>
    </div>
  </main>
</body>

</html>
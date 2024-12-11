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
      <div class="title">ログイン</div>
      <form class="form" action="/login" method="post">
        @csrf
        <label for="email" class="label">メールアドレス</label>
        <x-error name="email" />
        <input type="email" class="input" name="email" id="email" value="{{old('email')}}">
        <label for="pass" class="label">パスワード</label>
        <x-error name="password" />
        <input type="password" class="input" name="password" id="pass">
        <input type="submit" class="submit-button" value="ログインする">
      </form>
      <a href="/register" class="link">会員登録はこちら</a>
    </div>
  </main>
</body>

</html>
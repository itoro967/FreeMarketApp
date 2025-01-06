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
        <img class="logo-image" src="{{ asset('img/logo.svg') }}" alt="">
      </a>
    </div>
  </header>
  <main class="main">
    <div class="main__inner">
      <div class="title">メール認証</div>
      <span>ただいま確認メールを送信しました</span>
      <span>メール内リンクをクリックして認証してください</span>
      <form action="/email/verification-notification" method="post">
        @csrf
        <button type="submit" class="">再送信はこちら</button>
      </form>
    </div>
  </main>
</body>

</html>
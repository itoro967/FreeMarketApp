<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  @yield('css')
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <img src="{{ asset('img/logo.svg') }}" alt="">
      <form class="search" action="">
        <input class="search-input" type="text" placeholder="何をお探しですか?">
        <button class="search-submit">検索</button>
      </form>
      <div class="header__menu">
        @auth
        <a href="/logout" class="logout-button">ログアウト</a>
        @endauth
        @guest
        <a href="/login" class="login-button">ログイン</a>
        @endguest
        <a class="mypage-button" href="/mypage">マイページ</a>
        <button class="sell-button">出品</button>
      </div>
    </div>
  </header>
  <main class="main">
    @yield('main')
  </main>
</body>

</html>
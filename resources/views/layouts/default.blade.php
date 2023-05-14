<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>

  <!-- Style -->
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/header.css') }}">
  @stack('css')
</head>

<body>

    <div class="header" id="header">
      <div class="header__logo" id="header__logo">
        <div class="header__menu" id="header__menu">
          <span class="menu__line-top"></span>
          <span class="menu__line-middle"></span>
          <span class="menu__line-bottom"></span>
        </div>
        <h1 class="header__title" id="header__title">Rese</h1>
      </div>

      <div class="header__nav" id="header__nav">
        @auth
        <ul>
          <li><a href="/">HOME</a></li>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <li><a href="/logout">LOGOUT</a></li>
          </form>
          <li><a href="/mypage">MYPAGE</a></li>
          @can('storemanager')
          <li><a href="/
          storemanager">店舗代表者</a></li>
          @endcan
          @can('manager')
          <li><a href="/manager">管理者</a></li>
          @endcan
        </ul>
        @else
        <ul>
          <li><a href="/">HOME</a></li>
          <li><a href="/register">REGISTER</a></li>
          <li><a href="/login">LOGIN</a></li>
        </ul>
        @endauth
      </div>
    </div>

    <div class="content">
      @yield('content')
    </div>

    <script src="{{ asset('js/header.js') }}"></script>
  
</body>

</html>
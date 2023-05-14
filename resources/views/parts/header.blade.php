<div class="header" id="header">
    <div class="header__menu" id="header__menu">
        <span class="menu__line--top"></span>
        <span class="menu__line--middle"></span>
        <span class="menu__line--bottom"></span>
    </div>
    <h1 class="header__title" id="header__title">Rese</h1>

    <div class="header__nav" id="header__nav">
        @auth
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="">Logout</a></li>
            <li><a href="">Mypage</a></li>
        </ul>
        @else
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="">Registration</a></li>
            <li><a href="">Login</a></li>
        </ul>
        @endauth
    </div>
</div>

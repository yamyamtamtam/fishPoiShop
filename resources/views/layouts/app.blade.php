<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
</head>

<body class="bgSea">
        <header class="header">
            <div class="inner header__column">
            <h1 class="header__siteTitle"><a href="{{ url('/') }}">
                <img src="{{ asset('/images/logo.svg') }}" alt="{{ config('app.name') }}">
            </a></h1>
            <div class="header__utility">
                @guest
                    @if(!Auth::check() && (!isset($authgroup) || !Auth::guard($authgroup)->check()))
                        @if (Route::has('login'))
                            @if(!isset($authgroup))
                                <a class="buttonLogin" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                            @endif
                        @endif
                        @if (Route::has('register'))
                            @if(!isset($authgroup))
                                <a class="buttonResister" href="{{ route('register') }}">{{ __('ユーザー登録') }}</a>
                            @endif
                        @endif
                    @else
                        @if(!isset($authgroup))
                            {{ Auth::guard($authgroup)->user()->name }}
                        @endif
                    @endif
                @else
                    <a class="buttonLogout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                        {{ __('ログアウト') }}
                    </a>
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>
        <div class="wave"></div>
        </header>
        <main>
            @yield('content')
        </main>
        <footer class="footer">
            <nav class="footer__utility">
                <a href="#">プライバシーポリシー</a>
                <a href="#">特定商取引法に基づく表記</a>
            </nav>
            <h6 class="footer__copy">{{ config('app.name') }} All right Reserved.</h6>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bubbly-bg@1.0.0/dist/bubbly-bg.js"></script>
        <script>
        bubbly({
            blur: 20,
            colorStart: '#048ABF',
            colorStop: '#0460D9',
            radiusFunc:() => 5 + Math.random() * 10,
            angleFunc:() => -Math.PI / 2 * (Math.random() * 1.5 + 0.5),
            velocityFunc:() => Math.random() * 0.5,
            bubbleFunc:() => `hsla(${200 + Math.random() * 200}, 100%, 65%, .1)`,
            bubbles:30
        });
        </script>
</body>

</html>
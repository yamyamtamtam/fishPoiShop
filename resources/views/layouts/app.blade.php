<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <header class="header">
            @isset($authgroup)
            <h1 class="header__siteTitle"><a href="{{ url('/admin') }}">
                    {{ __('Laravel練習用ECサイト管理画面') }}
                </a></h1>
            @else
            <h1 class="header__siteTitle"><a href="{{ url('/') }}">
                {{ config('app.name') }}
            </a></h1>
            @endisset
            <div class="header__utility">
                @guest
                    @if(!Auth::check() && (!isset($authgroup) || !Auth::guard($authgroup)->check()))
                        @if (Route::has('login'))
                            @if(!isset($authgroup))
                                <a class="buttonRound" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                            @endif
                        @endif
                        @if (Route::has('register'))
                            @if(!isset($authgroup))
                                <a class="buttonRound" href="{{ route('register') }}">{{ __('ユーザー登録') }}</a>
                            @endif
                        @endif
                    @else
                        @if(!isset($authgroup))
                            {{ Auth::guard($authgroup)->user()->name }}
                        @endif
                    @endif
                @else
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('ログアウト') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
            </div>
        </header>
        <main>
            @yield('content')
        </main>
        <footer>
            <a href="https://yamyamtamtam.tech" target="_blank">My blog.</a>
            <h6>yamyamtamtam.</h6>
        </footer>
    </div>
</body>

</html>
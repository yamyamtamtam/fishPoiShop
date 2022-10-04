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
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <header class="header">
            <h1 class="header__siteTitle"><a href="{{ url('/admin') }}">
                    {{ __('Laravel練習用ECサイト管理画面') }}
                </a></h1>
            <div class="header__utility">
                <a class="buttonRound" href="{{ route('admin-register') }}">{{ __('ユーザー新規登録') }}</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('ログアウト') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <a href="{{ route('product-list') }}">
                    {{ __('商品一覧') }}
                </a>
                <a href="{{ route('product-create') }}">
                    {{ __('商品登録') }}
                </a>
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
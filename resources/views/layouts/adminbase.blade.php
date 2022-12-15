<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}{{ __('管理画面') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
</head>

<body class="bgAdmin">
    <header class="header">
        <div class="inner">
            <h1 class="header__siteTitle"><a href="{{ url('/admin') }}">
                {{ config('app.name') }} {{ __('管理画面') }}
                </a></h1>
            <div class="header__utility">
                <a href="{{ route('admin-register') }}">{{ __('ユーザー新規登録') }}</a>
                <a href="{{ route('product-list') }}">{{ __('商品一覧') }}</a>
                <a href="{{ route('product-create') }}">{{ __('商品登録') }}</a>
                <a href="{{ route('order-list') }}">{{ __('受注一覧') }}</a>
            </div>
        </div>
        <a class="buttonLogout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('ログアウト') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
        </form>
    </header>
    <main class="main">
        @yield('content')
    </main>
    <footer class="footer">
        <h6 class="footer__copy">{{ config('app.name') }} All right Reserved.</h6>
    </footer>
</body>

</html>
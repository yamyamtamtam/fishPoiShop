@extends('layouts.app')

@section('content')
<div class="inner">
    @isset($authgroup)
        <h2 class="headlineBarWhite">{{ __('管理者ログイン') }}</h2>
    @endif
        <p class="caption textC pt20">{{ __('メールアドレスとパスワードを入力してください') }}</p>
    @isset($authgroup)
        <form method="POST" action="{{ url("login/$authgroup") }}">
    @else
        <form method="POST" action="{{ route('login') }}">
    @endisset
    @csrf
    <dl class="formItemCenter">
        <dt for="email">{{ __('メールアドレス') }}</dt>
        <dd>
            <input type="email" class="formText formText--m" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="formItem__error" role="alert">{{ $message }}</span>
            @enderror
        </dd>
    </dl>
    <dl class="formItemCenter">
        <dt for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</dt>
        <dd>
            <input  type="password" class="formText formText--m" name="password" required autocomplete="current-password">
            @error('password')
                <span class="formItem__error" role="alert">{{ $message }}</span>
            @enderror
        </dd>
    </dl>
    <div class="flex-center mt20">
        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="caption" for="remember">{{ __('パスワードを記憶する') }}</label>
    </div>
    <div class="flex-center mt40">
        <button type="submit" class="buttonRound flex-center">{{ __('ログインする') }}</button>
    </div>
    @if (Route::has('password.request'))
        <!--<a class="btn btn-link" href="{{ route('password.request') }}">{{ __('パスワードを忘れた場合はこちら') }}</a>-->
    @endif
    </form>
</div>
@endsection
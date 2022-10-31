@extends('layouts.app')

@section('content')
<div class="inner">
    @isset($authgroup)
        <h2 class="headlineBarWhite">{{ __('管理者ユーザー登録') }}</h2>
    @else
        <h2 class="headlineBarWhite">{{ __('ユーザー登録') }}</h2>
    @endif
    @isset($authgroup)
        <form method="POST" action="{{ url("register/$authgroup") }}">
    @else
        <form method="POST" action="{{ route('register') }}">
    @endisset
    @csrf
        <dl class="formItemCenter">
            <dt for="name">{{ __('お名前') }}</dt>
            <dd>
                <input class="formText formText--m" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <br><span class="formItem__error" role="alert">{{ $message }}</span>
                @enderror
            </dd>
        </dl>
        <dl class="formItemCenter">
            <dt for="email">{{ __('メールアドレス') }}</dt>
            <dd>
                <input class="formText formText--m" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <br><span class="formItem__error" role="alert">{{ $message }}</span>
                @enderror
            </dd>
        </dl>
        <dl class="formItemCenter">
            <dt for="email">{{ __('パスワード') }}</dt>
            <dd>
                <input class="formText formText--m" type="password" name="password" value="{{ old('password') }}" required autocomplete="new-password">
                @error('password')
                    <br><span class="formItem__error" role="alert">{{ $message }}</span>
                @enderror
            </dd>
        </dl>
        <dl class="formItemCenter">
            <dt for="email">{{ __('パスワード再入力') }}</dt>
            <dd>
                <input class="formText formText--m" type="password" name="password_confirmation" required autocomplete="new-password">
            </dd>
        </dl>
        <div class="flex-center mt40">
            <button type="submit" class="buttonRound flex-center">{{ __('ユーザー登録') }}</button>
        </div>
    </form>
</div>
@endsection
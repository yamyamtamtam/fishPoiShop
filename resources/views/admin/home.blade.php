@extends('layouts.adminbase',['authgroup'=>'admin'])
@section('content')
<div class="inner pt60 pb60">
    <p class="textC fontB">{{ __('管理者ログイン中です。') }}</p>
    <p class="textC mt40">管理者名：{{ $auth->name }}</p>
    <p class="textC mt40">メールアドレス：{{ $auth->email }}</p>
</div>
@endsection
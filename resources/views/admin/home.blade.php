@extends('layouts.adminbase',['authgroup'=>'admin'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('管理画面') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('管理者ログイン中です。') }}
                    <nav>
                        <a href="{{ url('/admin/produst/list/') }}">
                            {{ __('商品一覧') }}
                        </a>
                        <a href="{{ url('/admin/produst/create/') }}">
                            {{ __('商品登録') }}
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
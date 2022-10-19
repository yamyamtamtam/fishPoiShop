@extends('layouts.adminbase',['authgroup'=>'admin'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('管理画面') }}</div>

                <div class="card-body">
                    {{ __('管理者ログイン中です。') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
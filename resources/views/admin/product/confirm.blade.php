@extends('layouts.adminbase')

@section('content')
<section>
    <h2 class="headLineAdminMain">商品を新規登録（確認）</h2>
    <form action="{{ route('product-store') }}" method="POST">
        @csrf
        @php
        @endphp
        <dl class="formItem">
            <dt><label for="name">{{ __('商品名') }}</label><span class="required">{{ __('必須') }}</span></dt>
            <dd>{{ $input['name'] }}</dd>
            <input type="hidden" name="name" value="{{ $input['name'] }}">
        </dl>
        <dl class="formItem">
            <dt><label for="price">{{ __('価格') }}</label><span class="required">{{ __('必須') }}</span></dt>
            <dd>{{ $input['price'] }}</dd>
            <input type="hidden" name="price" value="{{ $input['price'] }}">
        </dl>
        <dl class="formItem">
            <dt><label for="sale">{{ __('セール価格') }}</label></dt>
            <dd>{{ $input['sale'] }}</dd>
            <input type="hidden" name="sale" value="{{ $input['sale'] }}">
        </dl>
        <dl class="formItem">
            <dt><label for="code">{{ __('商品コード') }}</label></dt>
            <dd>{{ $input['code'] }}</dd>
            <input type="hidden" name="code" value="{{ $input['code'] }}">
        </dl>
        <!--
        <dl class="formItem">
            <dt><label for="cat">{{ __('カテゴリー') }}</label></dt>
            <dd></dd>
        </dl>
        -->
        <dl class="formItem">
            <dt><label for="image">{{ __('画像') }}</label></dt>
            <dd><img src="{{ asset('/' . $input['image']) }}" alt=""></dd>
            <input type="hidden" name="image" value="{{ $input['image'] }}">
        </dl>
        <dl class="formItem">
            <dt><label for="description">{{ __('商品説明') }}</label><span class="required">{{ __('必須') }}</span></dt>
            <dd>{{ $input['description'] }}</dd>
            <input type="hidden" name="description" value="{{ $input['description'] }}">
        </dl>
        <button type="submit" name="store" class="button button--submit">
            {{ __('登録') }}
        </button>
        <button type="submit" name="back" value="true" class="button button--return">
            {{ __('戻る') }}
        </button>
    </form>
</section>
@endsection
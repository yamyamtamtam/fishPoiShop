@extends('layouts.adminbase')

@section('content')
<section>
    <h2 class="headLineAdminMain">商品を新規登録</h2>
    <form action="{{ route('product-confirm') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @php
        @endphp
        <dl class="formItem">
            <dt><label for="name">{{ __('商品名') }}</label><span class="required">{{ __('必須') }}</span></dt>
            <dd>
                <input type="text" class="formText" name="name" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    @foreach($errors->get('name') as $message)
                        <span class="formItem__error">{{ $message }}</span>
                    @endforeach
                @endif
            </dd>
        </dl>
        <dl class="formItem">
            <dt><label for="price">{{ __('価格') }}</label><span class="required">{{ __('必須') }}</span></dt>
            <dd>
                <input type="number" class="formNum" name="price" value="{{ old('price') }}">
                @if ($errors->has('price'))
                    @foreach($errors->get('price') as $message)
                        <span class="formItem__error">{{ $message }}</span>
                    @endforeach
                @endif
            </dd>
        </dl>
        <dl class="fformItemorm">
            <dt><label for="sale">{{ __('セール価格') }}</label></dt>
            <dd><input type="number" class="formNum" name="sale" value="{{ old('sale') }}"></dd>
        </dl>
        <dl class="formItem">
            <dt><label for="code">{{ __('商品コード') }}</label></dt>
            <dd><input type="text" class="formText" name="code" value="{{ old('code') }}"></dd>
        </dl>
        <!--
        <dl class="formItem">
            <dt><label for="cat">{{ __('カテゴリー') }}</label></dt>
            <dd><input type="number" class="formText" name="cat" value="{{ old('cat') }}"></dd>
        </dl>
        -->
        <dl class="formItem">
            <dt><label for="image">{{ __('画像') }}</label></dt>
            <dd><input type="file" class="formFile" name="image"></dd>
        </dl>
        <dl class="formItem">
            <dt><label for="description">{{ __('商品説明') }}</label><span class="required">{{ __('必須') }}</span></dt>
            <dd>
                <textarea type="textarea" class="formTextArea" name="description">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                @foreach($errors->get('description') as $message)
                    <span class="formItem__error">{{ $message }}</span>
                @endforeach
            @endif
            </dd>
        </dl>
        <button type="submit" class="button button--submit">
            {{ __('確認画面へ') }}
        </button>
    </form>
</section>
@endsection
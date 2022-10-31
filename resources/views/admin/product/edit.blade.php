@extends('layouts.adminbase')

@section('content')
<section class="inner">
    <h2 class="headlineBar mt40 mb20">商品を編集</h2>
    <form action="{{ route('product-edit') . '/' . $product->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $product->id }}">
        <dl class="formItem">
            <dt><label for="name">{{ __('商品名') }}</label></dt>
            <dd>
                <input type="text" class="formText formText--m" name="name" value="@if(old('name')){{ old('name') }}@else{{ $product->name }}@endif">
                @if ($errors->has('name'))
                @foreach($errors->get('name') as $message)
                    <span class="formItem__error">{{ $message }}</span>
                @endforeach
                @endif
            </dd>
        </dl>
        <dl class="formItem">
            <dt><label for="price">{{ __('価格') }}</label></dt>
            <dd>
                <input type="number" class="formText formText--s" name="price" value="@if(old('price')){{ old('price') }}@else{{ $product->price }}@endif">
                @if ($errors->has('price'))
                @foreach($errors->get('price') as $message)
                    <span class="formItem__error">{{ $message }}</span>
                @endforeach
                @endif
            </dd>
        </dl>
        <dl class="formItem">
            <dt><label for="sale">{{ __('セール価格') }}</label></dt>
            <dd><input type="number" class="formText formText--s" name="sale" value="@if(old('sale')){{ old('sale') }}@else{{ $product->sale }}@endif"></dd>
        </dl>
        <dl class="formItem">
            <dt><label for="code">{{ __('商品コード') }}</label></dt>
            <dd><input type="text" class="formText formText--s" name="code" value="@if(old('code')){{ old('code') }}@else{{ $product->code }}@endif"></dd>
        </dl>
        <!--
        <dl class="formItem">
            <dt><label for="cat">{{ __('カテゴリー') }}</label></dt>
            <dd><input type="number" class="formText" name="cat" value=""></dd>
        </dl>
        -->
        <dl class="formItem">
            <dt><label for="image">{{ __('画像') }}</label></dt>
            <dd><input type="file" class="formText" name="image">
                @if ($errors->has('image'))
                @foreach($errors->get('image') as $message)
                    <span class="formItem__error">{{ $message }}</span>
                @endforeach
                @endif
                <p class="caption mt30">現在の画像</p>
                <img src="{{ asset('/storage/uploads/' . $product->image) }}" alt="">
                <input type="hidden" name="currentImage" value="{{ $product->image }}">
            </dd>
        </dl>
        <dl class="formItem">
            <dt><label for="productDescription">{{ __('商品説明') }}</label></dt>
            <dd>
                <textarea type="textarea" class="formTextArea" name="description">@if(old('description')){{ old('description') }}@else{{ $product->description }}@endif</textarea>
                @if ($errors->has('description'))
                @foreach($errors->get('description') as $message)
                    <span class="formItem__error">{{ $message }}</span>
                @endforeach
                @endif
            </dd>
        </dl>
        <div class="flex-center textC mt60">
            <button type="submit" class="buttonRound buttonRound--blue">{{ __('内容更新') }}</button>
         </div>
    </form>
</section>
@endsection
@extends('layouts.app')

@section('content')
<a href="{{ route('cart') }}" class="cartButton">カート:{{ $cartCount }}</a>
<section class="Wrapper">
    <div class="inner">
        @if (isset($auth))
        <p class="caption">{{ __('ようこそ') . $auth->name . __('様') }}</p>
        @else
        <p class="caption">{{ __('お買い物をする場合は、ログインしてください') }}</p>
        @endif
        <div class="productsWrap">
            @if (count($products) > 0)
                @foreach($products as $product)
                    <article class="productCard">
                        <h2 class="productCard__headline">{{ $product->name }}</h2>
                        <img src="{{ asset('/storage/uploads/' . $product->image) }}" alt="{{ $product->name }}の画像">
                        <p class="productCard__text">{{ Str::limit($product->description, 20, '…') }}</p>
                        <a href="{{ route('detail') . '/' . $product->id }}" class="product__button">詳細・購入</a>
                    </article>
                @endforeach
            @endif
        </div>
    </div>
</section>
@endsection
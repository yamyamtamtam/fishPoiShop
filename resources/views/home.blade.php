@extends('layouts.app')

@section('content')
<a href="{{ route('cart') }}" class="cartButton">
    <img src="{{ asset('/images/cart02.png') }}" alt="カート">        
    <span>{{ $cartCount }}</span>
</a><section class="wrapper">
    <div class="inner">
        @if (isset($auth))
        <p class="caption mb30">{{ $auth->name . __('様 ログイン中です。') }}</p>
        @endif
        <div class="productsWrap">
            @if (count($products) > 0)
                @foreach($products as $product)
                    <article class="productCard">
                        <h2 class="productCard__headline">{{ $product->name }}</h2>
                        <img src="{{ asset('/storage/' . $product->image) }}" alt="{{ $product->name }}の画像">
                        <p class="productCard__text">{!! Str::limit($product->description, 100, '…') !!}</p>
                        <a href="{{ route('detail') . '/' . $product->id }}" class="product__button">{{ __('詳細・購入') }}</a>
                    </article>
                @endforeach
            @endif
        </div>
    </div>
</section>
@endsection
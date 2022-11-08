@extends('layouts.app')

@section('content')
<a href="{{ route('cart') }}" class="cartButton">
    <img src="{{ asset('/images/cart02.png') }}" alt="カート">        
    <span>{{ $cartCount }}</span>
</a>
<section class="inner">
        <article class="detailsWrap">
            @if(isset($content))
                <div class="detailsWrap__left">
                    <img src="{{ asset('/storage/' . $content->image) }}" alt="{{ $content->name }}の画像">        
                </div>
                <div class="detailsWrap__right">
                    <h2 class="headlineUnderline">{{ $content->name }}</h2>
                    <dl class="priceText">
                        <dt>{{ __('価格') }}</dt>
                        <dd>
                        @if(isset($content->sale))
                            <span class="priceText__strike">{{ $content->price }}</span>
                            <span class="priceText__sale">{{ $content->sale }}</span>
                        @else
                            {{ $content->price }}
                        @endif
                        <span class="priceText__unit">{{ __('円') }}</span>
                        </dd>
                    </dl>
                    <p class="description">{!! $content->description !!}</p>
                    <form action="{{ route('add') . '/' . $content->id }}" method="POST">
                        @csrf
                        <input name="name" type="hidden" value="{{ $content->name }}">
                        <input name="image" type="hidden" value="{{ $content->image }}">
                        <input name="price" type="hidden" value="{{ $content->price }}">
                        <input name="sale" type="hidden" value="{{ $content->sale }}">
                        <dl class="countArea">
                            <dt>{{ __('個数') }}</dt>
                            <dd><input class="inputNum" name="num" type="number" min="1" max="20" value="1"></dd>
                        </dl>
                        <button class="buttonRound" type="submit">{{ __('カートに入れる') }}</button>
                    </form>
                </div>
            @else
                <p class="description">{{ __('商品はありません。') }}</p>
            @endif
        </article>
        <section class="recommend mt60">
            <h3 class="headlineBarWhite">{{ __('他の商品をみる') }}</h3>
            <div class="reccomendWrap">
                @php
                @endphp
                @if (isset($recommends))
                    @foreach($recommends as $recommend)
                        <article class="productCard">
                            <h2 class="productCard__headline">{{ $recommend->name }}</h2>
                            <img src="{{ asset('/storage/' . $recommend->image) }}" alt="{{ $recommend->name }}の画像">
                            <p class="productCard__text">{{ Str::limit($recommend->description, 20, '…') }}</p>
                            <a href="{{ route('detail') . '/' . $recommend->id }}" class="product__button">{{ __('詳細・購入') }}</a>
                        </article>
                    @endforeach
                @endif
        </section>
    </div>
</section>
@endsection
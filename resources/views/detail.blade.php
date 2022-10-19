@extends('layouts.app')

@section('content')
<a href="{{ route('cart') }}" class="cartButton">カート:{{ $cartCount }}</a>
<section class="Wrapper">
    <div class="inner">
        <article class="detailsWrap">
            @if(isset($content))
                <div class="detailsWrap__left">
                    <img src="{{ asset('/storage/uploads/' . $content->image) }}" alt="{{ $content->name }}の画像">        
                </div>
                <div class="detailsWrap__right">
                    <h2 class="headLine">{{ $content->name }}</h2>
                    <dl>
                        <dt>価格</dt>
                        <dd>
                        @if(isset($content->sale))
                            <span class="strike">{{ $content->price }}</span>
                            <span class="sale">{{ $content->sale }}</span>
                        @else
                            {{ $content->price }}
                        @endif
                        </dd>
                    </dl>
                    <p>{{ $content->description }}</p>
                    <form action="{{ route('add') . '/' . $content->id }}" method="POST">
                        @csrf
                        <input name="name" type="hidden" value="{{ $content->name }}">
                        <input name="image" type="hidden" value="{{ $content->image }}">
                        <input name="price" type="hidden" value="{{ $content->price }}">
                        <input name="sale" type="hidden" value="{{ $content->sale }}">
                        <input name="num" type="number" min="1" max="20" value="1">
                        <button type="submit">カートに入れる</button>
                    </form>
                </div>
            @else
                <p class="caption">商品はありません。</p>
            @endif
        </article>
        <section class="recommend">
            <h3 class="headLine">他の商品</h3>
            <div class="reccomendWrap">
                @php
                @endphp
                @if (isset($recommends))
                    @foreach($recommends as $recommend)
                        <article class="productCard">
                            <h2 class="productCard__headline">{{ $recommend->name }}</h2>
                            <img src="{{ asset('/storage/uploads/' . $recommend->image) }}" alt="{{ $recommend->name }}の画像">
                            <p class="productCard__text">{{ Str::limit($recommend->description, 20, '…') }}</p>
                            <a href="{{ route('detail') . '/' . $recommend->id }}" class="product__button">この商品を見る</a>
                        </article>
                    @endforeach
                @endif
            </div>
        </section>
    </div>
</section>
@endsection
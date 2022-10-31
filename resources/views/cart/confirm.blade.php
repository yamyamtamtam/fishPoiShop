@extends('layouts.app')

@section('content')
<section class="Wrapper">
    <div class="inner">
        <div class="cartWrap">
            @if (count($cart) > 0)
            <form action="{{ route('cart-thanks') }}" method="POST">
                @csrf
                @foreach($cart as $key => $item)
                    <article class="cartCard">
                        <h2 class="cartCard__headline">{{ $item['name'] }}</h2>
                        <div class="cartCard__img">
                            <img src="{{ asset('/storage/uploads/') . '/' . $item['image'] }}" alt="{{ $item['name'] }}の画像">
                        </div>
                        <dl class="cartCard__price">
                            <dt>価格(税込)</dt>
                            <dd>{{ $item['currentPrice'] }}</dd>
                        </dl>
                        <dl class="cartCard__count">
                            <dt>個数</dt>
                            <dd>{{ $item['num'] }}</dd>
                        </dl>
                            <input name="{{ 'num' . $key }}" type="hidden" value="{{ $item['num'] }}">
                            <input name="{{ 'name' . $key }}" type="hidden" value="{{ $item['name'] }}">
                            <input name="{{ 'image' . $key }}" type="hidden" value="{{ $item['image'] }}">
                            <input name="{{ 'currentPrice' . $key }}" type="hidden" value="{{ $item['currentPrice'] }}">
                    </article>
                @endforeach
                <p class="textBgBlue textBg--centerLarge mt40">合計金額：{{ $total }}円（税込）</p>
                <input name="total" type="hidden" value="{{ $total }}">
                <h3 class="headlineBarWhite mt40">お届け先情報</h3>
                <dl class="formItem">
                    <dt><label for="name">{{ __('お届け先お名前') }}</label></dt>
                    <dd class="caption">{{ $deliveryName }}</dd>
                    <input type="hidden" name="deliveryName" value="{{ $deliveryName }}">
                </dl>
                <dl class="formItem">
                    <dt><label for="name">{{ __('お届け先郵便番号') }}</label></dt>
                    <dd class="caption">{{ $deliveryPostal }}</dd>
                    <input type="hidden" name="deliveryPostal" value="{{ $deliveryPostal }}">
                </dl>
                <dl class="formItem">
                    <dt><label for="name">{{ __('お届け先住所') }}</label></dt>
                    <dd class="caption">{{ $deliveryAddress }}</dd>
                    <input type="hidden" name="deliveryAddress" value="{{ $deliveryAddress }}">
                </dl>
                <dl class="formItem">
                    <dt><label for="name">{{ __('電話番号') }}</label></dt>
                    <dd class="caption">{{ $deliveryTel }}</dd>
                    <input type="hidden" name="deliveryTel" value="{{ $deliveryTel }}">
                </dl>
                <dl class="formItem">
                    <dt><label for="name">{{ __('メールアドレス') }}</label></dt>
                    <dd class="caption">{{ $deliveryMail }}</dd>
                    <input type="hidden" name="deliveryMail" value="{{ $deliveryMail }}">
                </dl>
                <p class="caption mt30">{{ __('お支払い方法はメールでご案内します。') }}</p>
                <div class="flex-center mt40">
                    <button type="submit" name="store" class="buttonRound mr10">
                        {{ __('購入') }}
                    </button>
                    <button type="submit" name="back" value="true" class="buttonRound buttonRound--gray">
                        {{ __('戻る') }}
                    </button>
                </div>
                </form>
            @endif
        </div>
    </div>
</section>
@endsection
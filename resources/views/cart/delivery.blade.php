@extends('layouts.app')

@section('content')
<section class="Wrapper">
    <div class="inner">
        <div class="cartWrap">
            @if (count($cart) > 0)
            <form action="{{ route('cart-confirm') }}" method="POST">
                @csrf
                @foreach($cart as $key => $item)
                    <article class="cartCard">
                        <h2 class="cartCard__headline">{{ $item['name'] }}</h2>
                        <img src="{{ asset('/storage/uploads/') . '/' . $item['image'] }}" alt="{{ $item['name'] }}の画像">
                        <dl><dt>価格(税込)</dt><dd>{{ $item['currentPrice'] }}</dd></dl>
                        <dl><dt>個数</dt><dd>{{ $item['num'] }}</dd></dl>
                            <input name="{{ 'num' . $key }}" type="hidden" value="{{ $item['num'] }}">
                            <input name="{{ 'name' . $key }}" type="hidden" value="{{ $item['name'] }}">
                            <input name="{{ 'image' . $key }}" type="hidden" value="{{ $item['image'] }}">
                            <input name="{{ 'currentPrice' . $key }}" type="hidden" value="{{ $item['currentPrice'] }}">
                    </article>
                @endforeach
                <p>合計金額：{{ $total }}円（税込）</p>
                <input name="total" type="hidden" value="{{ $total }}">
                <h3>お届け先情報入力</h3>
                <dl class="formItem">
                    <dt><label for="name">{{ __('お届け先お名前') }}</label><span class="required">{{ __('必須') }}</span></dt>
                    <dd>
                        <input type="text" class="formText" name="deliveryName" value="{{ old('deliveryName') }}">
                        @if ($errors->has('deliveryName'))
                            @foreach($errors->get('deliveryName') as $message)
                                <span class="formItem__error">{{ $message }}</span>
                            @endforeach
                        @endif
                    </dd>
                </dl>
                <dl class="formItem">
                    <dt><label for="name">{{ __('お届け先郵便番号') }}</label><span class="required">{{ __('必須') }}</span></dt>
                    <dd>
                        <input type="text" class="formText" name="deliveryPostal" value="{{ old('deliveryPostal') }}">
                        @if ($errors->has('deliveryPostal'))
                            @foreach($errors->get('deliveryPostal') as $message)
                                <span class="formItem__error">{{ $message }}</span>
                            @endforeach
                        @endif
                    </dd>
                </dl>
                <dl class="formItem">
                    <dt><label for="name">{{ __('お届け先住所') }}</label><span class="required">{{ __('必須') }}</span></dt>
                    <dd>
                        <input type="text" class="formText" name="deliveryAddress" value="{{ old('deliveryAddress') }}">
                        @if ($errors->has('deliveryAddress'))
                            @foreach($errors->get('deliveryAddress') as $message)
                                <span class="formItem__error">{{ $message }}</span>
                            @endforeach
                        @endif
                    </dd>
                </dl>
                <dl class="formItem">
                    <dt><label for="name">{{ __('電話番号') }}</label><span class="required">{{ __('必須') }}</span></dt>    
                    <dd>
                        <input type="text" class="formText" name="deliveryTel" value="{{ old('deliveryTel') }}">
                        @if ($errors->has('deliveryTel'))
                            @foreach($errors->get('deliveryTel') as $message)
                                <span class="formItem__error">{{ $message }}</span>
                            @endforeach
                        @endif
                    </dd>
                </dl>
                <dl class="formItem">
                    <dt><label for="name">{{ __('メールアドレス') }}</label><span class="required">{{ __('必須') }}</span></dt>    
                    <dd>
                        <input type="text" class="formText" name="deliveryMail" value="{{ old('deliveryMail') }}">
                        @if ($errors->has('deliveryMail'))
                            @foreach($errors->get('deliveryMail') as $message)
                                <span class="formItem__error">{{ $message }}</span>
                            @endforeach
                        @endif
                    </dd>
                </dl>
                <button type="submit">確認</button>
                <a href="{{ route('cart') }}">商品修正</a>
            </form>
            @endif
        </div>
    </div>
</section>
@endsection
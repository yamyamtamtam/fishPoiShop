@extends('layouts.app')

@section('content')
<section class="Wrapper">
    <div class="inner">
        @if (isset($auth))
        <p class="caption mb30">{{ $auth->name . __('様 ログイン中です。') }}</p>
        @endif
        <h2 class="headlineBarWhite">カート内容</h2>
        <div class="cartWrap">
            @if (isset($cart) && count($cart) > 0)
            <form action="{{ route('cart-delivery') }}" method="POST">
                @csrf
                @foreach($cart as $key => $item)
                    <article class="cartCard">
                        <h2 class="cartCard__headline">{{ $item['name'] }}</h2>
                        <div class="cartCard__img">
                            <img src="{{ asset('/storage/') . '/' . $item['image'] }}" alt="{{ $item['name'] }}の画像">
                        </div>
                        <dl class="cartCard__price">
                            <dt>価格(税込)</dt>
                            <dd>{{ $item['currentPrice'] }}</dd>
                        </dl>
                        <dl class="cartCard__count">
                            <dt>個数</dt>
                            <dd>
                                <input class="inputNum" name="{{ 'num' . $key }}" type="number" min="1" max="20" value="{{ $item['num'] }}">
                            </dd></dl>
                            <div class="cartCard__button">
                                <a class="buttonRound buttonRound--small" target="_blank" href="{{ route('detail') . '/' . $key }}">商品詳細</a>
                                <a class="buttonRound buttonRound--small buttonRound--gray" onclick="deleteConfirm('{{ $item['name'] }}',{{ $key }})" href="#">削除</a>
                            </div>
                            <input name="{{ 'name' . $key }}" type="hidden" value="{{ $item['name'] }}">
                            <input name="{{ 'image' . $key }}" type="hidden" value="{{ $item['image'] }}">
                            <input name="{{ 'currentPrice' . $key }}" type="hidden" value="{{ $item['currentPrice'] }}">
                    </article>
                @endforeach
                <p class="textBgBlue textBg--centerLarge mt40">合計金額：<span>{{ $total }}</span> 円（税込）</p>
                @if (isset($auth))
                    <input name="total" type="hidden" value="{{ $total }}">
                    <div class="flex-center mt40"><button class="buttonRound" type="submit">お届け先情報入力へ</button></div>
                @else
                    <div class="flex-center mt40"><a class="buttonRound" href="{{ route('login') }}">購入にはログインが必要です。</a></div>
                @endif
            </form>
            <form id="deleteForm" action="{{ route('cart-delete') }}" method="POST">
                @csrf
            </form>
            @else
                <p class="caption mt30 mb30">現在、カートに商品は入っていません。</p>
                <a class="buttonRound" href="{{ route('home') }}" class="button">商品一覧へ</a>

            @endif
        </div>
    </div>
</section>
<script>
    const deleteConfirm = (name,id) => {
       const result = window.confirm(name + 'をカートから削除してもよろしいですか？');
       if(result){
            const actionName = document.getElementById('deleteForm').action;
            document.getElementById('deleteForm').action = actionName + '/' + id;
            document.getElementById('deleteForm').submit();
       }else{
            return;
       }
    }
    </script>
@endsection
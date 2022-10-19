@extends('layouts.app')

@section('content')
<section class="Wrapper">
    <div class="inner">
        @if (isset($auth))
        <p class="caption">{{ __('ようこそ') . $auth->name . __('様') }}</p>
        @else
        <p class="caption">{{ __('お買い物をする場合は、ログインしてください') }}</p>
        @endif
        <div class="cartWrap">
            @if (isset($cart) && count($cart) > 0)
            <form action="{{ route('cart-delivery') }}" method="POST">
                @csrf
                @foreach($cart as $key => $item)
                    <article class="cartCard">
                        <h2 class="cartCard__headline">{{ $item['name'] }}</h2>
                        <img src="{{ asset('/storage/uploads/') . '/' . $item['image'] }}" alt="{{ $item['name'] }}の画像">
                        <dl><dt>価格(税込)</dt><dd>{{ $item['currentPrice'] }}</dd></dl>
                        <dl>
                            <dt>個数</dt>
                            <dd>
                                <input name="{{ 'num' . $key }}" type="number" min="1" max="20" value="{{ $item['num'] }}">
                            </dd></dl>
                            <a target="_blank" href="{{ route('detail') . '/' . $key }}">商品詳細</a>
                            <a onclick="deleteConfirm('{{ $item['name'] }}',{{ $key }})" href="#">削除</a>
                            <input name="{{ 'name' . $key }}" type="hidden" value="{{ $item['name'] }}">
                            <input name="{{ 'image' . $key }}" type="hidden" value="{{ $item['image'] }}">
                            <input name="{{ 'currentPrice' . $key }}" type="hidden" value="{{ $item['currentPrice'] }}">
                    </article>
                @endforeach
                <p>合計金額：{{ $total }}円（税込）</p>
                @if (isset($auth))
                    <input name="total" type="hidden" value="{{ $total }}">
                    <button type="submit">お届け先情報入力へ</button>
                @else
                    <a href="{{ route('login') }}">購入にはログインが必要です。</a>
                @endif
            </form>
            <form id="deleteForm" action="{{ route('cart-delete') }}" method="POST">
                @csrf
            </form>
            @else
                <p>現在、カートに商品は入っていません。</p>
                <a href="{{ route('home') }}" class="button">商品一覧へ</a>

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
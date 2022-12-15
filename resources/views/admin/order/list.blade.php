@extends('layouts.adminbase')

@section('content')
<section class="inner">
@if(session('status'))
    <p class="messageStatus">受注番号{{ session('status') }}のステータスを進めました。</p>
@endif
@if(session('cancel'))
    <p class="messageStatus">受注番号{{ session('cancel') }}をキャンセル処理しました。</p>
@endif

    <h2 class="headlineBar mt40 mb20">{{ __('受注一覧') }}</h2>
    @if (count($orders) > 0)
        @foreach($orders as $order)
            <article class="cardAdmin cardAdmin--order cardAdmin--{{ $order->status }}" id="product{{ $order->id }}">
                <h3 class="cardAdmin__id">{{ $order->id }}</h3>
                <div class="cardAdmin__status">
                @if($order->status == 'yet')
                    <p>{{__('未対応') }}</p>
                @endif
                @if($order->status == 'reply')
                    <p>{{ __('連絡済み') }}</p>
                @endif
                @if($order->status == 'pay')
                    <p>{{ __('決済済み') }}</p>
                @endif
                @if($order->status == 'send')
                    <p>{{ __('発送済み') }}</p>
                @endif
                @if($order->status == 'end')
                    <p>{{ __('終了') }}</p>
                @endif
                @if($order->status == 'cancel')
                    <p>{{ __('中断') }}</p>
                @endif
                </div>
                <div class="cardAdmin__user">
                    <h4>{{ __('購入ユーザー') }}</h4>
                    <p>{{ $order->user_name }}</p>
                </div>
                <div class="cardAdmin__user">
                    <h4>{{ __('購入ユーザーメールアドレス') }}</h4>
                    <p>{{ $order->user_email }}</p>
                </div>
                <div class="cardAdmin__product">
                    <h4>{{ __('商品名') }}</h4>
                    <p>{{ $order->product_name }}</p>
                </div>
                <div class="cardAdmin__product">
                    <h4>{{ __('購入金額') }}</h4>
                    <p>{{ $order->prices }}</p>
                </div>
                <div class="cardAdmin__product">
                    <h4>{{ __('購入個数') }}</h4>
                    <p>{{ $order->count }}</p>
                </div>
                <div class="cardAdmin__product">
                    <h4>{{ __('合計金額') }}</h4>
                    <p>{{ $order->prices * $order->count }}</p>
                </div>
                <div class="cardAdmin__product">
                    <h4>{{ __('購入日時') }}</h4>
                    <p>{{ $order->bought_data }}</p>
                </div>
                <div class="cardAdmin__delivery">
                    <h4>{{ __('お届け先お名前') }}</h4>
                    <p>{{ $order->delivery_name }}</p>
                </div>
                <div class="cardAdmin__delivery">
                    <h4>{{ __('お届け先郵便番号') }}</h4>
                    <p>{{ $order->delivery_address }}</p>
                </div>
                <div class="cardAdmin__delivery">
                    <h4>{{ __('電話番号') }}</h4>
                    <p>{{ $order->delivery_tel }}</p>
                </div>
                <div class="cardAdmin__delivery">
                    <h4>{{ __('メールアドレス') }}</h4>
                    <p>{{ $order->delivery_mail }}</p>
                </div>
                <div class="cardAdmin__button--flex">
                    <form class="mr20" action="{{ route('order-status') . '/' . $order->id }}" method="POST">
                        @csrf
                        <button type="submit" class="buttonRound buttonRound--blue">{{ __('ステータスを進める') }}</button>
                    </form>  
                    <form action="{{ route('order-cancel') . '/' . $order->id }}" method="POST">
                        @csrf
                        <button type="submit" class="buttonRound buttonRound--gray">{{ __('キャンセル処理') }}</button>
                    </form>
                </div>
            </article>
        @endforeach
    @endif

</section>
@endsection
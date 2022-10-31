@extends('layouts.app')

@section('content')
<section class="Wrapper">
    <div class="inner">
        <div class="cartWrap">
            <p class="caption mt30">ご購入ありがとうございました。<br>
            ご指定のメールアドレスにメールを送信しました。</p>
            <p class="caption mt30 mb30">メールが届いていないようでしたら、4leafclover1214@gmai.comまでお問い合わせください。</p>
            <a class="buttonRound" href="{{ route('home') }}" class="button">商品一覧へ</a>
        </div>
    </div>
</section>
@endsection
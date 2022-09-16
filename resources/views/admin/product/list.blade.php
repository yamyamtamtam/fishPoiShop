@extends('layouts.adminbase')

@section('content')
<section>
    <h2 class="headLineAdminMain">商品一覧</h2>
    <article class="cardAdmin">
        <h3 class="cardAdmin__title">商品title</h3>
        <div class="cardAdmin__price">
            <h4>価格</h4>
            <p>1,000</p>
        </div>
        <div class="cardAdmin__price">
            <h4>セール価格</h4>
            <p>500</p>
        </div>
        <div class="cardAdmin__code">
            <h4>商品コード</h4>
            <p>000000</p>
        </div>
        <div class="cardAdmin__cat">
            <h4>カテゴリ</h4>
            <p>カテゴリ01</p>
        </div>
        <div class="cardAdmin__image">
            <h4>画像</h4>
            <img src="#" alt="">
        </div>
        <div class="cardAdmin__cat">
            <h4>商品説明</h4>
            <p>説明文が入ります。説明文が入ります。説明文が入ります。</p>
        </div>        
    <article>

</section>
@endsection
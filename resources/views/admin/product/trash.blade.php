@extends('layouts.adminbase')

@section('content')
<section class="inner">
    <h2 class="headlineBar mt40 mb20">{{ __('ゴミ箱に入っている商品一覧') }}</h2>
    @if (count($products) > 0)
        @foreach($products as $product)
            <article class="cardAdmin" id="product{{ $product->id }}">
                <h3 class="cardAdmin__title">{{ $product->name }}</h3>
                <div class="cardAdmin__price">
                    <h4>{{ __('価格') }}</h4>
                    <p>{{ $product->price }}</p>
                </div>
                <div class="cardAdmin__price">
                    <h4>{{ __('セール価格') }}</h4>
                    <p>{{ $product->sale }}</p>
                </div>
                <div class="cardAdmin__code">
                    <h4>{{ __('商品コード') }}</h4>
                    <p>{{ $product->code }}</p>
                </div>
                <!--
                <div class="cardAdmin__cat">
                    <h4>カテゴリ</h4>
                    <p></p>
                </div>
                -->
                <div class="cardAdmin__image">
                    <h4>{{ __('画像') }}</h4>
                    <img src="{{ asset('/storage/' . $product->image) }}" alt="{{ $product->name }}の画像">
                </div>
                <div class="cardAdmin__cat">
                    <h4>{{ __('商品説明') }}</h4>
                    <p>{{ $product->description }}</p>
                </div>  
                <div class="cardAdmin__button">
                    <a class="buttonRound buttonRound--blue mb10" href="#" onclick="deleteReturn('{{ $product->id }}')">
                        {{ __('元に戻す') }}
                    </a>
                    <form id="return-form{{ $product->id }}" action="{{ route('product-delete-return') . '/' . $product->id }}" method="POST">
                        @csrf
                    </form>
                    <a class="buttonRound buttonRound--gray" href="#" onclick="deleteConfirm('{{ $product->id }}')">
                        {{ __('完全に削除') }}
                    </a>
                    <form id="delete-form{{ $product->id }}" action="{{ route('product-delete-complete') . '/' . $product->id }}" method="POST">
                        @csrf
                    </form>
                </div>
            </article>
        @endforeach
    @endif

</section>
<script>
const deleteReturn = (id) => {
    document.getElementById('return-form' + id).submit();
}
const deleteConfirm = (id) => {
    document.getElementById('delete-form' + id).submit();
}
</script>
@endsection
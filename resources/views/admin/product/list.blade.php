@extends('layouts.adminbase')

@section('content')
<section class="inner">
@if(session('store'))
    <p class="messageStatus">{{ session('store') }}を登録しました。</p>
@endif
@if(session('edit'))
    <p class="messageStatus">{{ session('edit') }}の内容を変更しました。</p>
@endif
@if(session('delete'))
    <p class="messageStatus">{{ session('delete') }}をゴミ箱に入れました。</p>
@endif
@if(session('return'))
    <p class="messageStatus">{{ session('delete') }}をゴミ箱から元に戻しました。</p>
@endif
    <h2 class="headlineBar mt40 mb20">{{ __('商品一覧') }}</h2>
    <a class="textLink mb30" href="{{ route('product-trash') }}"> {{ __('ごみ箱') }}</a>
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
                    <img src="{{ asset('/storage/uploads/' . $product->image) }}" alt="{{ $product->name }}の画像">
                </div>
                <div class="cardAdmin__caption">
                    <h4>{{ __('商品説明') }}</h4>
                    <p>{{ $product->description }}</p>
                </div>
                <div class="cardAdmin__button">
                    <a class="buttonRound buttonRound--blue mb10" href="{{ route('product-edit-view') . '/' . $product->id }}">{{ __('編集') }}</a>  
                    <a class="buttonRound buttonRound--gray" href="#" onclick="deleteConfirm('{{ $product->name }}','{{ $product->id }}')">
                        {{ __('削除') }}
                    </a>
                    <form id="deleteForm{{ $product->id }}" action="{{ route('product-delete') . '/' . $product->id }}" method="POST">
                        @csrf
                    </form>
                </div>
            </article>
        @endforeach
    @endif

</section>
<script>
const deleteConfirm = (name,id) => {
   const result = window.confirm(name + 'を削除してもよろしいですか？');
   if(result){
        document.getElementById('deleteForm' + id).submit();
   }else{
        return;
   }
}
</script>
@endsection
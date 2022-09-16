@extends('layouts.adminbase')

@section('content')
<section>
    <h2 class="headLineAdminMain">商品を新規登録</h2>
    <form action="{{ route('product-store') }}" method="POST">
        <label for="book_name">{{ __('本の名称') }}<span class="required">{{ __('必須') }}</span></label>
        <input type="text" class="formText" name="productName">
        <button type="submit" class="button button--submit">
            {{ __('登録') }}
        </button>
    </form>
</section>
@endsection
ご注文がありました。<br>
数日以内に {{ $mail }} へ振込先情報を返信してください。<br>
<br><br>
【注文内容】<br>
@foreach($cart as $item)<br>
    商品：{{ $item['name'] }}<br>
    価格(税込)：{{ $item['currentPrice'] }}<br>
    個数：{{ $item['num'] }}<br>
    ------------------------<br>
@endforeach
お名前：{{ $name }}様<br>
合計金額：{{ $total }}円（税込）<br>
郵便番号：{{ $postal }}<br>
住所：{{ $address }}<br>
電話番号：{{ $tel }}

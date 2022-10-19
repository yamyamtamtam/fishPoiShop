{{ $name }}様<br>
<br><br>
ご注文いただきありがとうございます。<br>
<br>
数日以内に、4leafclover1214@gmailのメールアドレスから振り込み先情報のメールが届きます。<br>
その後、振り込み確認出来次第、商品を発送いたします。<br>
<br>
【注文内容】<br>
@foreach($cart as $item)
    商品：{{ $item['name'] }}<br>
    価格(税込)：{{ $item['currentPrice'] }}<br>
    個数：{{ $item['num'] }}<br>
    ------------------------<br>
@endforeach
合計金額：{{ $total }}円（税込）<br>
郵便番号：{{ $postal }}<br>
住所：{{ $address }}<br>
電話番号：{{ $tel }}

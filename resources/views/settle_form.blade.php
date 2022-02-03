<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Iris</title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
        <link rel="icon" type="image/png" href="../img/favicon.png" sizes="16x16">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Clamp.js/0.5.1/clamp.min.js"></script>
    </head>
    <body>
        <div id="content">
            <img src="../../img/logo.png" class="logo td1s none">
            <div class="form_name td2s none">決済フォーム</div>

            <div class="pay_price td3s none">
                購入金額：<div class="pay_int">1,000</div> USDT
            </div>

            @if(!Session::has('id'))
            <form name="pay_form" action="{{ route('confirm_post') }}" method="post" enctype="multipart/form-data">
                {{ Form::hidden('id', session('id')) }}
                @csrf
                <div class="form_item form_1 td4s none">
                    <div class="item_name">送信先アドレス</div>
                    <input class="item_text send_address" type="text" value="TBriYPJD2a3xErDmezTeB75DMxV8WTdN9x" readonly>
                </div>
                <img src="../../img/qr.png" class="qr td5s none">
                <div class="button_form">
                    <a href="#" onclick="clickPaymentButton()">お支払い完了の方はこちら</a>
                </div>
            </form>
            @endif
        </div>

    </body>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
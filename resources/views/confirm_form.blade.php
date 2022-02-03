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
            <div class="form_name td2s none">お支払い確認</div>

            <form class="txid_form" name="txid_form" action="{{ route('txid_store') }}" method="post" enctype="multipart/form-data">
                @if(!is_null(old('id')))
                {{ Form::hidden('id', old('id')) }}
                @else
                {{ Form::hidden('id', session('id')) }}
                @endif
                @csrf
                @if($errors->has('txid'))
                <div class="error_message td3s none">{{ $errors->first('txid') }}</div>
                @endif
                <div class="form_item form_1 td3s none">
                    <div class="item_name">TXID</div>
                    {{ Form::text('txid', old('txid'), ['class' => 'item_text', 'maxlength' => 50]) }}
                </div>
                <div class="txid_explain td4s none">上記にお支払いのTXIDをご入力下さい。</div>
                <div class="button_form td5s none">
                    <a href="#" onclick="clickTxidButton()">TXIDを送信する</a>
                </div>
            </form>
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
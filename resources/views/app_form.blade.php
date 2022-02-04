<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Iris</title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="icon" type="image/png" href="../img/favicon.png" sizes="16x16">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="content">
            <img src="../../img/logo.png" class="logo td1s none">
            <div class="form_name td2s none">お申込みフォーム</div>

            <form name="app_form" action="{{ route('app_store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if($errors->has('name'))
                <div class="error_message td3s none">{{ $errors->first('name') }}</div>
                @endif
                @if($errors->has('address'))
                <div class="error_message td3s none">{{ $errors->first('address') }}</div>
                @endif
                @if($errors->has('tel'))
                <div class="error_message td3s none">{{ $errors->first('tel') }}</div>
                @endif
                @if($errors->has('mail'))
                <div class="error_message td3s none">{{ $errors->first('mail') }}</div>
                @endif
                <div class="form_item form_1 td3s none">
                    <div class="item_name">お名前</div>
                    {{ Form::text('name', old('name'), ['class' => 'item_text', 'maxlength' => 20]) }}
                </div>
                <div class="form_item form_2 td4s none">
                    <div class="item_name">住所</div>
                    {{ Form::text('address', old('address'), ['class' => 'item_text', 'maxlength' => 100]) }}
                </div>
                <div class="form_item form_3 td5s none">
                    <div class="item_name">電話番号</div>
                    {{ Form::text('tel', old('tel'), ['class' => 'item_text', 'maxlength' => 15]) }}
                </div>
                <div class="form_item form_4 td6s none">
                    <div class="item_name">メールアドレス</div>
                    {{ Form::text('mail', old('mail'), ['class' => 'item_text', 'maxlength' => 100]) }}
                </div>
                <div class="form_item form_5 td7s none">
                    <div class="item_name">紹介コード</div>
                    {{ Form::text('code', old('code'), ['class' => 'item_text', 'maxlength' => 30]) }}
                </div>
                <div class="button_form td8s none">
                    <a href="#" onclick="clickRegistButton()">決済ページへ</a>
                </div>
            </form>
        </div>

    </body>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
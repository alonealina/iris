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
            <div class="reminder_content">
                <img src="{{ asset('img/login_logo.png') }}" class="login_logo" alt="">

                @if($errors->has('name'))
                <div class="error_message td3s none">{{ $errors->first('name') }}</div>
                @endif
                @if($errors->has('mail'))
                <div class="error_message td3s none">{{ $errors->first('mail') }}</div>
                @endif
                @if($errors->has('tel'))
                <div class="error_message td3s none">{{ $errors->first('tel') }}</div>
                @endif
                @if($errors->has('uid'))
                <div class="error_message td3s none">{{ $errors->first('uid') }}</div>
                @endif

                <div class="forget_explain">
                    下記項目を全てご入力いただき、<br>
                    送信ボタンを押してください。
                </div>

                <form action="{{ url('forget_mail') }}" method="post">
                    @csrf  
                    <div class="form-group">
                        <div class="reminder_form_name">名前</div>
                        <input type="text" class="form-control" name="name">
                    </div>     
                    <div class="form-group">
                        <div class="reminder_form_name">メールアドレス</div>
                        <input type="text" class="form-control" name="mail">
                    </div>     
                    <div class="form-group">
                        <div class="reminder_form_name">電話番号</div>
                        <input type="text" class="form-control" name="tel">
                    </div>     
                    <div class="form-group">
                        <div class="reminder_form_name">Bitget UID</div>
                        <input type="text" class="form-control" name="uid">
                    </div>     
                    <input type="submit" value="送信" class="btn login_button">  
                </form>
            </div>
        </div>

    </body>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
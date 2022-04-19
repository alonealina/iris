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
            <div class="dashboard">
                <div class="dashboard_header">
                    <img src="{{ asset('img/login_logo.png') }}" class="dashboard_logo" alt="">
                    <div class="logout_button">
                        <a href="{{ route('logout') }}">Logout</a>
                    </div>
                </div>

                <div class="dashboard_form_column">
                    <div class="dashboard_form_name">Your Bitget UID</div>
                    <input type="text" class="form-control" name="bitget_uid">
                </div>
                <div class="dashboard_form_column">
                    <div class="dashboard_form_name">API Key</div>
                    <input type="text" class="form-control" name="api_key">
                </div>
                <div class="dashboard_form_column">
                    <div class="dashboard_form_name">Secret Key</div>
                    <input type="text" class="form-control" name="secret_key">
                </div>

                <input type="submit" value="Connect" class="btn connect_button">
                @if(!$app->check_flg)
                <div class="payment_button">
                    <a href="{{ route('settle') }}">Payment</a>
                </div>
                @endif
                <div class="dashboard_button_column">
                    <div class="dashboard_form_name">API STATUS</div>
                    <div class="button_flex">
                        <div class="on_button @if(!$app->active_flg) opa04 @endif">
                            ACTIVE
                        </div>
                        <div class="off_button @if($app->active_flg) opa04 @endif">
                            NON ACTIVE
                        </div>
                    </div>
                </div>

                <div class="dashboard_button_column">
                    <div class="dashboard_form_name">Iris</div>
                    <div class="button_flex">
                        <div class="on_button">
                            ON
                        </div>
                        <div class="off_button">
                            OFF
                        </div>
                    </div>
                </div>

                <div class="dashboard_explain">
                    <div class="dashboard_explain_red">※注意事項※　よくお読みください</div>
                    ①Irisは接続口座の残高全てを元本として取引しますのでご注意ください。<br>
                    ②Iris稼働（ON点灯）中は接続口座の入出金は行わないようお願いいたします。<br>
                    万が一、入出金があった場合、システムが正常に稼働せず、損失を被る場合がございます。<br>
                    入出金の際は必ずIris稼働停止（OFF点灯時）に切り替え後に手続きをお願いいたします。<br>
                    ③Iris稼働停止（OFF点灯時）をする場合、その時点での保有ポジションは強制決済されますので、予めご了承ください。
                </div>
            </div>
            <div class="space"></div>
        </div>

    </body>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
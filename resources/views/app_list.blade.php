<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Iris管理ページ</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="icon" type="image/png" href="../img/favicon.png" sizes="16x16">
        <link href="{{ asset('css/app_admin.css') }}" rel="stylesheet">
    </head>


    <body>
        <header class="mb-4">
            <nav class="header_content">
                <a href="{{ route('admin.app_list') }}"><img src="../../img/logo_header.png" class="logo_header"></a>
                <div class="logout_button btn">
                    <a href="{{ route('admin.logout') }}">Logout</a>
                </div>
                <div class="page_title">申し込み管理ページ</div>
            </nav>
        </header>

        <form id="form" name="search_form" action="{{ route('admin.app_list') }}" method="get">
            <div class="delete_button btn">
                <a href="#" onclick="clickDeleteButton()">Delete</a>
            </div>
            <div class="check_button btn">
                <a href="#" onclick="clickCheckButton()">Check</a>
            </div>
            <div class="csv_button btn">
                <a href="{{ route('admin.csv_export') }}">CSV Export</a>
            </div>
            <div class="deleted_button btn">
                <a href="{{ route('admin.deleted_list') }}">Deleted</a>
            </div>
            <div class="checked_button btn">
                <a href="{{ route('admin.checked_list') }}">集計済み</a>
            </div>
            <div class="search_box">
                <a href="#" onclick="clickSearchButton()"><img src="../../img/search_btn.png" class="search_btn"></a>
                {{ Form::text('freeword', old('freeword'), ['class' => 'form_freeword', 'maxlength' => 50, 'placeholder' => 'キーワード検索']) }}
            </div>
        </form>

        <form id="boxes" name="app_list_form" action="{{ route('admin.app_list_update') }}" method="get">
            <div id="admin_content">
                <div class="app_list">
                    <div class="app_list_column border_bottom_column">
                        <div class="app_list_chk app_head">
                            <input type="checkbox" id="all">
                        </div>
                        <div class="app_list_name app_head">
                            <div class="app_item_name">お名前</div>
                        </div>
                        <div class="app_list_tel app_head">
                            <div class="app_item_name">電話番号</div>
                        </div>
                        <div class="app_list_mail app_head">
                            <div class="app_item_name">メールアドレス</div>
                        </div>
                        <div class="app_list_pass app_head">
                            <div class="app_item_name">パスワード</div>
                        </div>
                        <div class="app_list_code app_head">
                            <div class="app_item_name">紹介コード</div>
                        </div>
                        <div class="app_list_uid app_head">
                            <div class="app_item_name">Bitget UID</div>
                        </div>
                        <div class="app_list_api app_head">
                            <div class="app_item_name">API Key</div>
                        </div>
                        <div class="app_list_secret app_head">
                            <div class="app_item_name">Secret Key</div>
                        </div>
                        <div class="app_list_pass_t app_head">
                            <div class="app_item_name">取引パスワード</div>
                        </div>
                        <div class="app_list_txid app_head">
                            <div class="app_item_name app_item_main">TXID</div>
                        </div>
                        <div class="app_list_created app_head">
                            <div class="app_item_name">登録日時</div>
                        </div>
                        <div class="app_list_btn app_head">
                            <div class="app_item_name"></div>
                        </div>
                    </div>
                    @foreach($app_list as $app)
                    <div class="app_list_column">
                        <div class="app_list_chk app_item">
                            <input type="checkbox" name="chk[]" value="{{ $app->id }}">
                        </div>
                        <div class="app_list_name app_item">
                            <div class="app_item_name">{{ $app->name }}</div>
                        </div>
                        <div class="app_list_tel app_item">
                            <div class="app_item_name">{{ $app->tel }}</div>
                        </div>
                        <div class="app_list_mail app_item">
                            <div class="app_item_name">{{ $app->mail }}</div>
                        </div>
                        <div class="app_list_pass app_item">
                            <div class="app_item_name">{{ $app->pass }}</div>
                        </div>
                        <div class="app_list_code app_item">
                            <div class="app_item_name">{{ $app->code }}</div>
                        </div>
                        <div class="app_list_uid app_item">
                            <div class="app_item_name">{{ $app->uid }}</div>
                        </div>
                        <div class="app_list_api app_item">
                            <div class="app_item_name">{{ $app->api_key }}</div>
                        </div>
                        <div class="app_list_secret app_item">
                            <div class="app_item_name">{{ $app->secret_key }}</div>
                        </div>
                        <div class="app_list_pass_t app_item">
                            <div class="app_item_name">{{ $app->pass_t }}</div>
                        </div>
                        <div class="app_list_txid app_item">
                            <div class="app_item_name">{{ $app->txid }}</div>
                        </div>
                        <div class="app_list_created app_item">
                            <div class="app_item_name">{{ $app->created_at }}</div>
                        </div>
                        <div class="app_list_btn app_head">
                            @if ($app->active_flg)
                            <div class="on_button">
                                <a href="#">ACTIVE</a>
                            </div>
                            <div class="off_button opa04">
                                <a href="{{ route('admin.app_active', ['id' => $app->id, 'flg' => 0]) }}">NON ACTIVE</a>
                            </div>
                            @else
                            <div class="on_button opa04">
                                <a href="{{ route('admin.app_active', ['id' => $app->id, 'flg' => 1]) }}">ACTIVE</a>
                            </div>
                            <div class="off_button">
                                <a href="#">NON ACTIVE</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center app_paginate">
                {{ $app_list->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </form>

    </body>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
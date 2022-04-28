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
                <div class="page_title">Q&A管理ページ</div>
            </nav>
        </header>
        <div class="content_div regist_div" style="margin-top: 110px;">
            <div class="content_title">Q&A登録</div>

            <form id="boxes" name="app_list_form" action="{{ route('admin.faq_store') }}" method="get">
                @if($errors->has('title'))
                <div class="comment_error">{{ $errors->first('title') }}</div>
                @endif
                @if($errors->has('content'))
                <div class="comment_error">{{ $errors->first('content') }}</div>
                @endif

                @csrf
                <div class="flex_form_item">
                    <div class="flex_form_title">質問</div>
                    <div class="flex_form_content">
                        {{ Form::text('title', old('title'), ['class' => '', 'maxlength' => 20]) }}
                    </div>
                </div>

                <div class="flex_form_item">
                    <div class="flex_form_title">内容</div>
                    <div class="flex_form_content">
                        {{ Form::textarea('content', old('content'), ['class' => 'form-control notice_content_input', 'rows' => 10, 'maxlength' => 3000]) }}
                    </div>
                </div>

                <div class="regist_button">
                    <a href="#" onclick="clickRegistButton()">登録</a>
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
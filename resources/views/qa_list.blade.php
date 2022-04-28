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
                <a href="{{ route('admin.faq_list') }}"><img src="../../img/logo_header.png" class="logo_header"></a>
                <div class="logout_button btn">
                    <a href="{{ route('admin.logout') }}">Logout</a>
                </div>
                <div class="page_title">Q&A管理ページ</div>
            </nav>
        </header>

            <div id="admin_content">
                <div class="faq_list">
                    <div class="faq_list_column border_bottom_column">
                        <div class="faq_list_q app_head">
                            <div class="faq_item_name">質問</div>
                        </div>
                        <div class="faq_list_a app_head">
                            <div class="faq_item_name">内容</div>
                        </div>
                        <div class="faq_list_btn app_head">
                            <div class="faq_item_name"></div>
                        </div>
                    </div>
                    <div class="faq_list_column">
                        <div class="faq_list_q app_item">
                            <div class="faq_item_name">口座開設に関するルール</div>
                        </div>
                        <div class="faq_list_a app_item">
                            <div class="faq_item_name">
                                口座開設フォームから必要情報を入力頂くだけで口座開設が完了となり、
                                口座番号の発行が行われますが、口座開設に伴う必要書類は出金処理を行うまでに提出する必要があります。
                                また、口座開設に伴う必要書類は、身分証明証（運転免許証、パスポートなど）のコピー、
                                住所証明書（公共料金領収書、クレジットカード会社や携帯電話会社の請求書など）のコピーとなります。
                            </div>
                        </div>
                        <div class="faq_list_btn app_head">
                            <div class="faq_update_button">
                                <a href="#" onclick="clickRegistButton()">編集</a>
                            </div>
                            <div class="faq_delete_button">
                                <a href="#" onclick="clickRegistButton()">削除</a>
                            </div>
                        </div>
                    </div>
                    <div class="faq_list_column">
                        <div class="faq_list_q app_item">
                            <div class="faq_item_name">口座開設に関するルール</div>
                        </div>
                        <div class="faq_list_a app_item">
                            <div class="faq_item_name">
                                口座開設フォームから必要情報を入力頂くだけで口座開設が完了となり、
                                口座番号の発行が行われますが、口座開設に伴う必要書類は出金処理を行うまでに提出する必要があります。
                                また、口座開設に伴う必要書類は、身分証明証（運転免許証、パスポートなど）のコピー、
                                住所証明書（公共料金領収書、クレジットカード会社や携帯電話会社の請求書など）のコピーとなります。
                            </div>
                        </div>
                        <div class="faq_list_btn app_head">
                            <div class="faq_update_button">
                                <a href="#" onclick="clickRegistButton()">編集</a>
                            </div>
                            <div class="faq_delete_button">
                                <a href="#" onclick="clickRegistButton()">削除</a>
                            </div>
                        </div>
                    </div>
                    <div class="faq_list_column">
                        <div class="faq_list_q app_item">
                            <div class="faq_item_name">口座開設に関するルール</div>
                        </div>
                        <div class="faq_list_a app_item">
                            <div class="faq_item_name">
                                口座開設フォームから必要情報を入力頂くだけで口座開設が完了となり、
                                口座番号の発行が行われますが、口座開設に伴う必要書類は出金処理を行うまでに提出する必要があります。
                                また、口座開設に伴う必要書類は、身分証明証（運転免許証、パスポートなど）のコピー、
                                住所証明書（公共料金領収書、クレジットカード会社や携帯電話会社の請求書など）のコピーとなります。
                            </div>
                        </div>
                        <div class="faq_list_btn app_head">
                            <div class="faq_update_button">
                                <a href="#" onclick="clickRegistButton()">編集</a>
                            </div>
                            <div class="faq_delete_button">
                                <a href="#" onclick="clickRegistButton()">削除</a>
                            </div>
                        </div>
                    </div>
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
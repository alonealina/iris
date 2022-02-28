
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
      <div id="login_content">
        <div class="login_form" id="login_form">
          <img src="{{ asset('img/login_logo.png') }}" class="login_logo" alt="">
          {{-- エラーメッセージ --}}
          @if (session()->has('login_error'))
            <div id="error_explanation" class="text-danger">
              ログインIDまたはパスワードが一致しません。
            </div>
          @endif
          
          {{-- フォーム --}}
          <form action="{{ url('admin_login') }}" method="post">
            @csrf  
            <div class="form-group">
              <div class="login_form_name">Login ID</div>
              <input type="text" class="form-control" name="login_id">
            </div>     
            <div class="form-group">
            <div class="login_form_name">Password</div>
              <input type="password" class="form-control" id="user_password" name="password">
            </div>     
            <input type="submit" value="Login" class="btn login_button">  
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





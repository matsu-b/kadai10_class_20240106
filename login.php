<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ログイン</title>
    <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>
    <style>
    body {
        padding-top: 80px;
        padding-left: 30px;
    }
    input.form-control.short-input {
        width: auto; /* または具体的な幅（例：150px） */
        display: inline-block; /* ブロック要素としてではなくインラインブロック要素として表示 */
    }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="select.php">
                <img src="images/logo.png" alt="ロゴ" height="50" class="d-inline-block align-top">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
    </header>

    <!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
    <legend>ログイン</legend>
    <form name="form1" action="login_act.php" method="post" class="form-group">
        ID:<input type="text" name="lid"  class="form-control short-input"/>
        PW:<input type="password" name="lpw"  class="form-control short-input"/>
    <input type="submit" value="LOGIN" />
    </form>
    <br><p><a href="register.php">新規登録はこちらから</a></p>

</body>
</html>

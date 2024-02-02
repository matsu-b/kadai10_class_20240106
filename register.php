<?php 
// 0.Session Start
session_start();

// 1.DB接続
require_once('funcs.php');
$pdo = db_conn();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ユーザー登録</title>
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
        padding-bottom:30px;
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

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="select.php">商品一覧</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">商品登録</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">ログアウト</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- method, action, 各inputのnameを確認してください。 -->
    <form method="POST" action="register_insert.php" class="form-group">
        <div>
            <fieldset>
                <legend>新規ユーザー登録</legend>
                <label>名前：<input type="text" name="namename"  class="form-control"></label><br>
                <label>ID：<input type="text" name="idid"  class="form-control"></label><br>
                <label>パスワード：<input type="password" name="password"  class="form-control"></label><br><br>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
</body>
</html>
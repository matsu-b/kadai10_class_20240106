<?php 
// 0.Session Start
session_start();

// 1.DB接続
require_once('funcs.php');
$pdo = db_conn();
loginCheck();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>商品登録</title>
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
    select.form-control.short-select {
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

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="select.php">商品一覧</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">ユーザー登録</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">ログアウト</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <form method="POST" action="insert.php" enctype="multipart/form-data">
        <div class="form-group">
            <fieldset>
                <legend>新規商品登録</legend>
                <label>商品名：<input type="text" name="product_name" class="form-control"></label><br>
                <img id="preview"><br>
                <label>商品画像：<input type="file" name="img" accept="image/*" onchange="previewFile(this);" class="form-control"/><br><br>
                <label>カテゴリ：</label>
                    <select id="category" name="category" class="form-control short-select">
                        <option value=""></option>
                        <option value="ファッション">ファッション</option>
                        <option value="ベビー・キッズ">ベビー・キッズ</option>
                        <option value="インテリア・住まい・小物">インテリア・住まい・小物</option>
                        <option value="本・音楽・ゲーム">本・音楽・ゲーム</option>
                        <option value="おもちゃ・ホビー・グッズ">おもちゃ・ホビー・グッズ</option>
                        <option value="コスメ・香水・美容">コスメ・香水・美容</option>
                        <option value="家電・スマホ・カメラ">家電・スマホ・カメラ</option>
                        <option value="スポーツ・レジャー">スポーツ・レジャー</option>
                        <option value="フラワー・ガーデニング">フラワー・ガーデニング</option>
                        <option value="ハンドメイド">ハンドメイド</option>
                        <option value="チケット">チケット</option>
                        <option value="自動車・オートバイ">自動車・オートバイ</option>
                        <option value="食品">食品</option>
                        <option value="その他">その他</option>
                    </select><br>
                <label>商品説明：<textarea name="discription" rows="4" cols="40" class="form-control"></textarea></label><br>
                <label>金額：<input type="text" name="price" class="form-control"></label><br>
                <label>URL：<input type="text" name="url" class="form-control"></label><br>
            </fieldset>
        </div><br>
        <input type="submit" value="登録">
    </form>
</body>
</html>

<script>
  function previewFile(event){
    var fileData = new FileReader(); //FileReaderオブジェクトを作成
    fileData.onload = (function() { //ファイル読み込み完了時のイベントハンドラ（ファイルの読み込みとはreadAsDataURLのこと）
       document.getElementById('preview').src = fileData.result; // 読み込んだ画像データでプレビュー画像を更新
    });
    fileData.readAsDataURL(event.files[0]); // 選択されたファイルをDataURLとして読み込む
  }
</script>
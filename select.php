<?php
//【重要】
/**
 * DB接続のための関数をfuncs.phpに用意
 * require_onceでfuncs.phpを取得
 * 関数を使えるようにする。
 */
// 0.Session Start
session_start();

// 1.DB接続
require_once('funcs.php');
$pdo = db_conn();
loginCheck();

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_ecproducts;');
$status = $stmt->execute();

//３．データ表示
$view = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<div class="col-lg-4">';
        $view .= '<img class="img-responsive" src="' . 'images/' . $result['img_filename']. '" alt="' . $result['product_name'] . '">';
        $view .= '<ul class="list-group list-group-flush" style="max-width: 400px;">';
        $view .= '<li class="list-group-item">'.'商品名：'."{$result['product_name']}".'</li>'; // 文字列は、ダブルクオーテーション利用すると変数展開可能
        $view .= '<li class="list-group-item">'.'カテゴリ：'."{$result['category']}".'</li>';        
        $view .= '<li class="list-group-item">'.'商品説明：'."{$result['discription']}".'</li>';        
        $view .= '<li class="list-group-item">'.'金額：'."{$result['price']}".'円'.'</li>'; 
        $view .= '<li class="list-group-item">'.'URL：'.'<a href=" '.$result['url'].' ">';
        $view .= 'link';
        $view .= '</a>'.'</li>';
        $view .= '<button onclick="location.href=\'detail.php?id=' . $result['id'] . '\'" class="btn btn-dark short-btn">';
        $view .= '編集';
        $view .= '</button>';
        $view .= '</ul>';
        $view .= '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>商品一覧</title>
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
    button.btn.btn-dark.short-btn {
        width: 150px; /* または具体的な幅（例：150px） */
        display: inline-block; /* ブロック要素としてではなくインラインブロック要素として表示 */
        margin: 10px auto;
    }
    .img-responsive {
        max-width: 100%; /* 最大幅を100%に設定 */
        height: 200px; /* 高さを自動調整 */
        display: block; /* ブロックレベル要素として表示 */
        margin-bottom: 20px; /* 下にマージンを追加 */
        margin: 0 auto;
    }
    </style>
</head>

<body id="main">
    <!-- Head[Start] -->
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
                        <a class="nav-link" href="index.php">商品登録</a>
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
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <legend>商品一覧</legend>
    <div>
        <div class="container-fluid">
            <div class="row">
            <table class="table">
            <a href="detail.php"></a>
            <?= $view ?>
            </table>
        </div>
    </div>
    <!-- Main[End] -->

</body>
</html>
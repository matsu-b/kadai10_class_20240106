<?php
/**
 * [ここでやりたいこと]
 * 1. クエリパラメータの確認 = GETで取得している内容を確認する
 * 2. select.phpのPHP<?php ?>の中身をコピー、貼り付け
 * 3. SQL部分にwhereを追加
 * 4. データ取得の箇所を修正。
*/

// 0.Session Start
session_start();

// 1.DB接続
require_once('funcs.php');
$pdo = db_conn();
loginCheck();

// 2.select.phpから送られてくる対象のIDを取得
$id = $_GET['id'];

//3．データ登録SQL作成
// WHERE id=:idを利用して、１つだけ情報を取得してください。
$stmt = $pdo->prepare('SELECT * FROM gs_ecproducts WHERE id=:id;');
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ表示
$result = '';
if ($status === false) {
    //*** function化する！******\
    sql_error($stmt);
} else {
    $result = $stmt->fetch();
}
?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
(入力項目は「登録/更新」はほぼ同じになるから)
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>データ登録</title>
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
    .img-responsive {
        max-width: 100%; /* 最大幅を100%に設定 */
        height: 200px; /* 高さを自動調整 */
        display: block; /* ブロックレベル要素として表示 */
        margin-bottom: 20px; /* 下にマージンを追加 */
    }
    </style>
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

    <form method="POST" action="update.php" enctype="multipart/form-data" class="form-group">
        <div>
            <fieldset>
                <legend>商品編集画面</legend>
                <label>商品名：<input type="text" name="product_name" value="<?= $result['product_name'] ?>" class="form-control"></label><br>
                <img id="preview" src="images/<?= $result['img_filename'] ?>" class="img-responsive"><br>
                <a href="delete_photo.php?id=<?= $result['id'].'&img_filename='.$result['img_filename'] ?>">[画像削除]</a><br><br>
                <label>商品画像：<input type="file" name="img" accept="image/*" onchange="previewFile(this);"  class="form-control"/></label><br>
                <label>カテゴリ：
                    <select name="category"  class="form-control">
                        <option value="ファッション" <?= $result['category'] == 'ファッション' ? 'selected' : '' ?>>ファッション</option>
                        <option value="ベビー・キッズ" <?= $result['category'] == 'ベビー・キッズ' ? 'selected' : '' ?>>ベビー・キッズ</option>
                        <option value="インテリア・住まい・小物" <?= $result['category'] == 'インテリア・住まい・小物' ? 'selected' : '' ?>>インテリア・住まい・小物</option>
                        <option value="本・音楽・ゲーム" <?= $result['category'] == '本・音楽・ゲーム' ? 'selected' : '' ?>>本・音楽・ゲーム</option>
                        <option value="おもちゃ・ホビー・グッズ" <?= $result['category'] == 'おもちゃ・ホビー・グッズ' ? 'selected' : '' ?>>おもちゃ・ホビー・グッズ</option>
                        <option value="コスメ・香水・美容" <?= $result['category'] == 'コスメ・香水・美容' ? 'selected' : '' ?>>コスメ・香水・美容</option>
                        <option value="家電・スマホ・カメラ" <?= $result['category'] == '家電・スマホ・カメラ' ? 'selected' : '' ?>>家電・スマホ・カメラ</option>
                        <option value="スポーツ・レジャー" <?= $result['category'] == 'スポーツ・レジャー' ? 'selected' : '' ?>>スポーツ・レジャー</option>
                        <option value="フラワー・ガーデニング" <?= $result['category'] == 'フラワー・ガーデニング' ? 'selected' : '' ?>>フラワー・ガーデニング</option>
                        <option value="ハンドメイド" <?= $result['category'] == 'ハンドメイド' ? 'selected' : '' ?>>ハンドメイド</option>
                        <option value="チケット" <?= $result['category'] == 'チケット' ? 'selected' : '' ?>>チケット</option>
                        <option value="自動車・オートバイ" <?= $result['category'] == '自動車・オートバイ' ? 'selected' : '' ?>>自動車・オートバイ</option>
                        <option value="食品" <?= $result['category'] == '食品' ? 'selected' : '' ?>>食品</option>
                        <option value="その他" <?= $result['category'] == 'その他' ? 'selected' : '' ?>>その他</option>
                    </select>
                </label><br>
                <label>商品説明：<textarea name="discription" rows="4" cols="40" class="form-control"><?= $result['discription'] ?></textarea></label><br>
                <label>金額：<input type="text" name="price" value="<?= $result['price'] ?>"  class="form-control"></label><br>
                <label>URL：<input type="text" name="url" value="<?= $result['url'] ?>" class="form-control"></label><br>
                <input type="hidden" name="id" value="<?= $result['id'] ?>" class="form-control"><br>
                <a href="delete_all.php?id=<?= $result['id'] ?>" class="btn btn-danger short-btn">削除</a>
                <button type="submit" class="btn btn-dark short-btn">
                    更新
                </button>
            </fieldset>
        </div>
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


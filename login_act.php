<?php
//0.SessionStart
session_start();
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];

//1.関数読み込み
require_once('funcs.php');
$pdo = db_conn();

//2. gs_user_tableに、IDとWPがあるか確認する。
$stmt = $pdo->prepare('SELECT * FROM gs_user_table WHERE lid = :lid AND lpw = :lpw;');
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status === false) {
    sql_error($stmt);
    echo 'SQL実行時にエラーがあります';
}

//4. データを取得
// fetchという関数を使うと1レコードだけを配列で取得することができる
$val = $stmt->fetch();;

// 5. ログイン認証処理
//if(password_verify($lpw, $val['lpw'])){ //* PasswordがHash化の場合はこっちのIFを使う
if( $val['id'] != ''){
    //Login成功時 該当レコードがあればSESSIONに値を代入
    $_SESSION['chk_ssid'] = session_id();
    $_SESSION['kanri_flg'] = $val['kanri_flg'];
    $_SESSION['name'] = $val['name'];
    header('Location: select.php');
} else {
    //Login失敗時(Logout経由)
    header('Location: login.php');
}
exit();
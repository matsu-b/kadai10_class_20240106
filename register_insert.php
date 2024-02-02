<?php

//1. POSTデータ取得
$namename = $_POST['namename'];
$idid = $_POST['idid'];
$password = $_POST['password'];

// $hashed_pw = password_hash($password, PASSWORD_DEFAULT); 

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare(
    'INSERT INTO
    gs_user_table(id, name, lid, lpw, kanri_flg, life_flg)
    VALUES (NULL, :namename, :idid, :hashed_pw, NULL, NULL);'
);

// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':namename', $namename, PDO::PARAM_STR);
$stmt->bindValue(':idid', $idid, PDO::PARAM_STR);
$stmt->bindValue(':hashed_pw', $password, PDO::PARAM_STR); //PARAM_INTなので注意
// $stmt->bindValue(':hashed_pw', $hashed_pw, PDO::PARAM_STR); //PARAM_INTなので注意、hash化している場合はこのコードを使う
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    //*** function化する！******\
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    //*** function化する！*****************
    header('Location: select.php');
    exit();
}
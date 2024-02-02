<?php
//XSS対応（ echoする場所で使用！）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}


//必要なパッケージを自動で読み込むための記述
require __DIR__ . '/vendor/autoload.php';
//phpdotenvの機能を使って__DIR__=ファイルの存在する階層にある.envを指定する
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
//.env中の設定値をロードし、$_ENVとして使用できるようにする
$dotenv->load();

//DB接続関数：db_conn() 
//※関数を作成し、内容をreturnさせる。
//※ DBname等、今回の授業に合わせる。
function db_conn()
{
    try {
        $db_name = $_ENV['DB_NAME']; //データベース名
        $db_id   = $_ENV['DB_ID']; //アカウント名
        $db_pw   = $_ENV['DB_PASS']; //パスワード：MAMP'root'
        $db_host = $_ENV['DB_HOST']; //DBホスト
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        // return $pdo;を忘れないように。 
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}

//SQLエラー関数：sql_error($stmt)
function sql_error($stmt)
{
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
}

//リダイレクト関数: redirect($file_name)
function redirect($file_name)
{
    header('Location: ' . $file_name );
    exit();
}

// ログインチェク処理 loginCheck()
function loginCheck() {
    if (  !isset($_SESSION['chk_ssid'])  ||  $_SESSION['chk_ssid']  !==  session_id()  ) {
        exit('ログインしてください'.'<br><br><a class="navbar-brand" href="login.php">ログイン</a>'.'<br><br><a class="navbar-brand" href="register.php">新規登録はこちらから</a>');
    } else {
        // ログイン済み処理
        session_regenerate_id(true);
        $_SESSION['chk_ssid'] = session_id();
    }
}
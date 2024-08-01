<?php

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続
function db_conn()
{
　$prod_db = "kazucahxx_kadai10-4_phpdbc";
　$prod_host = "mysql642.db.sakura.ne.jp";
　$prod_id = "kazucahxx";
　$prod_pw = "SKkazuki1234-";
    try {
        $pdo = new PDO('mysql:dbname=' . $prod_db . ';charset=utf8;host=' . $prod_host, $prod_id, $prod_pw);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}

//SQLエラー
function sql_error($stmt)
{
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('SQLError:' . $error[2]);
}

//リダイレクト
function redirect($file_name)
{
    header('Location: ' . $file_name);
    exit();
}


// ログインチェク処理 loginCheck()
function loginCheck()
{
    if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] !== session_id()) {
        exit('LOGIN ERROR');
    }
    session_regenerate_id(true);
    $_SESSION['chk_ssid'] = session_id();
}
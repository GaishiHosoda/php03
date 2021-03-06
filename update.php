<?php
//insert.phpの処理を持ってくる
//1. POSTデータ取得
$name   = $_POST["name"];
$email  = $_POST["email"];
$content = $_POST["content"];
$id = $_POST["id"];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare( "UPDATE gs_an_table SET name = :name, email = :email, content = :content, indate = sysdate() WHERE id = :id;" );

$stmt->bindValue(':name', $name, PDO::PARAM_STR);/// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':email', $email, PDO::PARAM_STR);// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':content', $content, PDO::PARAM_STR);// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':id', $id, PDO::PARAM_INT);// 数値の場合 PDO::PARAM_INT
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect('select.php');
}

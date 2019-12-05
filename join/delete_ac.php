<?php
session_start();
include("../funcs.php");
// chkSsid();
$pdo = db_conn();
//未完

//1. POSTデータ取得
$id = $_SESSION["id"];

//2. DB接続します
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成(postテーブルのもの)
$stmt = $pdo->prepare("DELETE FROM posts WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error();
}else{
  redirect("main.php");
}
?>
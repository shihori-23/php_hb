<?php
session_start();
//1. POSTデータ取得
$id     = $_POST["id"];
$comment     = $_POST["comment"];
$staff_id     = $_POST["staff_id"];

//2. DB接続します
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE posts SET comment=:comment ,staff_id=:staff_id WHERE id=:id");
$stmt->bindValue(':comment',$comment,PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':staff_id',$staff_id,PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id',$id,PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error();
}else{
  redirect("main_st.php");
}
?>
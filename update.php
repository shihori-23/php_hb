<?php
session_start();
//1. POSTデータ取得
$salon   = $_POST["salon"];
$menu  = $_POST["menu"];
$id     = $_POST["id"];

//2. DB接続します
include("funcs.php");
$pdo = db_conn();

if (isset($_FILES)){
$image = fileUpload("upfile","member_pic/"); //戻り値：0=ファイル名,1=NG,2=NG
if($image==1 || $image==2){
    $img ="アップロード失敗";
}else{
    $img = $image; //ファイル名
    $stmt = $pdo->prepare("UPDATE posts SET img=:img WHERE id=:id");
    $stmt->bindValue(':img', $img, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':id',$id,PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
    $status = $stmt->execute(); //実行
}
}

//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE posts SET salon=:salon,menu=:menu WHERE id=:id");
$stmt->bindValue(':salon',   $salon,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':menu',  $menu,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id',     $id,     PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error();
}else{
  redirect("main.php");
}
?>
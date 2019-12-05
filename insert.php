<?php
// セッションを使用するおまじない
session_start();

//入力画面を介さずにcheck.phpを呼び出した場合、input.phpに戻る 
if(!isset ($_SESSION['join'])){
	header('Location: index.php');
	// 終了のおまじない
	exit(); 
}

//SESSION値
// $member_id = $_SESSION['join']['user_id'];
$salon = $_SESSION['join']['salon'];
$date = $_SESSION['join']['date'];
$menu = $_SESSION['join']['menu'];
$img = $_SESSION['join']['image'];
$share_flg = $_SESSION['join']['share_flg'];
$id = $_SESSION['id'];


// ファンクション関数を呼び出す
include('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO posts(salon,date,menu,img,share_flg,member_id)VALUES(:salon,:date,:menu,:img,:share_flg,:member_id)");
$stmt->bindValue(':salon', $salon, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':date', $date, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':menu', $menu, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':img', $img, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':share_flg', $share_flg	, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':member_id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':member_id', $member_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//3. SQL実行時にエラーがある場合STOP
if($status==false){
  sql_error();
}else{
  redirect("main.php");
}
?>

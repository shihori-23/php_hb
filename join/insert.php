<?php
// セッションを使用するおまじない
session_start();

//入力画面を介さずにcheck.phpを呼び出した場合、input.phpに戻る 
if(!isset ($_SESSION['join'])){
	header('Location: input.php');
	// 終了のおまじない
	exit(); 
}

//SESSION値
$name = $_SESSION['join']['name'];
$email = $_SESSION['join']['email'];
$lpw = $_SESSION['join']['lpw'];
//パスワードの暗号化
$pw = password_hash($lpw,PASSWORD_DEFAULT);

// ファンクション関数を呼び出す
include('../funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO user_id(name,email,lpw,date)VALUES(:name,:email,:lpw,sysdate())");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $pw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//3. SQL実行時にエラーがある場合STOP
if($status==false){
  sql_error();
}else{
  redirect("thanks.php");
}
?>

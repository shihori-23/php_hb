<?php
// セッションを使用するおまじない
session_start();
// chkSsid();

//入力画面を介さずにcheck.phpを呼び出した場合、input.phpに戻る 
if(!isset ($_SESSION['prof'])){
	header('Location: prof_input.php');
	exit(); 
}
//SESSION値
// $member_id = $_SESSION['join']['user_id'];
$id = $_SESSION['prof']['id'];
$name = $_SESSION['prof']['name'];
$kana = $_SESSION['prof']['kana'];
$birthday = $_SESSION['prof']['birthday'];
$sex = $_SESSION['prof']['sex'];
$tel = $_SESSION['prof']['tel'];
$email = $_SESSION['prof']['email'];
$postal = $_SESSION['prof']['zip11'];
$adress = $_SESSION['prof']['addr11'];
$other = $_SESSION['prof']['other'];

// ファンクション関数を呼び出す
include('../funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO profiles(name,kana,birthday,sex,tel,email,postal,adress,other,member_id)VALUES(:name,:kana,:birthday,:sex,:tel,:email,:postal,:adress,:other,:member_id)");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kana', $kana, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':birthday', $birthday, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':sex', $sex, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':tel', $tel, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':postal', $postal, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':adress', $adress, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':other', $other, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':member_id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':member_id', $member_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//3. SQL実行時にエラーがある場合STOP
if($status==false){
  sql_error();
}else{
  redirect("prof.php");
}
?>

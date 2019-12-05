<!-- アカウント登録 -->
<?php  
session_start();
include('../funcs.php');

$pdo = db_conn();
$email = $_POST['email']; 

// ポストされた時に入力エラーがないか確認
if (!empty($_POST)){

	// 項目に空白がないか確認
	if($_POST['name'] === ''){
	$error['name'] = 'blank';
	}
	if($_POST['email'] === ''){
	$error['email'] = 'blank';
	}
	// パスワードが４文字未満の時にエラーになる
	if(strlen($_POST['lpw']) < 4){
	$error['lpw'] = 'length';
	}
	if($_POST['lpw'] === ''){
	$error['lpw'] = 'blank';
  }

  //アカウントの重複をチェック
  if(empty($error)){
  $sql = 'SELECT COUNT(*) AS cnt FROM user_id WHERE email=:email';
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $status = $stmt->execute();
  $count = $stmt->fetch(); //SELECT COUNT(*)で使用可能()
    
    if($count['cnt'] > 0){
		$error['email'] = 'duplicate';
		}
	}
  // エラーがない場合の処理
 if (empty($error)) { 
	// 入力内容にエラーがない場合、セッションストレージに入力内容を保存
	$_SESSION['join'] = $_POST;
	header('Location: check.php');
	exit();
	}
}
  
  // 再編集で呼び出された時の処理
if ($_REQUEST['action'] == 'rewrite' && isset($_SESSION['join'])){
	$_POST =$_SESSION['join'];
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hair Karte</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700|Noto+Sans+JP:300,400,700&display=swap" rel="stylesheet">

   <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../css/style.css">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>


<!-- <form class="form-horizontal form_container" method="POST" action="insert.php"> -->
<form class="form-horizontal form_container" method="POST" action="">
     <legend class="title">Create Account</legend>
  <div class="form-group">

    <label>Name<?php if ($error['name'] === 'blank'): ?>
		<span class ="error">  ※ ユーザーネームを入力してください。</span>
		<?php endif; ?></label>
    <input class="form-control" type="text" name="name" placeholder="登録するアカウント名を入力してください"  value="<?php print(htmlspecialchars($_POST['name'],ENT_QUOTES)); ?>"><br>
     <label>Email<?php if ($error['email'] === 'blank'): ?>
		<span class ="error">  ※ メールアドレスを入力してください。</span>
    <?php endif; ?>
   <?php if ($error['email'] === 'duplicate'): ?>
		<span class ="error"> ※ 指定されたメールアドレスは既に登録されています。</span>
    <?php endif; ?>
  </label>
    <input class="form-control" type="text" name="email" placeholder="Email" value="<?php print(htmlspecialchars($_POST['email'],ENT_QUOTES)); ?>"><br>
     <!-- <label>LoginID</label><input class="form-control" type="text" name="lid"><br> -->
     <label>Password<?php if ($error['lpw'] === 'blank'): ?>
		<span class ="error">  ※ パスワードを入力してください。</span>
		<?php endif; ?>
    <?php if ($error['lpw'] === 'length'): ?>
		<span class ="error">  ※ 4文字以上で入力してください。</span>
		<?php endif; ?></label><input class="form-control" type="text" name="lpw" placeholder="Password"><br>
     <input type="submit" value="Sing up" class="btn btn-default form_btn">
  </div>
</form>

      <div class="">
      <div class="nav_container"><a href="../login/login.php" class="nav_btn">Sign in</a></div>
      </div>
<!-- Main[End] -->
<script src="js/jquery-2.1.3.min.js"></script>
<script
  src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
  crossorigin="anonymous"
></script>
<script
  src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
  integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
  crossorigin="anonymous"
></script>

</body>
<style>
/* * ヘッダー */
.header_flex {
  padding: 10px 20px;
  display: flex;
  justify-content: space-between;
}

.header_left {
  display: flex;
  justify-content: center;
}



</style>
</html>

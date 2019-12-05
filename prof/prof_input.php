<?php
session_start();
include("../funcs.php");
chkSsid();
$pdo = db_conn();
$id =	$_SESSION['id'];
// ポストされた時に入力エラーがないか確認
if (!empty($_POST)){

	// 項目に空白がないか確認
	if($_POST['name'] === ''){
	$error['name'] = 'blank';
	}
	if($_POST['kana'] === ''){
	$error['kana'] = 'blank';
	}
	if($_POST['birthday'] === ''){
	$error['birthday'] = 'blank';
	}
	if($_POST['sex'] === ''){
	$error['sex'] = 'blank';
	}
	if($_POST['tel'] === ''){
	$error['tel'] = 'blank';
	}
	if($_POST['email'] === ''){
	$error['email'] = 'blank';
	}
	if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
  }else{
  $error['email'] = 'duplicate';
  }
	if($_POST['zip11'] === ''){
	$error['zip11'] = 'blank';
	}
	if($_POST['addr11'] === ''){
	$error['addr11'] = 'blank';
  }
  
  // エラーがない場合の処理
 if (empty($error)) { 
	// 入力内容にエラーがない場合、セッションストレージに入力内容を保存
	$_SESSION['prof'] = $_POST;
	header('Location: prof_insert.php');
	exit();
	}
}  
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hair Karte</title>
   <link rel="stylesheet" href="../css/reset.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
   <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700|Noto+Sans+JP:300,400,700&display=swap" rel="stylesheet">
  	<link rel="stylesheet" href="../css/style.css">
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</head>
<body>

<!-- Head[Start] -->
<header>
  <div class="header_flex">
   <img class="logo_img" src="../img/logo.png" alt="ロゴ" width="150px" height="50px">
    <!-- <h1 class="app_h1">Hair Karte</h1> -->
    <div class="">
      <ul class="header_left">
        <li class="nav_icon"><img src="../img/alarm.png" alt="icon" height="30px" width="30px"></li>
        <a href="../login/logout.php"><li class="nav_icon"><img src="../img/door.png" alt="icon" height="30px" width="30px"></li></a>
      </ul>
    </div>
 </div>
  </header>
<!-- Head[End] -->
<div class="main_container">
<!-- Main[Start] -->
<form class="form-horizontal form_container" method="POST" action="">
  <div class="form-group">

    <legend class="title">Sign Up</legend>
    <label>Name<?php if ($error['name'] === 'blank'): ?>
		<span class ="error">  ※ お名前を入力してください。</span>
    <?php endif; ?></label><input class="form-control" type="text" name="name" placeholder="お名前を入力してください" value="<?php print(htmlspecialchars($_POST['name'],ENT_QUOTES)); ?>"><br>
    
    <label>Kana<?php if ($error['kana'] === 'blank'): ?>
		<span class ="error">  ※ ふりがなを入力してください。</span>
		<?php endif; ?></label>
    <input class="form-control" type="text" name="kana" placeholder="ふりがなを入力してください" value="<?php print(htmlspecialchars($_POST['kana'],ENT_QUOTES)); ?>"><br>

    <label>Birthday<?php if ($error['birthday'] === 'blank'): ?>
		<span class ="error">  ※ 生年月日を入力してください。</span>
		<?php endif; ?></label>
    <input class="form-control" type="text" name="birthday" placeholder="(例)2000/01/01" value="<?php print(htmlspecialchars($_POST['birthday'],ENT_QUOTES)); ?>"><br>

    <label>性別<?php if ($error['sex'] === 'blank'): ?>
		<span class ="error">  ※ 性別を選択してください。</span>
		<?php endif; ?></label><br>
		<input type="radio" name="sex" value="男性"> <span class="radio_g">男性</span>
		<input type="radio" name="sex" value="女性"> <span  class="radio_g">女性</span><br>

    <label>Tel<?php if ($error['tel'] === 'blank'): ?>
		<span class ="error">  ※ 電話番号を入力してください</span>
		<?php endif; ?></label>
    <input class="form-control" type="text" name="tel" placeholder="(例)090-1234-1234" value="<?php print(htmlspecialchars($_POST['tel'],ENT_QUOTES)); ?>"><br>

    <label>Email<?php if ($error['email'] === 'blank'): ?>
		<span class ="error">  ※ メールアドレスを入力してください</span>
    <?php endif; ?>
    <?php if ($error['email'] === 'duplicate'): ?>
		<span class ="error">  ※ 正確なアドレスを入力してください</span>
		<?php endif; ?>
    </label>
    <input class="form-control" type="text" name="email" placeholder="(例)test@gmail.com" value="<?php print(htmlspecialchars($_POST['email'],ENT_QUOTES)); ?>"><br>

    <label>Potal<?php if ($error['zip11'] === 'blank'): ?>
		<span class ="error">  ※ 郵便番号を入力してください</span>
		<?php endif; ?></label>
    <input class="form-control" type="text" name="zip11" maxlength="8" placeholder="(例)222-1234" value="<?php print(htmlspecialchars($_POST['zip11'],ENT_QUOTES)); ?>" onKeyUp="AjaxZip3.zip2addr(this,'','addr11','addr11');"><br>

    <label>Adress<?php if ($error['addr11'] === 'blank'): ?>
		<span class ="error">  ※ 住所を入力してください</span>
    <?php endif; ?></label>
    <textarea class="form-control" name="addr11" cols="30" placeholder="(例)東京都港区渋谷1-1-1ジーズアカデミー" rows="2"><?php print(htmlspecialchars($_POST['adress'],ENT_QUOTES)); ?></textarea>

    <label class="other_p">Other</label>
    <textarea class="form-control" name="other" cols="30" placeholder="(例)美容院では静かに過ごしたい/スタイリングの方法を教えて欲しい" rows="5"><?php print(htmlspecialchars($_POST['other'],ENT_QUOTES)); ?></textarea>



    <input class="" type="hidden" name="id" value="<?=$id?>"><br>

    <input type="submit" value="Submit" class="btn btn-default form_btn">

  </div>
</form>
</div>

 <?php include('footer.php');?>

<!-- Main[End] -->
<script src="js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="contact.js"></script>
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

.main_container {
  margin-top:10px;
  margin-bottom:60px;
}

.form_container{
  margin-top:20px;
}

.radio_g{
  font-size:0.75rem;
}

.other_p{
  margin-top:20px;
}

</style>
</html>

<?php
session_start();
include("funcs.php");
chkSsid();

$id = $_SESSION['id'];
// ポストされた時に入力エラーがないか確認
if (!empty($_POST)){

	// 項目に空白がないか確認
	if($_POST['salon'] === ''){
	$error['salon'] = 'blank';
	}
	if($_POST['date'] === ''){
	$error['menu'] = 'blank';
	}
	if($_POST['menu'] === ''){
	$error['menu'] = 'blank';
  }

  // ファイルのアップロードを画像ファイルのみ許可する
	$fileName = $_FILES['upfile']['name'];
	if(!empty($fileName)){
		$ext = substr($fileName, -3);
		if($ext != 'jpg' && $ext != 'gif' && $ext != 'png' && $ext != 'peg'){
		$error['image'] = 'type';
		}
   }
   
  // エラーがない場合の処理
 if (empty($error)) {  
  $extension = pathinfo($fileName, PATHINFO_EXTENSION);
  // 画像のアップロード
	$image = date('YmdHis').md5(session_id()).".".$extension;
	move_uploaded_file($_FILES['upfile']['tmp_name'],'./member_pic/' .$image);
	
	// 入力内容にエラーがない場合、セッションストレージに入力内容を保存
  $_SESSION['join'] = $_POST;
  $_SESSION['join']['image'] = $image;
  header('Location: insert.php');
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
  <link rel="stylesheet" href="./css/reset.css">
  <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
   <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700|Noto+Sans+JP:300,400,700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<!-- Head[Start] -->
  <header>
   <div class="header_flex">
    <img class="logo_img" src="img/logo.png" alt="ロゴ" width="150px" height="50px">
    <!-- <h1 class="app_h1">Hair Karte</h1> -->
    <div class="">
      <ul class="header_left">
        <a href="login/login.php"><li class="nav_icon" ><img src="img/alarm.png" alt="icon" height="30px" width="30px"></li></a>
        <a href="login/login.php"><li class="nav_icon" ><img src="img/door.png" alt="icon" height="30px" width="30px"></li></a>
      </ul>
    </div>
   </div>
  </header>

<!-- Main[Start] -->
<form class="form-horizontal form_container" method="POST" action="" enctype="multipart/form-data">
  <div class="form-group">

    <legend class="title">Post</legend>
    <label>Salon<?php if ($error['salon'] === 'blank'): ?>
		<span class ="error">  ※ サロン名を入力してください。</span>
		<?php endif; ?></label><input class="form-control" type="text" name="salon" placeholder="サロン名を入力してください" value="<?php print(htmlspecialchars($_POST['salon'],ENT_QUOTES)); ?>"><br>
    <label>Date<?php if ($error['date'] === 'blank'): ?>
		<span class ="error">  ※ 日付を入力してください。</span>
		<?php endif; ?></label>
    <input class="form-control" type="date" name="date" placeholder="日付を入力してください" value="<?php print(htmlspecialchars($_POST['date'],ENT_QUOTES)); ?>"><br>
    <label>Menu<?php if ($error['menu'] === 'blank'): ?>
		<span class ="error">  ※ 施術内容を入力してください。</span>
		<?php endif; ?></label>
    <input class="form-control" type="text" name="menu" placeholder="カラー、カットなど・・・" value="<?php print(htmlspecialchars($_POST['menu'],ENT_QUOTES)); ?>"><br>
    <label>Image<?php if ($error['image'] === 'type'): ?>
		<span class ="error">画像ファイルは「.jpg」「.png」「.gif」形式でアップロードしてください。</span>
		<?php endif; ?>
    <?php if (!empty($error)): ?>
		<span class ="error">恐れ入りますが、画像を再度指定してください。</span>
		<?php endif; ?></label><input class="form-control" type="file" accept="image/*" capture="camera" name="upfile">
    <input class="checkbox" type="checkbox" name="share_flg"><span class="check_p">投稿の共有を許可する</span>
    <input class="hidden_form" type="hidden" name="user_id" value="<?php.$id?>">
    <input type="submit" value="送信" class="btn btn-default form_btn">

  </div>
</form>
<!-- Main[End] -->
   <?php include('footer.php');?>
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
  /* 追加のCSS */
/* ヘッダー */
.header_flex {
  padding: 10px 20px;
  display: flex;
  justify-content: space-between;
}

.header_left {
  display: flex;
  justify-content: center;
}

.app_h1 {
  font-size: 1rem;
}

.nav_icon {
  margin-left: 20px;
}

form {
  margin: 30px auto 0;
}

label{
  margin-bottom:5px;
}

input[type="file"]{
  border:none;
  box-shadow: none; 
}
.hidden_form{
  height:0px
}

.form_btn{
  margin:0 auto;
}

.checkbox{
  margin-left:35px;
  margin-bottom:25px;
}

.check_p{
 font-size:0.7rem;
 margin-left:20px;
}
</style>
</html>

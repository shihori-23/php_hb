<?php
session_start();
include("../funcs.php");
chkSsid();
$pdo = db_conn();

//最後のアクションから１時間ログイン状態を維持する
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  $_SESSION['time'] = time();

  $members = $pdo->prepare('SELECT * FROM user_id WHERE id=?');
  $members->execute(array($_SESSION['id']));
  $member = $members->fetch();
  $val = $member['id'];

} else {
  // print ("ダメだよ");
  header('Location: ../login/login.php');
  exit();
}

// DBのテーブル同士の接続と投稿内容の出力準備
$posts = $pdo->prepare('SELECT * FROM profiles WHERE member_id=:val');
$posts->bindValue(':val', $val, PDO::PARAM_STR); 
$status = $posts->execute();

if($status==false){
sql_error();
}

$post = $posts->fetch();

if($post ==false){
     header('Location: prof_input.php');
     exit();   
}

$url = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hair Karte</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700|Noto+Sans+JP:300,400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/prof.css">
</head>
<body>
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
  <div class="main_container">
      <div class="msg">
        <h1 class="main_title">Profile</h1>
          <p class="msg_lb">お名前</p><p class="msg_p"><?php print(htmlspecialchars($post['name'],ENT_QUOTES)); ?></p>
          <p class="msg_lb">ふりがな</p><p class="msg_p"><?php print(htmlspecialchars($post['kana'],ENT_QUOTES)); ?></p>
          <p class="msg_lb">生年月日</p><p class="msg_p"><?php print(htmlspecialchars($post['birthday'],ENT_QUOTES)); ?></p>
          <p class="msg_lb">連絡先</p><p class="msg_p"><?php print(htmlspecialchars($post['tel'],ENT_QUOTES)); ?></p>
          <p class="msg_lb">メール</p><p class="msg_p"><?php print(htmlspecialchars($post['email'],ENT_QUOTES)); ?></p>
          <p class="msg_lb">お住まいの地域</p><p class="msg_p mag_postal">〒<?php print(htmlspecialchars($post['postal'],ENT_QUOTES)); ?></p>
          <p class="msg_p"><?php print(htmlspecialchars($post['adress'],ENT_QUOTES)); ?></p>
          <p class="msg_lb">ご要望</p><p class="msg_p"><?php print(htmlspecialchars($post['other'],ENT_QUOTES)); ?></p>

       <div class="prof_flex"><a href="detail.php?id=<?php print(htmlspecialchars($post['id']));?>"><img src="../img/pen.png" height="20px" width="20px"></a>
     <?php if(isset($_SESSION['id'])):?>
       <a href="https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=https://shihori23.sakura.ne.jp/php_hb/prof/prof_get.php?id=<?php print(htmlspecialchars($val));?>">Share</a>
       <!-- <a href="https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=<?php print(htmlspecialchars($url));?>">Share</a> -->
     <?php endif;?>
     </div>
      </div>
  </div>

 <?php include('footer.php');?>

<script src="js/jquery-2.1.3.min.js"></script>
<script
  src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
  crossorigin="anonymous"
></script>

</body>
<style>
</style>
</html>
<?php
// セッションを使用するおまじない
session_start();
include('funcs.php');
// chkSsid();
$pdo = db_conn();

// URLパラメーターが空だったら
if (empty($_REQUEST['id'])) {
  header('Location: share.php');
  exit();
}

//ユーザーID の
$members = $pdo->prepare('SELECT * FROM user_id WHERE id=?');
$members->execute(array($_SESSION['id']));
$member = $members->fetch();
$val = $member['id'];

$post_id = $_REQUEST['id'];

$posts = $pdo->prepare('SELECT * FROM posts WHERE id=:post_id');
// $posts->bindValue(':member_id', $val, PDO::PARAM_STR); 
$posts->bindValue(':post_id', $post_id, PDO::PARAM_INT); 
$status = $posts->execute();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hair Karte</title>
  <link rel="stylesheet" href="css/reset.css">
   <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700|Noto+Sans+JP:300,400,700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="css/view.css">
</head>
<body>
  <header>
  <div class="header_flex">
    <img class="logo_img" src="img/logo.png" alt="ロゴ" width="150px" height="50px">
    <!-- <h1 class="app_h1">Hair Karte</h1> -->
    <div class="">
      <ul class="header_left">
        <li class="nav_icon"><img src="img/alarm.png" alt="icon" height="30px" width="30px"></li>
        <a href="login/login.php"><li class="nav_icon"><img src="img/door.png" alt="icon" height="30px" width="30px"></li></a>
      </ul>
    </div>
 </div>
  </header>
<div id="wrap">
    <div id="head">
    </div>
    <div id="content">
  <?php if($post = $posts->fetch()): ?>
      <?php $staff_id = $post["staff_id"];
        $users = $pdo->prepare('SELECT * FROM user_id WHERE id=?');
        $users->execute(array($post["staff_id"]));
        $user = $users->fetch();
      ?>

      <div class="msg">
      <p class="salon_title"><span><?php print(htmlspecialchars($post['salon'])); ?></span></p>
      <p class="msg_p"><?php print(htmlspecialchars($post['date'])); ?></p>
      <div class="p_img"><img class="post_img" src="member_pic/<?php print(htmlspecialchars($post['img'])); ?>" /></div>

      <p class="msg_p msg_menu"><?php print(htmlspecialchars($post['menu'])); ?></p>

      <div class="com_container">
      <p class="msg_cm cm_title">スタイリストからのコメント</p>
      <span class="msg_cm"><?php print(htmlspecialchars($post['comment'])); ?></span>
      <span class="msg_cm sign">（<?php print(htmlspecialchars($user['name'])); ?>）</span>

      </div>
      </div>
  <?php else: ?>
    <p>その投稿は削除されたか、URLが間違えています</p>
  <?php endif; ?>
      <p><a class="nav_btn" href="share.php">一覧にもどる</a></p>

    </div>
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

.com_container{
 margin-bottom:20px;
}

</style>
</html>


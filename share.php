<?php
// セッションを使用するおまじない
session_start();
include('funcs.php');
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
  header('Location: ./login/login.php');
  exit();
}

// DBのテーブル同士の接続と投稿内容の出力準備
$posts = $pdo->prepare('SELECT * FROM posts WHERE share_flg="on" ORDER BY date DESC');
$status = $posts->execute();

if($status==false){
sql_error();
}

$post = $posts->fetchAll();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hair Karte</title>
  <link rel="stylesheet" href="css/reset.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700|Noto+Sans+JP:300,400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">
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
  <div class="main_container">

    <?php foreach ($post as $p): ?>
     <a href="view_share.php?id=<?php print(htmlspecialchars($p['id'])); ?>">
      <div class="msg">
      <p class="msg_p"><?php print(htmlspecialchars($p['salon'],ENT_QUOTES)); ?></p>
      <p class="msg_p"><?php print(htmlspecialchars($p['date'],ENT_QUOTES)); ?></p>
      <div class="p_img"><img class="post_img" src="member_pic/<?php print(htmlspecialchars($p['img'],ENT_QUOTES)); ?>" alt="" /></div>
      </div></a>
    <?php endforeach; ?>

  </div>
  <?php include('footer.php');?>

    <!-- <footer id="#footer">
      <div class="ft_flex">
        <a href="" class="ft_icn home"></a>
        <a href="" class="ft_icn search"></a>
        <a href="" class="ft_icn play"></a>
        <a href="prof/prof.php" class="ft_icn prof"></a>
      </div>
    </footer> -->

    <!-- <a href="index.php" class="plus"><div class="plus_icon"><img src="img/plus.png" alt="plusicon" height="20px"></div></a> -->

<script src="js/jquery-2.1.3.min.js"></script>
<script
  src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
  crossorigin="anonymous"
></script>

</body>
</html>


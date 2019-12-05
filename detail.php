<?php
session_start();
$id = $_GET["id"]; //?id~**を受け取る
include("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id=:id");
$stmt->bindValue(":id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if($status==false) {
    sql_error();
}else{
    $row = $stmt->fetch();
}
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
   <link rel="stylesheet" href="css/detail.css">
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

<!-- Main[Start] -->
<div class="main_container">
<form class="form-horizontal form_container" method="POST" action="update.php" enctype="multipart/form-data">
  <div class="form-group">
   <fieldset>
    <legend class="title">Rewrite</legend>
     <label>Salon</label><input class="form-control" type="text" name="salon" value="<?=$row["salon"]?>"><br>
     <label>Menu</label><input class="form-control" type="text" name="menu" value="<?=$row["menu"]?>"></label><br>
     <label>Image</label>
     <div class="post_img"><img class="post_img" src="member_pic/<?=$row["img"]?>"></div>
     <label class="lb_p">画像を変更する場合はこちら<input type="file" accept="image/*" capture="camera" name="upfile" value=""><br>
     
     <input type="hidden" name="id" value="<?=$id?>">
     <input type="submit" value="submit" class="btn btn-default form_btn">
    </fieldset>
  </div>
</form>
</div>
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
 .post_img {
  height: 280px;
  width: 280px;
}

</style>
</html>
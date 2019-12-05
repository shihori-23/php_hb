<?php
session_start();
$id = $_GET["id"]; //?id~**を受け取る
include("funcs.php");
$pdo = db_conn();

//スタッフのUserIdを保持
$staff_id = $_SESSION["id"];

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
<form method="POST" action="update_st.php">
  <div class="form_container">
   <fieldset>
    <legend class="title">スタイリスト コメント</legend>
    <textarea class="form_comment" name="comment" cols="30" rows="10"></textarea><br>    
     <input type="submit" value="submit"  class="btn btn-default form_btn">
     <input type="hidden" name="id" value="<?=$id?>">
     <input type="hidden" name="staff_id" value="<?=$staff_id?>">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

 <?php include('footer_st.php');?>
</body>

<style>
.form_comment{
  width:100%;
  border: solid 1px #1f1f1f;
  box-shadow: 1px 1px 8px #dcdcdc;
  border-radius: 0.25rem;
  margin:0 auto;
  font-size:0.8rem
}

.form_btn{
  width:100%;
}
</style>
</html>
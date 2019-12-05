<?php
session_start();
require('../funcs.php');
$pdo = db_conn();

//POSTの値
$email =$_POST['email'];
$lpw   =$_POST['lpw'];

// 初めて画面を読み出された時にもCOOKIEの中身を確認
if($_COOKIE['email'] !==''){
 $email = $_COOKIE['email'];
}

if (!empty($_POST)) {
  // メールアドレスの更新があった場合、変更する
  $email = $_POST['email'];
  
  if ($_POST['email'] !== '' && $_POST['lpw'] !== '' ){
    $stmt = $pdo->prepare('SELECT * FROM user_id WHERE email=:email'); 
    $stmt->bindValue(':email', $email, PDO::PARAM_STR); 
    $status = $stmt->execute();
  
    //3. SQL実行時にエラーがある場合STOP
    if($status==false){
    sql_error();
    }

    //4. 抽出データ数を取得
    $val = $stmt->fetch();         //1レコードだけ取得する方法
     //Login成功時
    if( password_verify($lpw, $val["lpw"]) ){

      // COOKIEにログイン情報を保存する（14日間）
      if($_POST['save'] === 'on') {
        setcookie('email',$_POST['email'],time()+60*60*24*14);
      }
      $_SESSION['id'] = $val['id'];
      $_SESSION['time'] = time();
      $_SESSION["chk_ssid"]  = session_id();
      $_SESSION["email"] = $val['email'];
      $_SESSION["id"]      = $val['id'];
      $_SESSION["flg"]      = $val['staff_flg'];

      if($val['staff_flg']==0){

         redirect("../main.php");
      }else if($val['staff_flg']==1){

         redirect("../main_st.php");
      }else if($val['staff_flg']==2){

         redirect("../join/kanri.php");
      }

    }else{
      //Login失敗時(Logout経由)
      $error['login'] = 'failed';
    }
  } else {
      $error['login'] = 'blank';
  }
}


?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>Hair Karte</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
      <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700|Noto+Sans+JP:300,400,700&display=swap" rel="stylesheet">

     <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
    <header></header>



    <form class="form-horizontal form_container" method="POST" action="">
          <h1 class="title">Sign in</h1>
      <div class="form-group">
        <label for="exampleInputEmail1">Login ID 
          <?php if ($error['login'] === 'blank'): ?>
          <span class ="error"> ※メールアドレスとパスワードをご記入ください</span>
          <?php endif; ?>
          <?php if ($error['login'] === 'failed'): ?>
          <span class ="error"> ※ログインに失敗しました。正しくご記入ください</span>
          <?php endif; ?></label>
        <input
          type="text"
          class="form-control"
          name="email"
          id="exampleInputEmail1"
          placeholder="Email"
          value="<?php print (htmlspecialchars($email,ENT_QUOTES)); ?>"
        />
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input
          type="password"
          name="lpw"
          class="form-control"
          id="exampleInputPassword1"
          placeholder="Password"
        />
      </div>
      <div class="form-group check">
       <input id="save" type="checkbox" name="save" value="on">
          <label for="save" class="save">Login IDを記録する</label>
      </div>
      <button type="submit" class="btn btn-default form_btn login_btn">Sign in</button>
    </form>
     <div class="nav_container"><a href="../join/input.php" class="ca_btn">Create Account</a></div>
    <script src="js/jquery-2.1.3.min.js"></script>
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
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
    <script src="js/index.js"></script>
  </body>

  <style>
  .save{
      letter-spacing: 0.02em;
      font-size:0.5rem
  }
  .check{
    text-align:center;
  }

  .login_btn{
    margin-top:0;
  }

  .ca_btn {
    font-size: 0.85rem;
    letter-spacing: 0.25em;
    color: #1f1f1f;
    margin: 10px auto;
    display: block;
    width: 165px;
  }

  .ca_btn:hover {
    color: #e264e2;
    text-decoration: none;
    border-bottom: solid 2px #e264e2;
  }

</style>
</html>
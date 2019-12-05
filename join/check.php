<?php
// セッションを使用するおまじない
session_start();

//入力画面を介さずにcheck.phpを呼び出した場合、input.phpに戻る 
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Hair Karte</title>
     <link rel="stylesheet" href="../css/reset.css">
	  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700|Noto+Sans+JP:300,400,700&display=swap" rel="stylesheet">
	<link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
	<link rel="stylesheet" type="text/css" href="../css/style.css" />

</head>
<body>
<div id="">
<div id="">

</div>

<div class="container">
<h1 class="title">Confirmation</h1>
<p class="container_p">下記、アカウント情報で登録します。<br>問題がなければ、「Submit」をクリックしてください。</p>
<form action="insert.php" method="post">
	<input type="hidden" name="action" value="submit" />
      <div class="cof_table">
		<div class="form_t">
			<span class="form_cof">Name</span>
			<span class="form_cof text">
			<?php print (htmlspecialchars($_SESSION['join']['name'],ENT_QUOTES)); ?>
			</span>
		</div>
		<div class="form_t">
			<span class="form_cof">Email</span>
			<span class="form_cof text">
			<?php print (htmlspecialchars($_SESSION['join']['email'],ENT_QUOTES)); ?>
			</span>
	     </div>
		<div class="form_t">
			<span class="form_cof">Password</span>
			<span class="form_cof">
			******
			</span>
		</div>
	</div>
	<input type="submit" value="Submit"  class="btn btn-default form_btn"/>
	<a class="nav_btn rewrite" href="input.php?action=rewrite">Rewrite</a>
</form>
</div>

</div>
</body>
 <style>

form {
  margin: 0px auto 0;
}

.rewrite{
	margin-top:10px;
}




</style>
</html>

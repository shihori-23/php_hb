

    <footer id="#footer">
      <div class="ft_flex">
        <a href="main.php" class="ft_icn home"></a>
        <a href="share.php" class="ft_icn search"></a>
        <a href="" class="ft_icn play"></a>
        <a href="prof/prof.php" class="ft_icn prof"></a>
      </div>
    </footer>

<style>
   /* フッター */
footer {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 50px;
  background: #1f1f1f;
  box-shadow: 1px 1px 1px #1f1f1f;
  margin: 0;
  z-index: 6000;
}

.ft_flex {
  display: flex;
}

.ft_icn {
  width: 25%;
  height: 40px;
}
.ft_icn:hover {
  opacity: 0.5;
}
.home {
  background-image: url("img/home2.png");
  background-repeat: no-repeat;
  background-size: auto 60%;
  background-position: center;
  padding-top: 10px;
}
.search {
  background-image: url("img/glass.png");
  background-repeat: no-repeat;
  background-size: auto 70%;
  background-position: center;
  padding-top: 5px;
}
.play {
  background-image: url("img/youtube.png");
  background-repeat: no-repeat;
  background-size: auto 70%;
  background-position: center;
  padding-top: 5px;
}
.prof {
  background-image: url("img/user.png");
  background-repeat: no-repeat;
  background-size: auto 70%;
  background-position: center;
  padding-top: 5px;
}  
</style>


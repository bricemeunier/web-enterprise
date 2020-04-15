<?php
 if (empty($_POST['user'])){
  $image1=rand(1,9);
  $image2=rand(1,9);
  $_SESSION['result']=$image1+$image2;
   ?>


  <h1><strong>Login</strong></h1>

  <div class="row" id="smallForm">

    <form class="col s12" action="#" method="post">
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">account_circle</i>
          <input id="username" type="text" name="user" class="validate" required>
          <label for="username">Username</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">lock</i>
          <input id="password" type="password" name="password" class="validate" required>
          <label for="password">Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <img src="image/nb/<?php echo $image1; ?>.jpg">
          <h3 id="plusSign"><strong>+</strong></h3>
          <img src="image/nb/<?php echo $image2; ?>.jpg">
        </div>
        <div class="input-field col s6">
          <input id="captcha" type="number" name="captcha" required><br>
          <label for="captcha">Result</label>
        </div>
      </div>
      <button class="btn waves-effect waves-light" type="submit" name="action">Submit
        <i class="material-icons right">send</i>
      </button>
    </form>
  </div>
  <?php
}
else {
  $pdo=new Mypdo();
  $loginManager=new LoginManager($pdo);
  $result=$_SESSION["result"];
  $captcha=$_POST["captcha"];
  $login=$_POST["user"];
  $login= htmlspecialchars($login,ENT_QUOTES);
  $password=$_POST["password"];
  $verif=$loginManager->login($login,$password);
  if ($result==$captcha) {
    if (isset($verif->per_login)) {
      $_SESSION['pseudo']=$login;
      $_SESSION['admin']=$verif->per_admin;
      $_SESSION['user_num']=$verif->per_num;
      ?>
      <h1><strong>Login</strong></h1>
      <img src="image/valid.png"> Login successfull !<br>
      Automatic redirection in 2 seconds.
      <meta http-equiv="refresh" content="2; URL=index.php?page=0">
      <?php
    }
    else {?>
        <meta http-equiv="refresh" content="0; URL=#">
      <?php
    }
  }
  else {?>
    <meta http-equiv="refresh" content="0; URL=#">
    <?php
  }
}
    ?>

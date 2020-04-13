<?php
 if (empty($_POST['user'])){
  $image1=rand(1,9);
  $image2=rand(1,9);
  $_SESSION['result']=$image1+$image2;
   ?>


  <h1><strong>Login</strong></h1>
  <form action="#" method="post">

  	<strong>Username :  </strong><input type="text" name="user" required><br>
  	<strong>password :  </strong><input type="password" name="password" required><br>
    <img src="image/nb/<?php echo $image1; ?>.jpg"><strong> + </strong><img src="image/nb/<?php echo $image2; ?>.jpg"><strong> = </strong>
    <input type="number" name="captcha" required><br>
  	<input type="submit" value="Submit"/>
  </form>
  <?php
}
else {
  $pdo=new Mypdo();
  $connexionManager=new ConnexionManager($pdo);
  $result=$_SESSION["result"];
  $captcha=$_POST["captcha"];
  $login=$_POST["user"];
  $login= htmlspecialchars($login,ENT_QUOTES);
  $password=$_POST["password"];
  $verif=$connexionManager->connexionValide($login,$password);
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

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <?php
		$title = "Best quotes";?>
		<title>
		<?php echo $title ?>
		</title>
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />

</head>
	<body>
	<div id="header">
		<div id="connect"><?php
    if (!isset($_SESSION['pseudo'])) {?>
      <a href=index.php?page=10><strong>Login</strong></a>
    <?php
    }
    else {?>
      <a href=index.php?page=11>User : <strong><?php echo $_SESSION['pseudo'];?> &nbsp; &nbsp; Logout</strong></a>
    <?php
  }
   ?>
		</div>
		<div id="entete">
			<div id="logo">

			</div>
			<div id="titre">
				Funny quotes,<br />Share your best ones !!!
			</div>
		</div>
	</div>

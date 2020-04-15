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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

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
			<div id="title">
				Funny quotes,<br />Share your best ones !!!
			</div>
		</div>
	</div>

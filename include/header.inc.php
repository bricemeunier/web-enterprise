<?php
session_start();
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <?php
		$title = "Bienvenue sur le site du bétisier de l'IUT.";?>
		<title>
		<?php echo $title ?>
		</title>
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />

</head>
	<body>
	<div id="header">
		<div id="connect"><?php
    if (!isset($_SESSION['pseudo'])) {?>
      <a href=index.php?page=10><strong>Connexion</strong></a>
    <?php
    }
    else {?>
      <a href=index.php?page=11>Utilisateur : <strong><?php echo $_SESSION['pseudo'];?> &nbsp; &nbsp; Déconnexion</strong></a>
    <?php
  }
   ?>
		</div>
		<div id="entete">
			<div id="logo">

			</div>
			<div id="titre">
				Le bétisier de l'IUT,<br />Partagez les meilleures perles !!!
			</div>
		</div>
	</div>

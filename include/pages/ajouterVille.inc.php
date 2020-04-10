<h1><strong>Ajouter une ville</strong></h1>

<?php
if (empty($_POST['vil_nom'])){
 ?>
<form action="#" method="post">

	<strong>Nom: </strong><input type="text" name="vil_nom" required><br>

	<input type="submit" value="Valider"/>
</form>
<?php
}
else {
	$pdo=new Mypdo();
	$city=new City($_POST);
	$cityManager=new CityManager($pdo);
	if ($cityManager->recherche($city->getCityNom())){
	  $cityManager->add($city);?>
	  <img src="image/valid.png">La ville <strong><?php echo $_POST['vil_nom'];?></strong> a été ajoutée
	  <?php
	}
	else {?>
	  <img src="image/erreur.png">La ville <strong><?php echo $_POST['vil_nom'];?> existe déjà</strong>
	  <meta http-equiv="refresh" content="4; URL= index.php?page=8">
	<?php
	}
}?>

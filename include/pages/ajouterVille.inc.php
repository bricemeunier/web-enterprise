<h1><strong>Add a city</strong></h1>

<?php
if (empty($_POST['vil_nom'])){
 ?>
<form action="#" method="post">

	<strong>Name: </strong><input type="text" name="vil_nom" required><br>

	<input type="submit" value="Submit"/>
</form>
<?php
}
else {
	$pdo=new Mypdo();
	$city=new City($_POST);
	$cityManager=new CityManager($pdo);
	if ($cityManager->recherche($city->getCityNom())){
	  $cityManager->add($city);?>
	  <img src="image/valid.png"><strong><?php echo $_POST['vil_nom'];?></strong> added successfully
	  <?php
	}
	else {?>
	  <img src="image/erreur.png"><strong><?php echo $_POST['vil_nom'];?> already exists</strong>
	  <meta http-equiv="refresh" content="4; URL= index.php?page=8">
	<?php
	}
}?>

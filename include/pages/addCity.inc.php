<h1><strong>Add a city</strong></h1>

<?php
if (empty($_POST['city_name'])){
 ?>
<form action="#" method="post">

	<strong>Name: </strong><input type="text" name="city_name" required><br>

	<input type="submit" value="Submit"/>
</form>
<?php
}
else {
	$pdo=new Mypdo();
	$city=new City($_POST);
	$cityManager=new CityManager($pdo);
	if ($cityManager->search($city->getCityName())){
	  $cityManager->add($city);?>
	  <img src="image/valid.png"><strong><?php echo $_POST['city_name'];?></strong> added successfully
	  <?php
	}
	else {?>
	  <img src="image/erreur.png"><strong><?php echo $_POST['city_name'];?> already exists</strong>
	  <meta http-equiv="refresh" content="4; URL= index.php?page=8">
	<?php
	}
}?>

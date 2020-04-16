<h1><strong>Add a city</strong></h1>

<?php
if (empty($_POST['city_name'])){
 ?>

<div class="row" id="smallForm">
  <form class="col s12" action="#" method="post">
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">location_city</i>
        <input id="city" type="text" name="city_name" class="validate" required>
        <label for="city">City Name</label>
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
	$city=new City($_POST);
	$cityManager=new CityManager($pdo);
	if ($cityManager->search($city->getCityName())){
	  $cityManager->add($city);?>
	  <img src="image/valid.png"><strong> <?php echo $_POST['city_name'];?></strong> added successfully
    <p>Automatic redirection in 2 seconds.</p>
    <meta http-equiv="refresh" content="2; URL=index.php?page=8">
	  <?php
	}
	else {?>
	  <img src="image/erreur.png"><strong> <?php echo $_POST['city_name'];?> already exists</strong>
	  <meta http-equiv="refresh" content="4; URL= index.php?page=8">
	<?php
	}
}?>

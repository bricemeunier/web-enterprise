<?php
$pdo=new Mypdo();
$cityManager =new CityManager($pdo);
$city=$cityManager->getAllCity();
$nbCity=$cityManager->getCityNumber();
?>
	<h1>City list</h1>
	<h3>Currently <?php echo $nbCity->total; ?> cities registered</h3>
<table id>
	<tr><th>Id</th><th>Name</th></tr>
	<?php //$produits est un tableau d'objet produit
		foreach ($city as $c){?>
			<tr><td><?php echo $c->getCityNum();?>
			</td><td><?php echo $c->getCityName();?>
			</td></tr>
			<?php
		}
	?>
	</table>
	<br />

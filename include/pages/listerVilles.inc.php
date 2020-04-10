<?php
$pdo=new Mypdo();
$cityManager =new CityManager($pdo);
$city=$cityManager->getAllCity();
$nbCity=$cityManager->getNbCity();
?>
	<h1>Liste des villes</h1>
	<h3>Actuellement <?php echo $nbCity->total; ?> villes sont enregistrées</h3>
<table id>
	<tr><th>Numéro</th><th>Nom</th></tr>
	<?php //$produits est un tableau d'objet produit
		foreach ($city as $ville){?>
			<tr><td><?php echo $ville->getCityNum();?>
			</td><td><?php echo $ville->getCityNom();?>
			</td></tr>
			<?php
		}
	?>
	</table>
	<br />

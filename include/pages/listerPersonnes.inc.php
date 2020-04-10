	<?php
	$pdo=new Mypdo();
	$personneManager =new PersonneManager($pdo);
	$personne=$personneManager->getAllPersonne();
	$nbPersonne=$personneManager->getNbPersonne();
	?>
		<h1>Liste des personnes enregistrées</h1>
		<h3>Actuellement <?php echo $nbPersonne->total; ?> personnes sont enregistrées</h3>
	<table>
		<tr><th>Numéro</th><th>Nom</th><th>Prénom</th></tr>
		<?php //$produits est un tableau d'objet produit
			foreach ($personne as $pers){?>
				<tr><td><a href=index.php?page=9&num=<?php echo $pers->getPersNum();?>&nom=<?php echo $pers->getPersNom();?>>
					<?php echo $pers->getPersNum();?></a>
				</td><td><?php echo $pers->getPersNom();?>
				</td><td><?php echo $pers->getPersPrenom();?>
				</td></tr>
				<?php
			}
		?>
		</table>
		<br>

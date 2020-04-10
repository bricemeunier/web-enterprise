	<?php
	$pdo=new Mypdo();
	$citationManager =new CitationManager($pdo);
	$citation=$citationManager->getAllCitation();
	if (empty($_GET['citNum'])){
	?>
		<h1>Supprimer une citation</h1>
		<table>
			<th>Nom de l'enseignement</th><th>Libellé</th><th>Date</th><th>Moyenne</th><th>Supprimer</th></tr>
			<?php //$produits est un tableau d'objet produit
				foreach ($citation as $quote){?>
					<tr><td><?php echo $quote->getPrenomProf()." ".$quote->getNomProf();?>
					</td><td><?php echo $quote->getCitationLibelle();?>
					</td><td><?php echo $quote->getCitationDate();?>
					</td><td><?php echo $quote->getCitationMoyenne();?>
					</td><td><a href="index.php?page=15&citNum=<?php echo $quote->getCitationNum();?>"><img src="image/erreur.png"></a>
					</td></tr>
					<?php
				}
			?>
		</table>
		<br />
	<?php
	}
	else {
		$citationManager->supprimerCitation($_GET['citNum']);
		?>
		<br>
		<img src="image/valid.png"><p> La citation a été supprimée !</p>
		<p>Redirection automatique dans 2 secondes</p>
		<meta http-equiv="refresh" content="2; URL=index.php?page=15"><?php
	} ?>

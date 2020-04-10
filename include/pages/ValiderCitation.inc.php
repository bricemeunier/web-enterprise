	<?php
	$pdo=new Mypdo();
	$citationManager =new CitationManager($pdo);
	$citation=$citationManager->getAllCitationNonValide();
	if (!empty($citation)){
		if (empty($_GET['citNum']) && empty($_GET['supCitNum'])){
		?>
			<h1>Liste des citations en attente de validation</h1>
			<table>
				<th>Nom de l'enseignement</th><th>Libellé</th><th>Date</th><th>Valider</th><th>Supprimer</th></tr>
				<?php //$produits est un tableau d'objet produit
					foreach ($citation as $quote){?>
						<tr><td><?php echo $quote->getPrenomProf()." ".$quote->getNomProf();?>
						</td><td><?php echo $quote->getCitationLibelle();?>
						</td><td><?php echo $quote->getCitationDate();?>
						</td><td><a href="index.php?page=14&citNum=<?php echo $quote->getCitationNum();?>"><img src="image/citation.gif"></a>
						</td><td><a href="index.php?page=14&supCitNum=<?php echo $quote->getCitationNum();?>"><img src="image/erreur.png"></a>
						</td></tr>
						<?php
					}
				?>
			</table>
			<br />
		<?php
		}
		else if (!(empty($_GET['citNum']))){
			$citationManager->validerCitation($_GET['citNum']);
			?>
			<br>
			<img src="image/valid.png"><p> La citation a été validée !</p>
			<p>Redirection automatique dans 2 secondes</p>
			<meta http-equiv="refresh" content="2; URL=index.php?page=14"><?php
		}
		else {
			$citationManager->supprimerCitation($_GET['supCitNum']);
			?>
			<br>
			<img src="image/valid.png"><p> La citation a été supprimée !</p>
			<p>Redirection automatique dans 2 secondes</p>
			<meta http-equiv="refresh" content="2; URL=index.php?page=14"><?php
		}
	}
	else {
		?>
		<br>
		<p><strong>Aucune citation à valider</strong></p>
		<?php
	}?>

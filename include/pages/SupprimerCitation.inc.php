	<?php
	$pdo=new Mypdo();
	$citationManager =new CitationManager($pdo);
	$citation=$citationManager->getAllCitation();
	if (empty($_GET['citNum'])){
	?>
		<h1>Delete a quote</h1>
		<table>
			<th>Staff member name</th><th>Quote</th><th>Date</th><th>Mark average</th><th>Delete</th></tr>
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
		<img src="image/valid.png"><p> Quote successfully deleted !</p>
		<p>Automatic redirection in 2 seconds.</p>
		<meta http-equiv="refresh" content="2; URL=index.php?page=15"><?php
	} ?>

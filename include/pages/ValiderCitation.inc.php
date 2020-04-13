	<?php
	$pdo=new Mypdo();
	$citationManager =new CitationManager($pdo);
	$citation=$citationManager->getAllCitationNonValide();
	if (!empty($citation)){
		if (empty($_GET['citNum']) && empty($_GET['supCitNum'])){
		?>
			<h1>Quote list awaiting approval</h1>
			<table>
				<th>Staff member name</th><th>Quote</th><th>Date</th><th>Approve</th><th>Delete</th></tr>
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
			$citationManager->SubmitCitation($_GET['citNum']);
			?>
			<br>
			<img src="image/valid.png"><p> Quote successfully approved !</p>
			<p>Automatic redirection in 2 seconds.</p>
			<meta http-equiv="refresh" content="2; URL=index.php?page=14"><?php
		}
		else {
			$citationManager->supprimerCitation($_GET['supCitNum']);
			?>
			<br>
			<img src="image/valid.png"><p> Quote successfully deleted !</p>
			<p>Automatic redirection in 2 seconds.</p>
			<meta http-equiv="refresh" content="2; URL=index.php?page=14"><?php
		}
	}
	else {
		?>
		<br>
		<p><strong>No quote awaiting approval</strong></p>
		<?php
	}?>

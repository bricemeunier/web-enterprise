	<?php
	$pdo=new Mypdo();
	$persManager=new PersonneManager($pdo);
	$citationManager =new CitationManager($pdo);
	$citation=$citationManager->getAllCitation();
	$nbCitation=$citationManager->getNbCitation();
	?>
		<h1>Quotes list</h1>
		<h3>Currently <?php echo $nbCitation->total; ?> quotes registered</h3>
	<table>
		<tr><th>Staff member name</th><th>Quote</th><th>Date</th><th>Average mark</th>
			<?php
			if (isset($_SESSION['user_num'])) {
				if ($persManager->estEtudiant($_SESSION['user_num'])){
					echo "<th>Noter</th>";
				}
			}?></tr>
		<?php //$produits est un tableau d'objet produit
			foreach ($citation as $quote){?>
				<tr><td><?php echo $quote->getPrenomProf()." ".$quote->getNomProf();?>
				</td><td><?php echo $quote->getCitationLibelle();?>
				</td><td><?php echo $quote->getCitationDate();?>
				</td><td><?php echo $quote->getCitationMoyenne();
				if (isset($_SESSION['user_num'])) {
					if ($persManager->estEtudiant($_SESSION['user_num'])){
						if ($citationManager->aNoteLaCitation($quote->getCitationNum())==0){?>
							</td><td><a href="index.php?page=12&cit_num=<?php echo $quote->getCitationNum(); ?>"><img src="image/modifier.png"/>
								<?php
						}
						else {?>
							</td><td><img src="image/erreur.png"/>
							<?php
						}
					}
				}
				?>
				</td></tr>
				<?php
			}
		?>
		</table>
		<br />

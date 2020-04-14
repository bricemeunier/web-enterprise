	<?php
	$pdo=new Mypdo();
	$persManager =new PeopleManager($pdo);
	$person=$persManager->getAllPeople();
	$nbPersonne=$persManager->getPeopleNumber();
	?>
		<h1>People list</h1>
		<h3>Currently <?php echo $nbPersonne->total; ?> people registered</h3>
	<table>
		<tr><th>Id</th><th>Surname</th><th>First Name</th></tr>
		<?php //$produits est un tableau d'objet produit
			foreach ($person as $pers){?>
				<tr><td><a href=index.php?page=9&num=<?php echo $pers->getPersonNum();?>&name=<?php echo $pers->getPersonName();?>>
					<?php echo $pers->getPersonNum();?></a>
				</td><td><?php echo $pers->getPersonName();?>
				</td><td><?php echo $pers->getPersonFirstName();?>
				</td></tr>
				<?php
			}
		?>
		</table>
		<br>

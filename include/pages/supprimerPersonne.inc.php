<?php
$pdo=new MyPdo();
$persManager=new PersonneManager($pdo);
$personne=$persManager->getAllPersonne();

 if (empty($_POST['per_num'])){
	?>
	<h1>Supprimer une personne</h1>

	 <form method="post" action="#">
	   <label>Nom :</label><select name="per_num">
	     <?php
	     foreach ($personne as $pers){
	       ?><option value="<?php echo $pers->getPersNum();?>"><?php echo $pers->getPersPrenom()." ".$pers->getPersNom();?></option><?php
	     }
	     ?>
	   </select>
	   <input type="submit" value="Valider">
	 </form>
	<?php
	}
	else {
	  $persManager->supprimerPersonne($_POST['per_num']);
	  ?>
	  <br>
	  <img src="image/valid.png"><p>La personne a été supprimée !</p>
	  <p>Redirection automatique dans 2 secondes</p>
	  <meta http-equiv="refresh" content="2; URL=index.php?page=4"><?php
	} ?>

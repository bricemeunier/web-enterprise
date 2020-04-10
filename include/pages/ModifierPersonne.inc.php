<?php
	$pdo=new Mypdo();
	$personneManager =new PersonneManager($pdo);
	$etudiantManager=new EtudiantManager($pdo);
	$salarieManager=new SalarieManager($pdo);
	$depManager=new DepartementManager($pdo);
	$divManager=new DivisionManager($pdo);
	$fonManager=new FonctionManager($pdo);
	$personne=$personneManager->getAllPersonne();
	$nbPersonne=$personneManager->getNbPersonne();
	$fon=$fonManager->getAllFon();
	$dep=$depManager->getAllDep();
	$div=$divManager->getAllDiv();

	if (empty($_GET['num'])){
	?>
	<h1>Modifier une personne enregistrée</h1><br>
	<h3>Actuellement <?php echo $nbPersonne->total; ?> personnes sont enregistrées</h3>
	<table>
		<tr><th>Nom</th><th>Prénom</th><th>Modifier</th></tr>
		<?php //$produits est un tableau d'objet produit
			foreach ($personne as $pers){?>
				</td><td><?php echo $pers->getPersNom();?>
				</td><td><?php echo $pers->getPersPrenom();?>
				</td><td><a href=index.php?page=3&num=<?php echo $pers->getPersNum();?>><img src="image/modifier.png"></a>
				</td></tr>
				<?php
			}
		?>
	</table>
	<?php
	}
	else {
		if (empty($_POST['per_nom']) && empty($_POST["departement"]) && empty($_POST["fonction"])) {
			$pers=$personneManager->getPers($_GET['num']);?>
			<h1>Modifier une personne</h1><br>
			<form method="post" action="index.php?page=3&num=<?php echo $_GET['num'];?>">
			    <label>Nom :</label><input name="per_nom" type="text" value=<?php echo $pers->getPersNom();?> required><br>
			    <label>Prénom : </label><input type="text" name="per_prenom" value=<?php echo $pers->getPersPrenom();?> required><br>
			    <label>Téléphone:</label><input type="tel" name="per_tel" value=<?php echo $pers->getPersTel();?> required><br>
			    <label>Mail :</label><input type="email" name="per_mail" value=<?php echo $pers->getPersMail();?> required><br>
			    <label>Login :</label><input type="text" name="per_login" value=<?php echo $pers->getPersLogin();?> required><br>
			    <label>Changer le mot de Passe :</label><input type="password" name="per_pwd" ><br>
					<?php
					if ($personneManager->estEtudiant($_GET['num'])) {?>
						<label>Catégorie :</label><input type="radio" name="categorie" value="etudiant" checked> Etudiant
			  															<input type="radio" name="categorie" value="personnel"> Personnel<br>
					<?php
					}
					else {?>
						<label>Catégorie :</label><input type="radio" name="categorie" value="etudiant" > Etudiant
			  										<input type="radio" name="categorie" value="personnel" checked> Personnel<br>
					<?php
					}
					?>
			    <input type="submit" value="Valider">
			</form>
			<?php
		}

		else if (empty($_POST["departement"]) && empty($_POST["fonction"])) {
			if (!(empty($_POST['per_pwd']))){
				$p=new Personne();
				$p->setPersMDP($_POST['per_pwd']);
				$_POST['per_pwd']=$p->getPersMDP();
			}
		  $_SESSION['pers']=$_POST;
		  $loginValide=$personneManager->modifierLoginAutorise($_POST['per_login'],$_GET['num']);
		  $_SESSION['login']=$_POST['per_login'];
			$num=$personneManager->getIdPers($_SESSION['loginAvantModif'])->per_num;
			$_SESSION['numPersModif']=$num;

		  if ($loginValide){

		      if ($_POST['categorie']=='etudiant'){

						$etu=$personneManager->getEtu($num);
						?>
		        <h1><strong>Modifier un étudiant</strong></h1>
		        <form method="post" action="index.php?page=3&num=<?php echo $_GET['num'];?>">
		            <label>Département :</label><select name="departement">
		            <?php
		            foreach ($dep as $depart){
									if ($depart->getDepNum()==$etu->dep_num){
		              	?><option value="<?php echo $depart->getDepNum();?>" selected><?php echo $depart->getDepNom();?></option><?php
									}
									else {
										?><option value="<?php echo $depart->getDepNum();?>"><?php echo $depart->getDepNom();?></option><?php
									}
		            }
		            ?>
		            </select>
		            <br>
		            <label>Année : </label><select name="annee">
		            <?php
		            foreach ($div as $division){
									if ($division->getDivNum()==$etu->div_num){
		              	?><option value="<?php echo $division->getDivNum();?>" selected><?php echo $division->getDivNom();?></option><?php
									}
									else {
										?><option value="<?php echo $division->getDivNum();?>"><?php echo $division->getDivNom();?></option><?php
									}
		            }
		            ?>
		            </select>
		            <br>
		            <input type="submit" value="Valider">
		        </form><?php
		      }
		      else{
						$sal=$personneManager->getSal($_SESSION['numPersModif']);
						?>
		        <h1><strong>Modifier un salarié</strong></h1>
		        <form method="post" action="index.php?page=3&num=<?php echo $_GET['num'];?>">
		            <label>Téléphone professionnel :</label><input type="tel" name="tel_pro" value=<?php echo $sal->sal_telprof;?> required><br>
		            <label>Fonction : </label><SELECT name="fonction">
		            <?php
		            foreach ($fon as $fonction){
									if ($fonction->getFonNum()==$sal->fon_num){
		              	?><option value="<?php echo $fonction->getFonNum();?>" selected><?php echo $fonction->getFonLib();?></option><?php
									}
									else {
										?><option value="<?php echo $fonction->getFonNum();?>"><?php echo $fonction->getFonLib();?></option><?php
									}
		            }
		            ?>
		            </select>
		            <br>
		            <input type="submit" value="Valider">
		        </form><?php
		      }
		    }
		    else {
		        ?><meta http-equiv="refresh" content="3; URL= <?php echo $_SERVER['HTTP_REFERER'];?>">
		        <strong>Login <?php echo $_POST['per_login'];?> déjà utilisé</strong><?php
		    }
		}
		else {
		  if (isset($_POST['annee'])){

				if (!($personneManager->estEtudiant($_SESSION['numPersModif']))){
					$salarieManager->supprimerSalarie($_SESSION['numPersModif']);
				}
		    $etudiantManager->modifierEtu($_SESSION['numPersModif']);
		    ?>
		    <br>
		    <img src="image/valid.png"> L'étudiant a été ajoutée !
		    <?php
		  }
		  else {
		    $sal = new Salarie($_SESSION['pers'],$_POST['tel_pro'],$_POST['fonction']);
		    $personneManager->add($sal);
		    $sal->setSalNum($personneManager->getIdPers($_SESSION['login'])->per_num);
		    $salarieManager->add($sal);
		    ?>
		    <br>
		    <img src="image/valid.png"> Le salarie a été ajoutée !<?php
		  }
		}
	}
 ?>

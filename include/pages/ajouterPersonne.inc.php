<?php
if (empty($_POST['per_nom']) && empty($_POST["departement"]) && empty($_POST["fonction"])){?>

<h1>Ajouter une personne</h1>
<form method="post" action="#">
    <label>Nom :</label><input name="per_nom" type="text" required><br>
    <label>Prénom : </label><input type="text" name="per_prenom" required><br>
    <label>Téléphone:</label><input type="tel" name="per_tel" required><br>
    <label>Mail :</label><input type="email" name="per_mail" required><br>
    <label>Login :</label><input type="text" name="per_login" required><br>
    <label>Mot de Passe :</label><input type="password" name="per_pwd" required><br>
		<label>Catégorie :<input type="radio" name="categorie" value="etudiant" checked> Etudiant
  										<input type="radio" name="categorie" value="personnel"> Personnel<br>
    <input type="submit" value="Valider">
</form>
<?php
}

else if (empty($_POST["departement"]) && empty($_POST["fonction"]) && !empty($_POST["per_nom"])) {

  $pdo=new Mypdo();
  $persManager=new PersonneManager($pdo);
  $depManager=new DepartementManager($pdo);
  $divManager=new DivisionManager($pdo);
  $fonManager=new FonctionManager($pdo);
  $fon=$fonManager->getAllFon();
  $dep=$depManager->getAllDep();
  $div=$divManager->getAllDiv();
  $_SESSION['pers']=$_POST;
  $loginValide=$persManager->rechercheParLogin($_POST['per_login']);
  $_SESSION['login']=$_POST['per_login'];

  if ($loginValide->result==0){
      if ($_POST['categorie']=='etudiant'){?>
        <h1><strong>Ajouter un étudiant</strong></h1>
        <form method="post" action="#">
            <label>Département :</label><select name="departement">
            <?php
            foreach ($dep as $depart){
              ?><option value="<?php echo $depart->getDepNum();?>"><?php echo $depart->getDepNom();?></option><?php
            }
            ?>
            </select>
            <br>
            <label>Année : </label><SELECT name="annee">
            <?php
            foreach ($div as $division){
              ?><option value="<?php echo $division->getDivNum();?>"><?php echo $division->getDivNom();?></option><?php
            }
            ?>
            </select>
            <br>
            <input type="submit" value="Valider">
        </form><?php
      }
      else{?>
        <h1><strong>Ajouter un salarié</strong></h1>
        <form method="post" action="#">
            <label>Téléphone professionnel :</label><input type="tel" name="tel_pro"><br>
            <label>Fonction : </label><SELECT name="fonction">
            <?php
            foreach ($fon as $fonction){
              ?><option value="<?php echo $fonction->getFonNum();?>"><?php echo $fonction->getFonLib();?></option><?php
            }
            ?>
            </select>
            <br>
            <input type="submit" value="Valider">
        </form><?php
      }
    }
    else {
        ?><meta http-equiv="refresh" content="40; URL= <?php echo $_SERVER['HTTP_REFERER'];?>">
        <strong>Login déjà utilisé</strong><?php
    }
}
else {
  $pdo=new Mypdo();
  $etudiantManager=new EtudiantManager($pdo);
  $salarieManager=new SalarieManager($pdo);
  $persManager=new PersonneManager($pdo);
  if (isset($_POST['annee'])){
    $etu = new Etudiant($_SESSION['pers'],$_POST['departement'],$_POST['annee']);
    $persManager->add($etu);
    $etu->setEtuNum($persManager->getIdPers($_SESSION['login'])->per_num);
    $etudiantManager->add($etu);
    ?>
    <br>
    <img src="image/valid.png"> L'étudiant a été ajoutée !
    <?php
  }
  else {
    $sal = new Salarie($_SESSION['pers'],$_POST['tel_pro'],$_POST['fonction']);
    $persManager->add($sal);
    $sal->setSalNum($persManager->getIdPers($_SESSION['login'])->per_num);
    $salarieManager->add($sal);
    ?>
    <br>
    <img src="image/valid.png"> Le salarie a été ajoutée !<?php
  }
}?>

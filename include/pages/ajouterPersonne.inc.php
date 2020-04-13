<?php
if (empty($_POST['per_nom']) && empty($_POST["departement"]) && empty($_POST["fonction"])){?>

<h1>Add a person</h1>
<form method="post" action="#">
    <label>Surname :</label><input name="per_nom" type="text" required><br>
    <label>First Name : </label><input type="text" name="per_prenom" required><br>
    <label>Phone:</label><input type="tel" name="per_tel" required><br>
    <label>Email :</label><input type="email" name="per_mail" required><br>
    <label>Login :</label><input type="text" name="per_login" required><br>
    <label>Password :</label><input type="password" name="per_pwd" required><br>
		<label>Category :<input type="radio" name="categorie" value="etudiant" checked> Student
  										<input type="radio" name="categorie" value="personnel"> Staff member<br>
    <input type="submit" value="Submit">
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
        <h1><strong>Add a student</strong></h1>
        <form method="post" action="#">
            <label>School :</label><select name="departement">
            <?php
            foreach ($dep as $depart){
              ?><option value="<?php echo $depart->getDepNum();?>"><?php echo $depart->getDepNom();?></option><?php
            }
            ?>
            </select>
            <br>
            <label>Year : </label><SELECT name="annee">
            <?php
            foreach ($div as $division){
              ?><option value="<?php echo $division->getDivNum();?>"><?php echo $division->getDivNom();?></option><?php
            }
            ?>
            </select>
            <br>
            <input type="submit" value="Submit">
        </form><?php
      }
      else{?>
        <h1><strong>Add a staff member</strong></h1>
        <form method="post" action="#">
            <label>Professional phone :</label><input type="tel" name="tel_pro"><br>
            <label>Position : </label><SELECT name="fonction">
            <?php
            foreach ($fon as $fonction){
              ?><option value="<?php echo $fonction->getFonNum();?>"><?php echo $fonction->getFonLib();?></option><?php
            }
            ?>
            </select>
            <br>
            <input type="submit" value="Submit">
        </form><?php
      }
    }
    else {
        ?><meta http-equiv="refresh" content="40; URL= <?php echo $_SERVER['HTTP_REFERER'];?>">
        <strong>Login not available</strong><?php
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
    <img src="image/valid.png"> Student added successfully !
    <?php
  }
  else {
    $sal = new Salarie($_SESSION['pers'],$_POST['tel_pro'],$_POST['fonction']);
    $persManager->add($sal);
    $sal->setSalNum($persManager->getIdPers($_SESSION['login'])->per_num);
    $salarieManager->add($sal);
    ?>
    <br>
    <img src="image/valid.png"> Staff member added successfully !<?php
  }
}?>

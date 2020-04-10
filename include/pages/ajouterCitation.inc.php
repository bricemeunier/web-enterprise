<?php
$pdo=new MyPdo();
$persManager=new PersonneManager($pdo);
$salManager=new SalarieManager($pdo);
$salarie=$salManager->getAllSalarie();
$fonManager=new FonctionManager($pdo);
$fonction=$fonManager->getAllFon();
$motManager=new MotInterditManager($pdo);
$citationManager=new CitationManager($pdo);
 ?>
<h1>Ajouter une citation</h1>
<?php
if (empty($_POST['per_num'])){
 ?>
<form method="post" action="#">
    <label>Enseignant :</label><select name="per_num">
    <?php
    foreach ($salarie as $sal){
      ?><option value="<?php echo $sal->getSalNum();?>"><?php echo $sal->getSalNom();?></option><?php
    }
    ?>
    </select>
    <br>
    <label>Date Citation : </label><input type="date" name="cit_date" required>
    <br>
    <label>Citation : </label><textarea name="cit_libelle"></textarea>
    <br>
    <input type="submit" value="Valider">
</form>
<?php
}
else {
  $citation=$motManager->rechercheMotInterdit($_POST['cit_libelle']);
  $phrase=$citation[0];
  $listeMot=$citation[1];
  if (count($listeMot)!=0){
    ?>
    <form method="post" action="#">
        <label>Enseignant :</label><select name="per_num">
        <?php
        foreach ($salarie as $sal){
          if ($sal->getSalNum()==$_POST['per_num']){
            ?><option value="<?php echo $sal->getSalNum();?>" selected><?php echo $sal->getSalNom();?></option><?php
          }
          else {
          ?><option value="<?php echo $sal->getSalNum();?>"><?php echo $sal->getSalNom();?></option><?php
        }
        }
        ?>
        </select>
        <br>
        <label>Date Citation : </label><input type="date" name="cit_date" value="<?php echo $_POST['cit_date'];?>">
        <br>
        <label>Citation : </label><textarea name="cit_libelle"><?php echo $phrase;?></textarea>
        <br>
        <?php
        foreach ($listeMot as $mot){?>
          <img src="image/erreur.png"/>le mot :<strong style="color:red"> <?php echo $mot;?> </strong> n'est pas autorisé<br><?php
        }
        ?>
        <br>
        <input type="submit" value="Valider">
    </form>
  <?php
  }
  else {
    $citation=new Citation($_POST);
    $citationManager->add($citation);
    ?>
    <br>
    <img src="image/valid.png"> La citation a été ajoutée !<?php
  }
}
 ?>

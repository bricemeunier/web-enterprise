<?php
$pdo=new Mypdo();
$citationManager =new CitationManager($pdo);
$citation=$citationManager->getAllCitation();
$nbCitation=$citationManager->getNbCitation();
$salManager=new SalarieManager($pdo);
$salarie=$salManager->getAllSalarie();

?>
  <h1>Rechercher une citation</h1><br>

  <form method="post" action="#">
      <label>Nom de l'enseignant :</label><select name="per_num">
        <option value="0">----------</option>
      <?php
      foreach ($salarie as $sal){
        if (!(empty($_POST['per_num']))){
          if ($sal->getSalNum()==$_POST['per_num']){
            ?><option value="<?php echo $sal->getSalNum();?>" selected><?php echo $sal->getSalNom();?></option><?php
          }
          else {
            ?><option value="<?php echo $sal->getSalNum();?>"><?php echo $sal->getSalNom();?></option><?php
          }
        }
        else {
          ?><option value="<?php echo $sal->getSalNum();?>"><?php echo $sal->getSalNom();?></option><?php
        }

      }
      ?>
      </select>
      <label>Date Citation : </label><input type="date" name="cit_date"
      <?php if (!(empty($_POST['cit_date']))) echo "value='".$_POST['cit_date']."'";?>></input>
      <label>Note : </label><input type="text" name="cit_moy"
      <?php if (!(empty($_POST['cit_moy']))) echo "value='".$_POST['cit_moy']."'";?>></input>
      <input type="submit" value="Valider">
  </form>
  <br>
<?php

if (!(empty($_POST))){
  $citation=$citationManager->rechercheCitation();
}

if (empty($citation)){
  echo '<img src="image/erreur.png">Aucune citation n\'a été trouvée !';
}
else {
?>
<table>
  <tr><th>Nom de l'enseignement</th><th>Libellé</th><th>Date</th><th>Moyenne des notes</th><th>Noter</th></tr>
  <?php //$produits est un tableau d'objet produit
    foreach ($citation as $quote){?>
      <tr><td><?php echo $quote->getPrenomProf()." ".$quote->getNomProf();?>
      </td><td><?php echo $quote->getCitationLibelle();?>
      </td><td><?php echo $quote->getCitationDate();?>
      </td><td><?php echo $quote->getCitationMoyenne();
      if ($citationManager->aNoteLaCitation($quote->getCitationNum())==0){?>
        </td><td><a href="index.php?page=12&cit_num=<?php echo $quote->getCitationNum(); ?>"><img src="image/modifier.png"/>
          <?php
      }
      else {?>
        </td><td><img src="image/erreur.png"/>
        <?php
      }
      ?>
      </td></tr>
      <?php
    }
  ?>
  </table>
  <br>
  <?php
}

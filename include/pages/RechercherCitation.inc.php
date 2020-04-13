<?php
$pdo=new Mypdo();
$citationManager =new CitationManager($pdo);
$citation=$citationManager->getAllCitation();
$nbCitation=$citationManager->getNbCitation();
$salManager=new SalarieManager($pdo);
$salarie=$salManager->getAllSalarie();

?>
  <h1>Search a quote</h1><br>

  <form method="post" action="#">
      <label>Staff member name :</label><select name="per_num">
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
      <label>Date : </label><input type="date" name="cit_date"
      <?php if (!(empty($_POST['cit_date']))) echo "value='".$_POST['cit_date']."'";?>></input>
      <label>Mark : </label><input type="text" name="cit_moy"
      <?php if (!(empty($_POST['cit_moy']))) echo "value='".$_POST['cit_moy']."'";?>></input>
      <input type="submit" value="Submit">
  </form>
  <br>
<?php

if (!(empty($_POST))){
  $citation=$citationManager->rechercheCitation();
}

if (empty($citation)){
  echo '<img src="image/erreur.png">No quote found, try again !';
}
else {
?>
<table>
  <tr><th>Staff member name</th><th>Quote</th><th>Date</th><th>Mark average</th><th>Mark</th></tr>
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

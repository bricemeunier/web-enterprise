<?php
  $pdo=new Mypdo();
  $personneManager =new PersonneManager($pdo);
  if ($personneManager->estEtudiant($_GET['num'])){
    $personne=$personneManager->getEtudiant($_GET['num']);
    ?>
    <h1>Détail sur l'étudiant <?php echo $_GET['nom']?></h1><br>
    <table>
      <tr><th>Prénom</th><th>Mail</th><th>Tel</th><th>Département</th><th>Ville</th></tr><tr>
      <?php
      foreach($personne as $pers=>$valeur){?>
          <td><?php echo $valeur;?></td>
          <?php
        }
      ?>
      </tr>
    </table>
    <?php
  }
  else {
    $personne=$personneManager->getSalarie($_GET['num']);
    ?>
    <h1>Détail sur le salarié <?php echo $_GET['nom']?></h1><br>
    <table>
    <tr><th>Prénom</th><th>Mail</th><th>Tel</th><th>Tel pro</th><th>Fonction</th></tr><tr>
    <?php
    foreach($personne as $pers=>$valeur){?>
      <td><?php echo $valeur;?></td>
      <?php
    }
    ?>
    </tr>
    </table>
    <?php
  }
?>

<?php
  $pdo=new Mypdo();
  $personneManager =new PersonneManager($pdo);
  if ($personneManager->estEtudiant($_GET['num'])){
    $personne=$personneManager->getEtudiant($_GET['num']);
    ?>
    <h1>Details on student <?php echo $_GET['nom']?></h1><br>
    <table>
      <tr><th>First Name</th><th>Email</th><th>Phone</th><th>School</th><th>City</th></tr><tr>
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
    <h1>Details on staff member <?php echo $_GET['nom']?></h1><br>
    <table>
    <tr><th>First Name</th><th>Email</th><th>Phone</th><th>Professional phone</th><th>Position</th></tr><tr>
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

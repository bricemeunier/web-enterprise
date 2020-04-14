<?php
  $pdo=new Mypdo();
  $persManager =new PeopleManager($pdo);
  if ($persManager->isStudent($_GET['num'])){
    $person=$persManager->getDetailsStudent($_GET['num']);
    ?>
    <h1>Details on student <?php echo $_GET['name']?></h1><br>
    <table>
      <tr><th>First Name</th><th>Email</th><th>Phone</th><th>School</th><th>City</th></tr><tr>
      <?php
      foreach($person as $pers=>$val){?>
          <td><?php echo $val;?></td>
          <?php
        }
      ?>
      </tr>
    </table>
    <?php
  }
  else {
    $person=$persManager->getDetailsStaff($_GET['num']);
    ?>
    <h1>Details on staff member <?php echo $_GET['name']?></h1><br>
    <table>
    <tr><th>First Name</th><th>Email</th><th>Phone</th><th>Professional phone</th><th>Position</th></tr><tr>
    <?php
    foreach($person as $pers=>$val){?>
      <td><?php echo $val;?></td>
      <?php
    }
    ?>
    </tr>
    </table>
    <?php
  }
?>

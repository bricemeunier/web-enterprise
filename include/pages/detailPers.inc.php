<?php
  $pdo=new Mypdo();
  $persManager =new PeopleManager($pdo);
  if ($persManager->isStudent($_GET['num'])){
    $person=$persManager->getDetailsStudent($_GET['num']);
    ?>
    <h1>Details on student <?php echo $_GET['name']?></h1><br>
    <table id="bigForm" class="highlight centered">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>School</th>
          <th>City</th>
        </tr>
      </thead>
      <tbody>
        <tr>
        <?php
        foreach($person as $pers=>$val){?>
            <td><?php echo $val;?></td>
            <?php
          }
        ?>
      </tr>
    </tbody>
  </table>
  <?php
  }
  else {
    $person=$persManager->getDetailsStaff($_GET['num']);
    ?>
    <h1>Details on staff member <?php echo $_GET['name']?></h1><br>
    <table id="bigForm" class="centered">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Professional phone</th>
          <th>Position</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php
          foreach($person as $pers=>$val){?>
            <td><?php echo $val;?></td>
            <?php
          }
          ?>
        </tr>
      </tbody>
    </table>
    <?php
  }
?>

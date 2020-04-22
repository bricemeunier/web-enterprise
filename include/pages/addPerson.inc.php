<?php
if (empty($_POST['per_name']) && empty($_POST["school"]) && empty($_POST["position"])){?>

<h1>Add a person</h1>
<div class="row" id="bigForm">
  <form class="col s12" method="post" action="#">
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">face</i>
        <input id="first_name" type="text" name="per_f_name" class="validate" required>
        <label for="first_name">First Name</label>
      </div>
      <div class="input-field col s6">
        <input id="last_name" type="text" name="per_name" class="validate" required>
        <label for="last_name">Last Name</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">phone</i>
        <input id="tel_number" type="tel" name="per_phone" class="validate" required>
        <label for="tel_number">Phone</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">email</i>
        <input id="email_address" type="email" name="per_email" class="validate" required>
        <label for="email_address">Email</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">account_circle</i>
        <input id="username" type="text" name="per_login" class="validate" required>
        <label for="username">Username</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">lock</i>
        <input id="password" type="password" name="per_password" class="validate" required>
        <label for="password">Password</label>
      </div>
    </div>
    <label>
      <input class="with-gap" name="category" type="radio" value="student" checked />
      <span>Student</span>
    </label>
    <label>
      <input class="with-gap" name="category" type="radio" value="staff"/>
      <span>Staff member</span>
    </label>
    <button class="btn waves-effect waves-light" type="submit" name="action">Submit
      <i class="material-icons right">send</i>
    </button>
  </form>
</div>
<?php
}

else if (empty($_POST["school"]) && empty($_POST["position"]) && !empty($_POST["per_name"])) {
  $_POST = array_map ( 'htmlspecialchars' , $_POST );
  $pdo=new Mypdo();
  $persManager=new PeopleManager($pdo);
  $schManager=new SchoolManager($pdo);
  $yearManager=new YearManager($pdo);
  $posManager=new PositionManager($pdo);
  $pos=$posManager->getAllPosition();
  $sch=$schManager->getAllSchool();
  $year=$yearManager->getAllYear();
  $_SESSION['pers']=$_POST;
  $loginValid=$persManager->researchLogin($_POST['per_login']);
  $_SESSION['login']=$_POST['per_login'];

  if ($loginValid->result==0){
      if ($_POST['category']=='student'){?>
        <h1><strong>Add a student</strong></h1>
        <div class="row" id="smallForm">
          <form method="post" class="col s12" action="#">
            <div class="row">
              <div class="col s12">
                <label>Select school</label>
                <select class="browser-default" name="school">
                  <option value="" disabled selected>Choose your option</option>
                  <?php
                  foreach ($sch as $s){
                    ?><option value="<?php echo $s->getSchNum();?>"><?php echo $s->getSchName();?></option><?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col s12">
                <label>Select year</label>
                <select class="browser-default" name="year">
                  <option value="" disabled selected>Choose your option</option>
                  <?php
                  foreach ($year as $y){
                    ?><option value="<?php echo $y->getYearNum();?>"><?php echo $y->getYearName();?></option><?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
              <i class="material-icons right">send</i>
            </button>
          </form>
        </div><?php
      }
      else{?>
        <h1><strong>Add a staff member</strong></h1>
        <div class="row" id="smallForm">
          <form method="post" class="col s12" action="#">
            <div class="row">
              <div class="input-field col s12">
                <i class="material-icons prefix">phone</i>
                <input id="proPhoneForm" type="tel" name="staff_pro_phone" class="validate" required>
                <label for="proPhoneForm">Professional phone</label>
              </div>
            </div>
            <div class="row">
              <div class="col s12">
                <label>Select position</label>
                <select class="browser-default" name="position">
                  <option value="" disabled selected>Choose your option</option>
                  <?php
                  foreach ($pos as $position){
                    ?><option value="<?php echo $position->getPosNum();?>"><?php echo $position->getPosName();?></option><?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
              <i class="material-icons right">send</i>
            </button>
          </form>
        </div><?php
      }
    }
    else {
        ?><meta http-equiv="refresh" content="40; URL= <?php echo $_SERVER['HTTP_REFERER'];?>">
        <strong>Login not available</strong><?php
    }
}
else {
  $pdo=new Mypdo();
  $studentManager=new StudentManager($pdo);
  $staffManager=new StaffManager($pdo);
  $persManager=new PeopleManager($pdo);
  if (isset($_POST['year'])){
    $stu = new Student($_SESSION['pers'],$_POST['school'],$_POST['year']);
    $persManager->add($stu);
    $stu->setStudentNum($persManager->getIdPerson($_SESSION['login'])->per_num);
    $studentManager->add($stu);
    ?>
    <br>
    <img src="image/valid.png"> Student added successfully !
    <p>Automatic redirection in 2 seconds.</p>
    <meta http-equiv="refresh" content="2; URL=index.php?page=2">
    <?php
  }
  else {
    $sta = new Staff($_SESSION['pers'],$_POST['staff_pro_phone'],$_POST['position']);
    $persManager->add($sta);
    $sta->setStaffNum($persManager->getIdPerson($_SESSION['login'])->per_num);
    $staffManager->add($sta);
    ?>
    <br>
    <img src="image/valid.png"> Staff member added successfully !
    <p>Automatic redirection in 2 seconds.</p>
    <meta http-equiv="refresh" content="2; URL=index.php?page=2"><?php
  }
}?>

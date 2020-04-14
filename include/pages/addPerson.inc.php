<?php
if (empty($_POST['per_name']) && empty($_POST["school"]) && empty($_POST["position"])){?>

<h1>Add a person</h1>
<form method="post" action="#">
    <label>Surname :</label><input name="per_name" type="text" required><br>
    <label>First Name : </label><input type="text" name="per_f_name" required><br>
    <label>Phone:</label><input type="tel" name="per_phone" required><br>
    <label>Email :</label><input type="email" name="per_email" required><br>
    <label>Login :</label><input type="text" name="per_login" required><br>
    <label>Password :</label><input type="password" name="per_password" required><br>
		<label>Category :<input type="radio" name="category" value="student" checked> Student
  										<input type="radio" name="category" value="staff"> Staff member<br>
    <input type="submit" value="Submit">
</form>
<?php
}

else if (empty($_POST["school"]) && empty($_POST["position"]) && !empty($_POST["per_name"])) {

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
        <form method="post" action="#">
            <label>School :</label><select name="school">
            <?php
            foreach ($sch as $s){
              ?><option value="<?php echo $s->getSchNum();?>"><?php echo $s->getSchName();?></option><?php
            }
            ?>
            </select>
            <br>
            <label>Year : </label><SELECT name="year">
            <?php
            foreach ($year as $y){
              ?><option value="<?php echo $y->getYearNum();?>"><?php echo $y->getYearName();?></option><?php
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
            <label>Professional phone :</label><input type="tel" name="staff_pro_phone"><br>
            <label>Position : </label><SELECT name="position">
            <?php
            foreach ($pos as $position){
              ?><option value="<?php echo $position->getPosNum();?>"><?php echo $position->getPosName();?></option><?php
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
    <?php
  }
  else {
    $sta = new Staff($_SESSION['pers'],$_POST['staff_pro_phone'],$_POST['position']);
    $persManager->add($sta);
    $sta->setStaffNum($persManager->getIdPerson($_SESSION['login'])->per_num);
    $staffManager->add($sta);
    ?>
    <br>
    <img src="image/valid.png"> Staff member added successfully !<?php
  }
}?>

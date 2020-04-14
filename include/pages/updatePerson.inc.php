<?php
	$pdo=new Mypdo();
	$persManager =new PeopleManager($pdo);
	$studentManager=new StudentManager($pdo);
	$staffManager=new StaffManager($pdo);
	$schManager=new SchoolManager($pdo);
	$yearManager=new YearManager($pdo);
	$posManager=new PositionManager($pdo);
	$person=$persManager->getAllPeople();
	$nbPerson=$persManager->getPeopleNumber();
	$pos=$posManager->getAllPosition();
	$sch=$schManager->getAllSchool();
	$year=$yearManager->getAllYear();

	if (empty($_GET['num'])){
	?>
	<h1>Update people's info</h1><br>
	<h3>Currently <?php echo $nbPerson->total; ?> people registered</h3>
	<table>
		<tr><th>Surname</th><th>First Name</th><th>Update</th></tr>
		<?php
			foreach ($person as $pers){?>
			</td><td><?php echo $pers->getPersonName();?>
			</td><td><?php echo $pers->getPersonFirstName();?>
			</td><td><a href=index.php?page=3&num=<?php echo $pers->getPersonNum();?>><img src="image/update.png"></a>
				</td></tr>
				<?php
			}
		?>
	</table>
	<?php
	}
	else {
		if (empty($_POST['per_name']) && empty($_POST["school"]) && empty($_POST["position"])) {
			$pers=$persManager->getPerson($_GET['num']);?>
			<h1>Update people's info</h1><br>
			<form method="post" action="index.php?page=3&num=<?php echo $_GET['num'];?>">
			    <label>Surname :</label><input name="per_name" type="text" value=<?php echo $pers->getPersonName();?> required><br>
			    <label>First Name : </label><input type="text" name="per_f_name" value=<?php echo $pers->getPersonFirstName();?> required><br>
			    <label>Phone:</label><input type="tel" name="per_phone" value=<?php echo $pers->getPersonPhone();?> required><br>
			    <label>Email :</label><input type="email" name="per_email" value=<?php echo $pers->getPersonEmail();?> required><br>
			    <label>Login :</label><input type="text" name="per_login" value=<?php echo $pers->getPersonLogin();?> required><br>
			    <label>Change password :</label><input type="password" name="per_password" ><br>
					<?php
					if ($persManager->isStudent($_GET['num'])) {?>
						<label>Category :</label><input type="radio" name="category" value="student" checked> Student
			  															<input type="radio" name="category" value="staff" disabled> Staff member<br>
					<?php
					}
					else {?>
						<label>Category :</label><input type="radio" name="category" value="student" disabled> Student
			  										<input type="radio" name="category" value="staff" checked> Staff member<br>
					<?php
					}
					?>
			    <input type="submit" value="Submit">
			</form>
			<?php
		}

		else if (empty($_POST["school"]) && empty($_POST["position"])) {
			if (!(empty($_POST['per_password']))){
				$p=new People();
				$p->setPersonPassword($_POST['per_password']);
				$_POST['per_password']=$p->getPersonPassword();
			}
		  $_SESSION['pers']=$_POST;
		  $loginValid=$persManager->checkIfLoginIsAvailable($_POST['per_login'],$_GET['num']);
		  $_SESSION['previouslogin']=$_POST['per_login'];
			$num=$persManager->getIdPerson($_SESSION['previouslogin'])->per_num;
			$_SESSION['numPersUpdated']=$num;

		  if ($loginValid){

		      if ($_POST['category']=='student'){

						$stu=$persManager->getStudent($num);
						?>
		        <h1><strong>Update student's info</strong></h1>
		        <form method="post" action="index.php?page=3&num=<?php echo $_GET['num'];?>">
		            <label>School :</label><select name="school">
		            <?php
		            foreach ($sch as $school){
									if ($school->getSchNum()==$stu->sch_num){
		              	?><option value="<?php echo $school->getSchNum();?>" selected><?php echo $school->getSchName();?></option><?php
									}
									else {
										?><option value="<?php echo $school->getSchNum();?>"><?php echo $school->getSchName();?></option><?php
									}
		            }
		            ?>
		            </select>
		            <br>
		            <label>Year : </label><select name="year">
		            <?php
		            foreach ($year as $y){
									if ($y->getYearNum()==$stu->year_num){
		              	?><option value="<?php echo $y->getYearNum();?>" selected><?php echo $y->getYearName();?></option><?php
									}
									else {
										?><option value="<?php echo $y->getYearNum();?>"><?php echo $y->getYearName();?></option><?php
									}
		            }
		            ?>
		            </select>
		            <br>
		            <input type="submit" value="Submit">
		        </form><?php
		      }
		      else{
						$sta=$persManager->getStaff($_SESSION['numPersUpdated']);
						?>
		        <h1><strong>Update staff member's info</strong></h1>
		        <form method="post" action="index.php?page=3&num=<?php echo $_GET['num'];?>">
		            <label>Professional phone :</label><input type="tel" name="staff_pro_phone" value=<?php echo $sta->staff_pro_phone;?> required><br>
		            <label>Position : </label><SELECT name="position">
		            <?php
		            foreach ($pos as $position){
									if ($position->getPosNum()==$sta->pos_num){
		              	?><option value="<?php echo $position->getPosNum();?>" selected><?php echo $position->getPosName();?></option><?php
									}
									else {
										?><option value="<?php echo $position->getPosNum();?>"><?php echo $position->getPosName();?></option><?php
									}
		            }
		            ?>
		            </select>
		            <br>
		            <input type="submit" value="Submit">
		        </form><?php
		      }
		    }
		    else {
		        ?><meta http-equiv="refresh" content="3; URL= <?php echo $_SERVER['HTTP_REFERER'];?>">
		        <strong>Login <?php echo $_POST['per_login'];?> not available</strong><?php
		    }
		}
		else {
		  if (isset($_POST['year'])){
		    $studentManager->updateStudent($_SESSION['numPersUpdated']);
		    ?>
		    <br>
		    <img src="image/valid.png"> Student added successfully !
		    <?php
		  }
		  else {
				$staffManager->updateStaff($_SESSION['numPersUpdated']);
				/*
		    $sta = new Staff($_SESSION['pers'],$_POST['staff_pro_phone'],$_POST['position']);
		    $persManager->add($sta);
		    $sta->setStaffNum($persManager->getIdPerson($_SESSION['previouslogin'])->per_num);
		    $staffManager->add($sta);
				*/
		    ?>
		    <br>
		    <img src="image/valid.png"> Staff member added successfully !<?php
		  }
		}
	}
 ?>

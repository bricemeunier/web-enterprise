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
	<table id="bigForm" class="highlight centered">
		<thead>
			<tr>
				<th>Surname</th>
				<th>First Name</th>
				<th>Update</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($person as $pers){?>
				</td><td><?php echo $pers->getPersonName();?>
				</td><td><?php echo $pers->getPersonFirstName();?>
				</td><td><a href=index.php?page=3&num=<?php echo $pers->getPersonNum();?>><i class="material-icons prefix">create</i></a>
					</td></tr>
					<?php
				}
			?>
		</tbody>
	</table>
	<?php
	}
	else {
		if (empty($_POST['per_name']) && empty($_POST["school"]) && empty($_POST["position"])) {
			$pers=$persManager->getPerson($_GET['num']);?>
			<h1>Update people's info</h1><br>
			<div class="row" id="bigForm">
			  <form class="col s12" method="post" action="index.php?page=3&num=<?php echo $_GET['num'];?>">
			    <div class="row">
			      <div class="input-field col s6">
			        <i class="material-icons prefix">face</i>
			        <input id="first_name" type="text" name="per_f_name" class="validate" value=<?php echo $pers->getPersonFirstName();?> required>
			        <label for="first_name">First Name</label>
			      </div>
			      <div class="input-field col s6">
			        <input id="last_name" type="text" name="per_name" class="validate" value=<?php echo $pers->getPersonName();?> required>
			        <label for="last_name">Last Name</label>
			      </div>
			    </div>
			    <div class="row">
			      <div class="input-field col s12">
			        <i class="material-icons prefix">phone</i>
			        <input id="tel_number" type="tel" name="per_phone" class="validate" value=<?php echo $pers->getPersonPhone();?> required>
			        <label for="tel_number">Phone</label>
			      </div>
			    </div>
			    <div class="row">
			      <div class="input-field col s12">
			        <i class="material-icons prefix">email</i>
			        <input id="email_address" type="email" name="per_email" class="validate" value=<?php echo $pers->getPersonEmail();?> required>
			        <label for="email_address">Email</label>
			      </div>
			    </div>
			    <div class="row">
			      <div class="input-field col s12">
			        <i class="material-icons prefix">account_circle</i>
			        <input id="username" type="text" name="per_login" class="validate" value=<?php echo $pers->getPersonLogin();?> required>
			        <label for="username">Username</label>
			      </div>
			    </div>
			    <div class="row">
			      <div class="input-field col s12">
			        <i class="material-icons prefix">lock</i>
			        <input id="password" type="password" name="per_password" class="validate">
			        <label for="password">New Password</label>
			      </div>
			    </div>
					<?php
					if ($persManager->isStudent($_GET['num'])) {?>
				    <label>
				      <input class="with-gap" name="category" type="radio" value="student" checked />
				      <span>Student</span>
				    </label>
				    <label>
				      <input class="with-gap" name="category" type="radio" value="staff" disabled="disabled" />
				      <span>Staff member</span>
				    </label>
					<?php
					}
					else {?>
						<label>
							<input class="with-gap" name="category" type="radio" value="student" disabled="disabled" />
							<span>Student</span>
						</label>
						<label>
							<input class="with-gap" name="category" type="radio" value="staff" checked/>
							<span>Staff member</span>
						</label>
					<?php
					}
					?>
			    <button class="btn waves-effect waves-light" type="submit" name="action">Submit
			      <i class="material-icons right">send</i>
			    </button>
			  </form>
			</div>
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
			$_SESSION['numPersUpdated']=$_GET['num'];

		  if ($loginValid){

		      if ($_POST['category']=='student'){

						$stu=$persManager->getStudent($_SESSION['numPersUpdated']);
						?>
		        <h1><strong>Update student's info</strong></h1>
						<div class="row" id="smallForm">
		          <form method="post" class="col s12" action="index.php?page=3&num=<?php echo $_GET['num'];?>">
		            <div class="row">
		              <div class="col s12">
		                <label>Select school</label>
		                <select class="browser-default" name="school">
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
		              </div>
		            </div>
		            <div class="row">
		              <div class="col s12">
		                <label>Select year</label>
		                <select class="browser-default" name="year">
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
		              </div>
		            </div>
		            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
		              <i class="material-icons right">send</i>
		            </button>
		          </form>
		        </div>
		       <?php
		      }
		      else{
						$sta=$persManager->getStaff($_SESSION['numPersUpdated']);
						?>
		        <h1><strong>Update staff member's info</strong></h1>
						<div class="row" id="smallForm">
		          <form method="post" class="col s12" action="index.php?page=3&num=<?php echo $_GET['num'];?>">
		            <div class="row">
		              <div class="input-field col s12">
		                <i class="material-icons prefix">phone</i>
		                <input id="proPhoneForm" type="tel" name="staff_pro_phone" class="validate" value=<?php echo $sta->staff_pro_phone;?> required>
		                <label for="proPhoneForm">Professional phone</label>
		              </div>
		            </div>
		            <div class="row">
		              <div class="col s12">
		                <label>Select position</label>
		                <select class="browser-default" name="position">
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
		              </div>
		            </div>
		            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
		              <i class="material-icons right">send</i>
		            </button>
		          </form>
		        </div>
		        <?php
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
				<p>Automatic redirection in 2 seconds.</p>
				<meta http-equiv="refresh" content="2; URL=index.php?page=2">
		    <?php
		  }
		  else {
				$staffManager->updateStaff($_SESSION['numPersUpdated']);
		    ?>
		    <br>
		    <img src="image/valid.png"> Staff member added successfully !
				<p>Automatic redirection in 2 seconds.</p>
				<meta http-equiv="refresh" content="2; URL=index.php?page=2"><?php
		  }
		}
	}
 ?>

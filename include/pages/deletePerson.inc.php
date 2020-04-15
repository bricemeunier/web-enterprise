<?php
$pdo=new MyPdo();
$persManager=new PeopleManager($pdo);
$person=$persManager->getAllPeople();

 if (empty($_POST['per_num'])){
	?>
	<h1>Delete a person</h1>
  <div class="row" id="smallForm">
    <form method="post" class="col s12" action="#">
     <div class="row">
       <div class="col s12">
         <label>Select Person</label>
         <select class="browser-default" name="per_num">
           <option value="" disabled selected>Choose person</option>
           <?php
           foreach ($person as $pers){
    	       ?><option value="<?php echo $pers->getPersonNum();?>"><?php echo $pers->getPersonFirstName()." ".$pers->getPersonName();?></option><?php
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
	else {
	  $persManager->deletePerson($_POST['per_num']);
	  ?>
	  <br>
	  <img src="image/valid.png"><p>Person successfully deleted !</p>
	  <p>Automatic redirection in 2 seconds.</p>
	  <meta http-equiv="refresh" content="2; URL=index.php?page=4"><?php
	} ?>

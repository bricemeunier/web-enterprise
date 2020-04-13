<?php
$pdo=new MyPdo();
$cityManager=new CityManager($pdo);
$ville=$cityManager->getAllCity();

 if (empty($_POST['vil_num'])){
  ?>
<h1>Delete a city</h1>

 <form method="post" action="#">
   <label>City :</label><select name="vil_num">
     <?php
     foreach ($ville as $city){
       ?><option value="<?php echo $city->getCityNum();?>"><?php echo $city->getCityNom();?></option><?php
     }
     ?>
   </select>
   <input type="submit" value="Submit">
 </form>
<?php
}
else {
  $cityManager->supCity($_POST['vil_num']);
  ?>
  <br>
  <img src="image/valid.png"><p> City successfully deleted !</p>
  <p>Automatic redirection in 2 seconds.</p>
  <meta http-equiv="refresh" content="2; URL=index.php?page=16"><?php
} ?>

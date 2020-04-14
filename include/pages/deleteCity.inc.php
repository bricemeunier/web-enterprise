<?php
$pdo=new MyPdo();
$cityManager=new CityManager($pdo);
$city=$cityManager->getAllCity();

 if (empty($_POST['city_num'])){
  ?>
<h1>Delete a city</h1>

 <form method="post" action="#">
   <label>City :</label><select name="city_num">
     <?php
     foreach ($city as $c){
       ?><option value="<?php echo $c->getCityNum();?>"><?php echo $c->getCityName();?></option><?php
     }
     ?>
   </select>
   <input type="submit" value="Submit">
 </form>
<?php
}
else {
  $cityManager->deleteCity($_POST['city_num']);
  ?>
  <br>
  <img src="image/valid.png"><p> City successfully deleted !</p>
  <p>Automatic redirection in 2 seconds.</p>
  <meta http-equiv="refresh" content="2; URL=index.php?page=16"><?php
} ?>

<?php
$pdo=new MyPdo();
$cityManager=new CityManager($pdo);
$city=$cityManager->getAllCity();

 if (empty($_POST['city_num'])){
  ?>
<h1>Delete a city</h1>
<div class="row" id="smallForm">
  <form method="post" class="col s12" action="#">
   <div class="row">
     <div class="col s12">
       <label>Select City</label>
       <select class="browser-default" name="city_num">
         <option value="" disabled selected>Choose city</option>
         <?php
         foreach ($city as $c){
           ?><option value="<?php echo $c->getCityNum();?>"><?php echo $c->getCityName();?></option><?php
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
  $cityManager->deleteCity($_POST['city_num']);
  ?>
  <br>
  <img src="image/valid.png"><p> City successfully deleted !</p>
  <p>Automatic redirection in 2 seconds.</p>
  <meta http-equiv="refresh" content="2; URL=index.php?page=16"><?php
} ?>

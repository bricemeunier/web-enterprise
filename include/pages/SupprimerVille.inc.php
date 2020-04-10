<?php
$pdo=new MyPdo();
$cityManager=new CityManager($pdo);
$ville=$cityManager->getAllCity();

 if (empty($_POST['vil_num'])){
  ?>
<h1>Supprimer une ville</h1>

 <form method="post" action="#">
   <label>Ville :</label><select name="vil_num">
     <?php
     foreach ($ville as $city){
       ?><option value="<?php echo $city->getCityNum();?>"><?php echo $city->getCityNom();?></option><?php
     }
     ?>
   </select>
   <input type="submit" value="Valider">
 </form>
<?php
}
else {
  $cityManager->supCity($_POST['vil_num']);
  ?>
  <br>
  <img src="image/valid.png"><p> La ville a été supprimée !</p>
  <p>Redirection automatique dans 2 secondes</p>
  <meta http-equiv="refresh" content="2; URL=index.php?page=16"><?php
} ?>

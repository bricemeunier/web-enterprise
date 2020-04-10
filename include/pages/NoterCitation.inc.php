<h1><strong>Noter une citation</strong></h1>
<?php
if (empty($_POST['note'])){
  ?>
  <form action="index.php?page=12&cit_num=<?php echo $_GET['cit_num'];?>" method="post">
    <strong>Note: </strong><input type="number" name="note" min="0" max="20" required><br>
    <input type="submit" value="Valider"/>
  </form>
  <?php
}
else {
	$pdo=new Mypdo();
	$citationManager=new CitationManager($pdo);
  $citationManager->ajouterNote($_POST['note'],$_GET['cit_num']);
  ?>
  <img src="image/valid.png"> Votre note de <?php echo $_POST['note'];?> a été ajoutée !<br>
  Redirection automatique dans 2 secondes.
  <meta http-equiv="refresh" content="2; URL=index.php?page=6">
  <?php
}?>

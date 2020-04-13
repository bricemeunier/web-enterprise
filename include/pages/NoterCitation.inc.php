<h1><strong>Mark a quote</strong></h1>
<?php
if (empty($_POST['note'])){
  ?>
  <form action="index.php?page=12&cit_num=<?php echo $_GET['cit_num'];?>" method="post">
    <strong>Mark (0 to 20): </strong><input type="number" name="note" min="0" max="20" required><br>
    <input type="submit" value="Submit"/>
  </form>
  <?php
}
else {
	$pdo=new Mypdo();
	$citationManager=new CitationManager($pdo);
  $citationManager->ajouterNote($_POST['note'],$_GET['cit_num']);
  ?>
  <img src="image/valid.png"> Your mark of <?php echo $_POST['note'];?> has been added successfully !<br>
  Automatic redirection in 2 seconds.
  <meta http-equiv="refresh" content="2; URL=index.php?page=6">
  <?php
}?>

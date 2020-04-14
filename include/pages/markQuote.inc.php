<h1><strong>Mark a quote</strong></h1>
<?php
if (empty($_POST['mark_value'])){
  ?>
  <form action="index.php?page=12&quo_num=<?php echo $_GET['quo_num'];?>" method="post">
    <strong>Mark (0 to 20): </strong><input type="number" name="mark_value" min="0" max="20" required><br>
    <input type="submit" value="Submit"/>
  </form>
  <?php
}
else {
	$pdo=new Mypdo();
	$quoteManager=new QuoteManager($pdo);
  $quoteManager->addMark($_POST['mark_value'],$_GET['quo_num']);
  ?>
  <img src="image/valid.png"> Your mark of <?php echo $_POST['mark_value'];?> has been added successfully !<br>
  Automatic redirection in 2 seconds.
  <meta http-equiv="refresh" content="2; URL=index.php?page=6">

  <?php
}?>

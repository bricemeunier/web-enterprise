<h1><strong>Mark a quote</strong></h1>
<?php
if (empty($_POST['mark_value'])){
  ?>
  <div class="row" id="smallForm">
    <form class="col s12" action="index.php?page=12&quo_num=<?php echo $_GET['quo_num'];?>" method="post">
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">grade</i>
          <input id="gradeForm" type="number" name="mark_value" min="0" max="20" class="validate" required>
          <label for="gradeForm">Grade from 0 to 20</label>
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
	$pdo=new Mypdo();
	$quoteManager=new QuoteManager($pdo);
  $quoteManager->addMark($_POST['mark_value'],$_GET['quo_num']);
  ?>
  <img src="image/valid.png"> Your mark of <?php echo $_POST['mark_value'];?> has been added successfully !<br>
  Automatic redirection in 2 seconds.
  <meta http-equiv="refresh" content="2; URL=index.php?page=6">

  <?php
}?>

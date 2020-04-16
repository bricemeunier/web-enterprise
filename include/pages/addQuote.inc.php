<?php
$pdo=new MyPdo();
$persManager=new PeopleManager($pdo);
$staffManager=new StaffManager($pdo);
$staff=$staffManager->getAllStaff();
$posManager=new PositionManager($pdo);
$position=$posManager->getAllPosition();
$badWordManager=new BadWordManager($pdo);
$quoteManager=new QuoteManager($pdo);
 ?>
<h1>Add a quote</h1>
<?php
if (empty($_POST['per_num'])){
 ?>
<div class="row" id="bigForm">
  <form method="post" class="col s12" action="#">
    <div class="row">
      <div class="col s12">
        <label>Select Member</label>
        <select class="browser-default" name="per_num">
          <option value="" disabled selected>Choose your option</option>
          <?php
          foreach ($staff as $st){
            ?><option value="<?php echo $st->getStaffNum();?>"><?php echo $st->getStaffName();?></option><?php
          }
          ?>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">calendar_today</i>
        <input type="text" class="datepicker" name="quo_date" required>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <textarea id="quoteTextArea" class="materialize-textarea" name="quo_quote" required></textarea>
        <label for="quoteTextArea">Write the quote here...</label>
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
  $quote=$badWordManager->findBadWord($_POST['quo_quote']);
  $str=$quote[0];
  $listWord=$quote[1];
  if (count($listWord)!=0){
    ?>
    <div class="row" id="bigForm">
      <form method="post" class="col s12" action="#">
        <div class="row">
          <div class="col s12">
            <label>Select Member</label>
            <select class="browser-default" name="per_num">
              <?php
              foreach ($staff as $st){
                if ($st->getStaffNum()==$_POST['per_num']){
                  ?><option value="<?php echo $st->getStaffNum();?>" selected><?php echo $st->getStaffName();?></option><?php
                }
                else {
                ?><option value="<?php echo $st->getStaffNum();?>"><?php echo $st->getStaffName();?></option><?php
                }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">calendar_today</i>
            <input type="text" class="datepicker" name="quo_date" value="<?php echo $_POST['quo_date'];?>" required>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <textarea id="quoteTextArea" class="materialize-textarea" name="quo_quote" required><?php echo $str;?></textarea>
          </div>
        </div>
        <?php
        foreach ($listWord as $word){?>
          <div class="row">
            <div class="input-field col s12">
              <img src="image/error.png"/><strong style="color:red"> <?php echo $word;?> </strong> is not allowed
            </div>
          </div><?php
        }
        ?>
        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
          <i class="material-icons right">send</i>
        </button>
      </form>
    </div>
  <?php
  }
  else {
    $quote=new Quote($_POST);
    $quoteManager->add($quote);
    ?>
    <br>
    <img src="image/valid.png"> Quote successfully added !
    <p>Automatic redirection in 2 seconds.</p>
    <meta http-equiv="refresh" content="2; URL=index.php?page=13"><?php
  }
}
 ?>

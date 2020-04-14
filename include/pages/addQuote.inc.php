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
<form method="post" action="#">
    <label>Staff member :</label><select name="per_num">
    <?php
    foreach ($staff as $st){
      ?><option value="<?php echo $st->getStaffNum();?>"><?php echo $st->getStaffName();?></option><?php
    }
    ?>
    </select>
    <br>
    <label>Date : </label><input type="date" name="quo_date" required>
    <br>
    <label>Quote : </label><textarea name="quo_quote"></textarea>
    <br>
    <input type="submit" value="Submit">
</form>
<?php
}
else {
  $quote=$badWordManager->findBadWord($_POST['quo_quote']);
  $str=$quote[0];
  $listWord=$quote[1];
  if (count($listWord)!=0){
    ?>
    <form method="post" action="#">
        <label>Staff member :</label><select name="per_num">
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
        <br>
        <label>Date : </label><input type="date" name="quo_date" value="<?php echo $_POST['quo_date'];?>">
        <br>
        <label>Quote : </label><textarea name="quo_quote"><?php echo $str;?></textarea>
        <br>
        <?php
        foreach ($listWord as $word){?>
          <img src="image/erreur.png"/><strong style="color:red"> <?php echo $word;?> </strong> is not allowed<br><?php
        }
        ?>
        <br>
        <input type="submit" value="Submit">
    </form>
  <?php
  }
  else {
    $quote=new Quote($_POST);
    $quoteManager->add($quote);
    ?>
    <br>
    <img src="image/valid.png"> Quote successfully added !<?php
  }
}
 ?>

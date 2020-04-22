<?php
$pdo=new Mypdo();
$quoteManager =new QuoteManager($pdo);
$quote=$quoteManager->getAllQuotes();
$nbCitation=$quoteManager->getQuotesNumber();
$staffManager=new StaffManager($pdo);
$staff=$staffManager->getAllStaff();

?>
<h1>Search a quote</h1><br>
<div class="row" id="searchForm">
  <form method="post" class="col s12" action="#">
    <div class="row">
      <div class="col s3">
        <label>Select Member</label>
        <select class="browser-default" name="per_num">
          <option value="0">-----------</option>
          <?php
          foreach ($staff as $sta){
            if (!(empty($_POST['per_num']))){
              if ($sta->getStaffNum()==$_POST['per_num']){
                ?><option value="<?php echo $sta->getStaffNum();?>" selected><?php echo $sta->getStaffName();?></option><?php
              }
              else {
                ?><option value="<?php echo $sta->getStaffNum();?>"><?php echo $sta->getStaffName();?></option><?php
              }
            }
            else {
              ?><option value="<?php echo $sta->getStaffNum();?>"><?php echo $sta->getStaffName();?></option><?php
            }
          }
          ?>
        </select>
      </div>
      <div class="input-field col s3">
        <i class="material-icons prefix">calendar_today</i>
        <input type="text" class="datepicker" name="quo_date" <?php if (!(empty($_POST['quo_date']))) echo "value='".$_POST['quo_date']."'";?>>
      </div>
      <div class="input-field col s2">
        <input id="markForm" type="number" name="quo_moy" <?php if (!(empty($_POST['quo_moy']))) echo "value='".$_POST['quo_moy']."'";?>>
        <label for="markForm">Mark</label>
      </div>
      <div class="input-field col s3">
        <button class="btn waves-effect waves-light" type="submit" name="action">Search
          <i class="material-icons right">send</i>
        </button>
      </div>
    </div>
  </form>
</div>

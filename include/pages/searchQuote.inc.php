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
<?php

if (!(empty($_POST))){
  $quote=$quoteManager->searchQuote();
}

if (empty($quote)){
  echo '<img src="image/error.png">No quote found, try again !';
}
else {
?>
<table id="bigTable" class="highlight centered">
  <thead>
    <tr>
      <th>Staff member name</th>
      <th>Quote</th>
      <th>Date</th>
      <th>Mark average</th>
      <th>Mark</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($quote as $q){?>
        <tr><td><?php echo $q->getStaffFirstName()." ".$q->getStaffName();?>
        </td><td><?php echo $q->getQuoteText();?>
        </td><td><?php echo $q->getQuoteDate();?>
        </td><td><?php if (intVal($q->getQuoteAverageMark())>0) echo intVal($q->getQuoteAverageMark())."/20"; else echo "N/A";
        if ($quoteManager->hasMarkedQuote($q->getQuoteNum())==0){?>
        </td><td><a href="index.php?page=12&quo_num=<?php echo $q->getQuoteNum(); ?>"><i class="material-icons prefix">grade</i></a>
            <?php
        }
        else {?>
        </td><td><i style="color:green;" class="material-icons prefix">done</i>
          <?php
        }
        ?>
        </td></tr>
        <?php
      }
    ?>
  </tbody>
</table>
<br>
  <?php
}

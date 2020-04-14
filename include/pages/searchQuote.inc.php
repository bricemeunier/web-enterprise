<?php
$pdo=new Mypdo();
$quoteManager =new QuoteManager($pdo);
$quote=$quoteManager->getAllQuotes();
$nbCitation=$quoteManager->getQuotesNumber();
$staffManager=new StaffManager($pdo);
$staff=$staffManager->getAllStaff();

?>
  <h1>Search a quote</h1><br>

  <form method="post" action="#">
      <label>Staff member name :</label><select name="per_num">
        <option value="0">----------</option>
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
      <label>Date : </label><input type="date" name="quo_date"
      <?php if (!(empty($_POST['quo_date']))) echo "value='".$_POST['quo_date']."'";?>></input>
      <label>Mark : </label><input type="text" name="quo_moy"
      <?php if (!(empty($_POST['quo_moy']))) echo "value='".$_POST['quo_moy']."'";?>></input>
      <input type="submit" value="Submit">
  </form>
  <br>
<?php

if (!(empty($_POST))){
  $quote=$quoteManager->searchQuote();
}

if (empty($quote)){
  echo '<img src="image/error.png">No quote found, try again !';
}
else {
?>
<table>
  <tr><th>Staff member name</th><th>Quote</th><th>Date</th><th>Mark average</th><th>Mark</th></tr>
  <?php //$produits est un tableau d'objet produit
    foreach ($quote as $q){?>
      <tr><td><?php echo $q->getStaffFirstName()." ".$q->getStaffName();?>
      </td><td><?php echo $q->getQuoteText();?>
      </td><td><?php echo $q->getQuoteDate();?>
      </td><td><?php echo $q->getQuoteAverageMark();
      if ($quoteManager->hasMarkedQuote($q->getQuoteNum())==0){?>
      </td><td><a href="index.php?page=12&quo_num=<?php echo $q->getQuoteNum(); ?>"><img src="image/update.png"/>
          <?php
      }
      else {?>
      </td><td><img src="image/error.png"/>
        <?php
      }
      ?>
      </td></tr>
      <?php
    }
  ?>
  </table>
  <br>
  <?php
}

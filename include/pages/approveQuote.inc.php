	<?php
	$pdo=new Mypdo();
	$quoteManager =new QuoteManager($pdo);
	$quote=$quoteManager->getAllQuotesAwaiting();
	if (!empty($quote)){
		if (empty($_GET['quoNum']) && empty($_GET['delQuoNum'])){
		?>
			<h1>Quote list awaiting approval</h1>
			<table>
				<th>Staff member name</th><th>Quote</th><th>Date</th><th>Approve</th><th>Delete</th></tr>
				<?php //$produits est un tableau d'objet produit
					foreach ($quote as $q){?>
						<tr><td><?php echo $q->getStaffFirstName()." ".$q->getStaffName();?>
						</td><td><?php echo $q->getQuoteText();?>
						</td><td><?php echo $q->getQuoteDate();?>
						</td><td><a href="index.php?page=14&quoNum=<?php echo $q->getQuoteNum();?>"><img src="image/quote.gif"></a>
						</td><td><a href="index.php?page=14&delQuoNum=<?php echo $q->getQuoteNum();?>"><img src="image/error.png"></a>
						</td></tr>
						<?php
					}
				?>
			</table>
			<br />
		<?php
		}
		else if (!(empty($_GET['quoNum']))){
			$quoteManager->approveQuote($_GET['quoNum']);
			?>
			<br>
			<img src="image/valid.png"><p> Quote successfully approved !</p>
			<p>Automatic redirection in 2 seconds.</p>
			<meta http-equiv="refresh" content="2; URL=index.php?page=14"><?php
		}
		else {
			$quoteManager->deleteQuote($_GET['delQuoNum']);
			?>
			<br>
			<img src="image/valid.png"><p> Quote successfully deleted !</p>
			<p>Automatic redirection in 2 seconds.</p>
			<meta http-equiv="refresh" content="2; URL=index.php?page=14"><?php
		}
	}
	else {
		?>
		<br>
		<p><strong>No quote awaiting approval</strong></p>
		<?php
	}?>

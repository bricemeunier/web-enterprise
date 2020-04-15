	<?php
	$pdo=new Mypdo();
	$quoteManager =new QuoteManager($pdo);
	$quote=$quoteManager->getAllQuotes();
	if (empty($_GET['quoNum'])){
	?>
		<h1>Delete a quote</h1>
		<table id="bigTable" class="highlight centered">
			<thead>
				<tr>
					<th>Staff member name</th>
					<th>Quote</th>
					<th>Date</th>
					<th>Mark average</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php //$produits est un tableau d'objet produit
					foreach ($quote as $q){?>
						<tr><td><?php echo $q->getStaffFirstName()." ".$q->getStaffName();?>
						</td><td><?php echo $q->getQuoteText();?>
						</td><td><?php echo $q->getQuoteDate();?>
						</td><td><?php echo $q->getQuoteAverageMark();?>
						</td><td><a href="index.php?page=15&quoNum=<?php echo $q->getQuoteNum();?>"><i class="material-icons prefix">delete</i></a>
						</td></tr>
						<?php
					}
				?>
			</tbody>
		</table>
		<br />
	<?php
	}
	else {
		$quoteManager->deleteQuote($_GET['quoNum']);
		?>
		<br>
		<img src="image/valid.png"><p> Quote successfully deleted !</p>
		<p>Automatic redirection in 2 seconds.</p>
		<meta http-equiv="refresh" content="2; URL=index.php?page=15"><?php
	} ?>

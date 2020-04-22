	<?php
	$pdo=new Mypdo();
	$persManager=new PeopleManager($pdo);
	$quoteManager =new QuoteManager($pdo);
	$quote=$quoteManager->getAllQuotes();
	$nbCitation=$quoteManager->getQuotesNumber();
	?>
		<h1>Quotes list</h1>
		<h3>Currently <?php echo $nbCitation->total; ?> quotes registered</h3>
	<table id="bigTable" class="highlight centered">
		<thead>
			<tr>
				<th>Staff member name</th>
				<th>Quote</th>
				<th>Date</th>
				<th>Average mark</th>
			<?php
			if (isset($_SESSION['user_num'])) {
				if ($persManager->isStudent($_SESSION['user_num'])){
					echo "<th>Mark</th>";
				}
			}?></tr>
		</thead>
		<tbody>
		<?php
			foreach ($quote as $q){?>
				<tr><td><?php echo $q->getStaffFirstName()." ".$q->getStaffName();?>
				</td><td><?php echo $q->getQuoteText();?>
				</td><td><?php echo $q->getQuoteDate();?>
				</td><td><?php //if (intVal($q->getQuoteAverageMark())>0) echo intVal($q->getQuoteAverageMark())."/20"; else echo "N/A";?>
				</td></tr>
				<?php
			}
		?>
		</tbody>
	</table>
<br/>

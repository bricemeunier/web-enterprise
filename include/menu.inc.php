<div id="menu">
	<div id="menuInt">
		<?php
		$pdo=new Mypdo();
		$persManager=new PeopleManager($pdo);
		$bool=false;
		if (isset($_SESSION['user_num'])){
			if ($persManager->isStudent($_SESSION['user_num'])) $bool=true;
		}

		if (isset($_SESSION['admin'])){
			if ($_SESSION['admin']==1){?>
				<p><a href="index.php?page=0"><img class = "icone" src="image/home.gif"  alt="home"/>Home</a></p>
				<p><img class = "icone" src="image/people.png" alt="people"/>People</p>
				<ul>
					<li><a href="index.php?page=2">List</a></li>
					<li><a href="index.php?page=1">Add</a></li>
					<li><a href="index.php?page=3">Update</a></li>
					<li><a href="index.php?page=4">Delete</a></li>
				</ul>
				<p><img class="icone" src="image/quote.gif"  alt="quote"/>Quote</p>
				<ul>
					<?php
					if ($bool) echo '<li><a href="index.php?page=5">Add</a></li>';
					?>
					<li><a href="index.php?page=6">List</a></li>
					<li><a href="index.php?page=13">Search</a></li>
					<li><a href="index.php?page=14">Validate</a></li>
					<li><a href="index.php?page=15">Delete</a></li>
				</ul>
				<p><img class = "icone" src="image/city.png" alt="city"/>City</p>
				<ul>
					<li><a href="index.php?page=8">List</a></li>
					<li><a href="index.php?page=7">Add</a></li>
					<li><a href="index.php?page=16">Delete</a></li>
				</ul>
				<?php
			}
			else {?>
				<p><a href="index.php?page=0"><img class = "icone" src="image/home.gif"  alt="home"/>Home</a></p>
				<p><img class = "icone" src="image/people.png" alt="people"/>People</p>
				<ul>
					<li><a href="index.php?page=2">List</a></li>
					<li><a href="index.php?page=1">Add</a></li>
				</ul>
				<p><img class="icone" src="image/quote.gif"  alt="quote"/>Quote</p>
				<ul>
					<?php
					if ($bool) echo '<li><a href="index.php?page=5">Add</a></li>';
					?>
					<li><a href="index.php?page=6">List</a></li>
					<li><a href="index.php?page=13">Search</a></li>
				</ul>
				<p><img class = "icone" src="image/city.png" alt="city"/>City</p>
				<ul>
					<li><a href="index.php?page=8">List</a></li>
					<li><a href="index.php?page=7">Add</a></li>
				</ul>
				<?php
			}
		}
		else {?>
			<p><a href="index.php?page=0"><img class = "icone" src="image/home.gif"  alt="home"/>Home</a></p>
			<p><img class = "icone" src="image/people.png" alt="people"/>People</p>
			<ul>
				<li><a href="index.php?page=2">List</a></li>
			</ul>
			<p><img class="icone" src="image/quote.gif"  alt="quote"/>Quote</p>
			<ul>
				<li><a href="index.php?page=6">List</a></li>
			</ul>
			<p><img class = "icone" src="image/city.png" alt="city"/>City</p>
			<ul>
				<li><a href="index.php?page=8">List</a></li>
			</ul>
			<?php
		}?>



	</div>
</div>

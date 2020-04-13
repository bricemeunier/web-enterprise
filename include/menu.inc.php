<div id="menu">
	<div id="menuInt">
		<?php
		if (isset($_SESSION['admin'])){
			if ($_SESSION['admin']==1){?>
				<p><a href="index.php?page=0"><img class = "icone" src="image/accueil.gif"  alt="Accueil"/>Home</a></p>
				<p><img class = "icone" src="image/personne.png" alt="Personne"/>People</p>
				<ul>
					<li><a href="index.php?page=2">List</a></li>
					<li><a href="index.php?page=1">Add</a></li>
					<li><a href="index.php?page=3">Update</a></li>
					<li><a href="index.php?page=4">Delete</a></li>
				</ul>
				<p><img class="icone" src="image/citation.gif"  alt="Citation"/>Quote</p>
				<ul>
					<li><a href="index.php?page=5">Add</a></li>
					<li><a href="index.php?page=6">List</a></li>
					<li><a href="index.php?page=13">Search</a></li>
					<li><a href="index.php?page=14">Validate</a></li>
					<li><a href="index.php?page=15">Delete</a></li>
				</ul>
				<p><img class = "icone" src="image/ville.png" alt="Ville"/>City</p>
				<ul>
					<li><a href="index.php?page=8">List</a></li>
					<li><a href="index.php?page=7">Add</a></li>
					<li><a href="index.php?page=16">Delete</a></li>
				</ul>
				<?php
			}
			else {?>
				<p><a href="index.php?page=0"><img class = "icone" src="image/accueil.gif"  alt="Accueil"/>Home</a></p>
				<p><img class = "icone" src="image/personne.png" alt="Personne"/>People</p>
				<ul>
					<li><a href="index.php?page=2">List</a></li>
					<li><a href="index.php?page=1">Add</a></li>
				</ul>
				<p><img class="icone" src="image/citation.gif"  alt="Citation"/>Quote</p>
				<ul>
					<li><a href="index.php?page=5">Add</a></li>
					<li><a href="index.php?page=6">List</a></li>
					<li><a href="index.php?page=13">Search</a></li>
				</ul>
				<p><img class = "icone" src="image/ville.png" alt="Ville"/>City</p>
				<ul>
					<li><a href="index.php?page=8">List</a></li>
					<li><a href="index.php?page=7">Add</a></li>
				</ul>
				<?php
			}
		}
		else {?>
			<p><a href="index.php?page=0"><img class = "icone" src="image/accueil.gif"  alt="Accueil"/>Home</a></p>
			<p><img class = "icone" src="image/personne.png" alt="Personne"/>People</p>
			<ul>
				<li><a href="index.php?page=2">List</a></li>
			</ul>
			<p><img class="icone" src="image/citation.gif"  alt="Citation"/>Quote</p>
			<ul>
				<li><a href="index.php?page=6">List</a></li>
			</ul>
			<p><img class = "icone" src="image/ville.png" alt="Ville"/>City</p>
			<ul>
				<li><a href="index.php?page=8">List</a></li>
			</ul>
			<?php
		}?>



	</div>
</div>

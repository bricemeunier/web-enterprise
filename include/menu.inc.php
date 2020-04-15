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

				<ul class="collapsible">
					<li>
						<a href="index.php?page=0"><div class="collapsible-header"><i class="material-icons">home</i>Home</div></a>
					</li>
					<li>
						<div class="collapsible-header"><i class="material-icons">people</i>People</div>
						<div class="collapsible-body">
							<ul>
								<li><a href="index.php?page=2">List</a></li>
								<li><a href="index.php?page=1">Add</a></li>
								<li><a href="index.php?page=3">Update</a></li>
								<li><a href="index.php?page=4">Delete</a></li>
							</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header"><i class="material-icons">format_quote</i>Quote</div>
						<div class="collapsible-body">
							<ul>
								<?php
								if ($bool) echo '<li><a href="index.php?page=5">Add</a></li>';
								?>
								<li><a href="index.php?page=6">List</a></li>
								<li><a href="index.php?page=13">Search</a></li>
								<li><a href="index.php?page=14">Validate</a></li>
								<li><a href="index.php?page=15">Delete</a></li>
							</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header"><i class="material-icons">location_city</i>City</div>
						<div class="collapsible-body">
							<ul>
								<li><a href="index.php?page=8">List</a></li>
								<li><a href="index.php?page=7">Add</a></li>
								<li><a href="index.php?page=16">Delete</a></li>
							</ul>
						</div>
					</li>
				</ul>
				<?php
			}
			else {?>
				<ul class="collapsible">
					<li>
						<a href="index.php?page=0"><div class="collapsible-header"><i class="material-icons">home</i>Home</div></a>
					</li>
					<li>
						<div class="collapsible-header"><i class="material-icons">people</i>People</div>
						<div class="collapsible-body">
							<ul>
								<li><a href="index.php?page=2">List</a></li>
								<li><a href="index.php?page=1">Add</a></li>
							</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header"><i class="material-icons">format_quote</i>Quote</div>
						<div class="collapsible-body">
							<ul>
								<?php
								if ($bool) echo '<li><a href="index.php?page=5">Add</a></li>';
								?>
								<li><a href="index.php?page=6">List</a></li>
								<li><a href="index.php?page=13">Search</a></li>
							</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header"><i class="material-icons">location_city</i>City</div>
						<div class="collapsible-body">
							<ul>
								<li><a href="index.php?page=8">List</a></li>
								<li><a href="index.php?page=7">Add</a></li>
							</ul>
						</div>
					</li>
				</ul>
				<?php
			}
		}
		else {?>
			<ul class="collapsible">
				<li>
					<a href="index.php?page=0"><div class="collapsible-header"><i class="material-icons">home</i>Home</div></a>
				</li>
				<li>
					<a href="index.php?page=2"><div class="collapsible-header"><i class="material-icons">people</i>People</div></a>
				</li>
				<li>
					<a href="index.php?page=6"><div class="collapsible-header"><i class="material-icons">format_quote</i>Quote</div></a>
				</li>
				<li>
					<a href="index.php?page=8"><div class="collapsible-header"><i class="material-icons">location_city</i>City</div></a>
				</li>
			</ul>
			<?php
		}?>



	</div>
</div>

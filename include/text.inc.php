<div id="texte">
<?php

$pdo=new Mypdo();
$persManager=new PeopleManager($pdo);
$bool=false;
if (isset($_SESSION['user_num'])){
	if ($persManager->isStudent($_SESSION['user_num'])) $bool=true;
}
if (!empty($_GET["page"])){
	$page=$_GET["page"];
}
else {
	$page=0;
}

if (isset($_SESSION['admin'])){
	if ($_SESSION['admin']==1){
		switch ($page) {
			case 0:

				include_once('pages/Home.inc.php');
				break;
			case 1:

				include("pages/addPerson.inc.php");
			    break;

			case 2:

				include_once('pages/listPeople.inc.php');
			    break;
			case 3:

				include("pages/updatePerson.inc.php");
			    break;
			case 4:

				include_once('pages/deletePerson.inc.php');
			    break;
			case 5:
					if ($bool) {
				    include("pages/addQuote.inc.php");
				    break;
					}
					else {
						include("pages/Home.inc.php");
				    break;
					}

			case 6:

				include("pages/listQuote.inc.php");
			    break;


			case 7:

				include("pages/addCity.inc.php");
			    break;

			case 8:

				include("pages/listCity.inc.php");
			    break;

			case 9:

				include("pages/detailPers.inc.php");
			    break;
			case 10:

				include("pages/login.inc.php");
			    break;

			case 11:

				include_once('pages/logout.inc.php');
			    break;

			case 12:
				include_once('pages/markQuote.inc.php');
			    break;

			case 13:

				include_once('pages/searchQuote.inc.php');
				break;

			case 14:

					include_once('pages/approveQuote.inc.php');
					break;


			case 15:

					include_once('pages/deleteQuote.inc.php');
					break;

			case 16:

					include_once('pages/deleteCity.inc.php');
					break;

			default : 	include_once('pages/home.inc.php');
		}
	}
	else {
		switch ($page) {
			case 0:

				include_once('pages/Home.inc.php');
				break;
			case 1:

				include("pages/addPerson.inc.php");
			    break;

			case 2:

				include_once('pages/listPeople.inc.php');
			    break;
			case 5:

				if ($bool) {
					include("pages/addQuote.inc.php");
					break;
				}
				else {
					include("pages/Home.inc.php");
					break;
				}

			case 6:

				include("pages/listQuote.inc.php");
			    break;


			case 7:

				include("pages/addCity.inc.php");
			    break;

			case 8:

				include("pages/listCity.inc.php");
			    break;

			case 9:

				include("pages/detailPers.inc.php");
			    break;
			case 10:

				include("pages/login.inc.php");
			    break;

			case 11:

				include_once('pages/logout.inc.php');
			    break;

			case 12:
				include_once('pages/markQuote.inc.php');
			    break;

			case 13:

				include_once('pages/searchQuote.inc.php');
				break;

			default : 	include_once('pages/home.inc.php');
		}
	}
}
else {
	switch ($page) {
		case 0:

			include_once('pages/Home.inc.php');
			break;
		case 2:

			include_once('pages/listPeople.inc.php');
				break;

		case 6:

			include("pages/listQuote.inc.php");
				break;

		case 8:

			include("pages/listCity.inc.php");
				break;

		case 9:

			include("pages/detailPers.inc.php");
				break;
		case 10:

			include("pages/login.inc.php");
				break;

		default : 	include_once('pages/home.inc.php');
	}
}

?>
</div>

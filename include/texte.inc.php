<div id="texte">
<?php
if (!empty($_GET["page"])){
	$page=$_GET["page"];
}
else {
	$page=0;
}
switch ($page) {
//
// Personnes
//

case 0:
	// inclure ici la page accueil photo
	include_once('pages/accueil.inc.php');
	break;
case 1:
	// inclure ici la page insertion nouvelle personne
	include("pages/ajouterPersonne.inc.php");
    break;

case 2:
	// inclure ici la page liste des personnes
	include_once('pages/listerPersonnes.inc.php');
    break;
case 3:
	// inclure ici la page modification des personnes
	include("pages/ModifierPersonne.inc.php");
    break;
case 4:
	// inclure ici la page suppression personnes
	include_once('pages/supprimerPersonne.inc.php');
    break;
//
// Citations
//
case 5:
	// inclure ici la page ajouter citations
    include("pages/ajouterCitation.inc.php");
    break;

case 6:
	// inclure ici la page liste des citations
	include("pages/listerCitation.inc.php");
    break;
//
// Villes
//

case 7:
	// inclure ici la page ajouter ville
	include("pages/ajouterVille.inc.php");
    break;

case 8:
// inclure ici la page lister  ville
	include("pages/listerVilles.inc.php");
    break;

//

//
case 9:
	// inclure ici la page ....
	include("pages/detailPers.inc.php");
    break;
case 10:
	// inclure ici la page....
	include("pages/connexion.inc.php");
    break;

case 11:
	// inclure ici la page...
	include_once('pages/Deconnexion.inc.php');
    break;

case 12:
	include_once('pages/NoterCitation.inc.php');
    break;

case 13:
	// inclure ici la page...
	include_once('pages/RechercherCitation.inc.php');
	break;

case 14:
		// inclure ici la page...
		include_once('pages/ValiderCitation.inc.php');
		break;


case 15:
		// inclure ici la page...
		include_once('pages/SupprimerCitation.inc.php');
		break;

case 16:
		// inclure ici la page...
		include_once('pages/SupprimerVille.inc.php');
		break;

default : 	include_once('pages/accueil.inc.php');
}

?>
</div>

<?php
class EtudiantManager{
	private $db;
		public function __construct($db){
			$this->db=$db;

		}

	public function add($etudiant){

		$requete = $this->db->prepare("
		INSERT INTO etudiant VALUES(:per_num,:dep_num,:div_num)");

		$requete->bindValue(':per_num',$etudiant->getEtuNum(), PDO::PARAM_STR);
		$requete->bindValue(':dep_num',$etudiant->getEtuDepNum(), PDO::PARAM_STR);
		$requete->bindValue(':div_num',$etudiant->getEtuDivNum(), PDO::PARAM_STR);

		$requete->execute();
	}


	public function modifierEtu($etuNum){

		$liste=array();
		foreach ($_SESSION['pers'] as $temp){
			$liste[]=$temp;
		}
		

		$requete = $this->db->prepare('UPDATE etudiant SET dep_num='.$_POST['departement'].', div_num='.$_POST['annee'].' WHERE per_num='.$etuNum);
		$requete->execute();
		if ($liste[5]==''){
			$requete = 'UPDATE personne SET per_nom="'.$liste[0].'", per_prenom="'.$liste[1].'",per_tel='.$liste[2].',
			per_mail="'.$liste[3].'",per_login="'.$liste[4].'" WHERE per_num='.$etuNum;
		}
		else {
			$requete = 'UPDATE personne SET per_nom="'.$liste[0].'", per_prenom="'.$liste[1].'",per_tel='.$liste[2].',
			per_mail="'.$liste[3].'",per_login="'.$liste[4].'", per_pwd="'.$liste[5].'" WHERE per_num='.$etuNum;
		}

		$requete=$this->db->prepare($requete);

		$requete->execute();
	}

}
?>

<?php
class PersonneManager{
	private $db;
		public function __construct($db){
			$this->db=$db;

		}

    public function add($pers){
      $requete = $this->db->prepare("
			INSERT INTO personne (per_nom,per_prenom,per_tel,per_mail,per_login,per_pwd) VALUES (:nom,:prenom,:tel,:mail,:login,:mdp)");

			$requete->bindValue(':nom',$pers->getPersNom(), PDO::PARAM_STR);
			$requete->bindValue(':prenom',$pers->getPersPrenom(), PDO::PARAM_STR);
			$requete->bindValue(':tel',$pers->getPersTel(), PDO::PARAM_STR);
			$requete->bindValue(':mail',$pers->getPersMail(), PDO::PARAM_STR);
			$requete->bindValue(':login',$pers->getPersLogin(), PDO::PARAM_STR);
			$requete->bindValue(':mdp',$pers->getPersMDP(), PDO::PARAM_STR);

			$requete->execute();
    }


		public function getPers($perNum){

      $requete = $this->db->prepare('
			SELECT * FROM personne WHERE per_num='.$perNum);

			$requete->execute();

			while ($pers=$requete->fetch(PDO::FETCH_OBJ)){
					$personne=new Personne($pers);
			}
			return $personne;
    }


		public function supprimerPersonne($perNum){

			$listeNum=array();

			$requete='SELECT cit_num FROM citation WHERE per_num='.$perNum.' OR per_num_etu='.$perNum;
			$sql=$this->db->prepare($requete);
			$sql->execute();
			while ($num=$sql->fetch(PDO::FETCH_OBJ)){
					$listeNum[]=$num->cit_num;
			}

			if (!empty($listeNum)){
				foreach($listeNum as $num){
      		$requete = $this->db->prepare(
					'DELETE FROM vote WHERE cit_num='.$num);
					$requete->execute();

					$requete = $this->db->prepare(
					'DELETE FROM citation WHERE cit_num='.$num);
					$requete->execute();
				}
			}

			$requete = $this->db->prepare(
			'DELETE FROM vote WHERE per_num='.$perNum);
			$requete->execute();

			if ($this->estEtudiant($perNum)){
				$requete = $this->db->prepare(
				'DELETE FROM etudiant WHERE per_num='.$perNum);
				$requete->execute();
			}
			else {
				$requete = $this->db->prepare(
				'DELETE FROM salarie WHERE per_num='.$perNum);
				$requete->execute();
			}

			$requete = $this->db->prepare(
			'DELETE FROM personne WHERE per_num='.$perNum);
			$requete->execute();

    }

		/*public function modif($citynum,$array){
			$requete = $this->db->prepare(
			"UPDATE ville SET vil_nom =:nom WHERE vil_num=$citynum");
			$requete->bindValue(':nom',$array["cityNom"]);
			$retour=$requete->execute();
		}*/

    public function getNbPersonne(){
      $requete='SELECT COUNT(*) as total FROM personne';
      $sql=$this->db->prepare($requete);
      $sql->execute();
      return $sql->fetch(PDO::FETCH_OBJ);
    }

	public function getAllPersonne(){
		$listePers=array();

		$sql='SELECT per_num,per_nom,per_prenom FROM personne';

		$requete=$this->db->prepare($sql);
		$requete->execute();

		while ($pers=$requete->fetch(PDO::FETCH_OBJ)){
			$listePers[]=new Personne($pers);
		}

		$requete->closeCursor();

		return $listePers;
	}

	public function getEtu($num){
		$sql='SELECT per_prenom,per_mail,per_tel,dep_nom,e.dep_num,div_num,vil_nom FROM personne p
    JOIN etudiant e ON e.per_num=p.per_num
    JOIN departement d ON d.dep_num=e.dep_num
    JOIN ville v ON v.vil_num=d.vil_num
    WHERE p.per_num='.$num;
		$requete=$this->db->prepare($sql);
		$requete->execute();

		return $requete->fetch(PDO::FETCH_OBJ);
	}


	public function getEtudiant($num){
		$sql='SELECT per_prenom,per_mail,per_tel,dep_nom,vil_nom FROM personne p
    JOIN etudiant e ON e.per_num=p.per_num
    JOIN departement d ON d.dep_num=e.dep_num
    LEFT JOIN ville v ON v.vil_num=d.vil_num
    WHERE p.per_num='.$num;
		$requete=$this->db->prepare($sql);
		$requete->execute();

		return $requete->fetch(PDO::FETCH_OBJ);
	}

	public function getIdPers($login){
		$sql='SELECT per_num FROM personne WHERE per_login="'.$login.'"';
		$requete=$this->db->prepare($sql);
		$requete->execute();

		return $requete->fetch(PDO::FETCH_OBJ);
	}


	public function modifierLoginAutorise($login,$num){

		$sql='SELECT count(*) as result FROM personne WHERE per_login="'.$login.'" AND per_num='.$num;
		$requete=$this->db->prepare($sql);
		$requete->execute();
		$requete= $requete->fetch(PDO::FETCH_OBJ);
		if ($requete->result==1){ return true;}

		$sql='SELECT count(*) as result FROM (SELECT per_login FROM personne
		WHERE per_login NOT IN (
		SELECT per_login FROM personne where per_login!="'.$login.'"'.')) a';
		$requete=$this->db->prepare($sql);
		$requete->execute();

		$requete= $requete->fetch(PDO::FETCH_OBJ);
		return $requete->result==0;
	}


	public function rechercheParLogin($login){
		$sql='SELECT count(*) as result from personne WHERE per_login="'.$login.'"';
		$requete=$this->db->prepare($sql);
		$requete->execute();

		return $requete->fetch(PDO::FETCH_OBJ);

	}

	public function getSal($num){
		$sql='SELECT per_prenom,per_mail,per_tel,sal_telprof,s.fon_num,fon_libelle FROM personne p
    JOIN salarie s ON s.per_num=p.per_num
    JOIN fonction f ON f.fon_num=s.fon_num
    WHERE p.per_num='.$num;
		echo $sql;
		$requete=$this->db->prepare($sql);
		$requete->execute();

		$personne=$requete->fetch(PDO::FETCH_OBJ);

		$requete->closeCursor();
		return $personne;
	}


	public function getSalarie($num){
		$sql='SELECT per_prenom,per_mail,per_tel,sal_telprof,fon_libelle FROM personne p
    JOIN salarie s ON s.per_num=p.per_num
    JOIN fonction f ON f.fon_num=s.fon_num
    WHERE p.per_num='.$num;
		$requete=$this->db->prepare($sql);
		$requete->execute();

		$personne=$requete->fetch(PDO::FETCH_OBJ);

		$requete->closeCursor();
		return $personne;
	}


	public function estEtudiant($num){
		$sql='SELECT count(*) FROM personne p
		JOIN etudiant e ON e.per_num=p.per_num
		WHERE p.per_num='.$num;
		$requete=$this->db->prepare($sql);
		$requete->execute();

		$reponse=$requete->fetch(PDO::FETCH_OBJ);
		foreach($reponse as $pers=>$valeur){
			$rep=$valeur;
		}
		$requete->closeCursor();
		return $rep==1;
	}

}
?>

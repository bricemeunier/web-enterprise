<?php
class CitationManager{
	private $db;
		public function __construct($db){
			$this->db=$db;

		}

		public function add($cit){
			$datetime = date("Y-m-d H:i:s");
      $requete = $this->db->prepare(
			'INSERT INTO citation (per_num,per_num_etu,	cit_libelle,cit_date,cit_date_depo) VALUES (:per_num,:per_num_etu,:cit_libelle,:cit_date,:cit_date_depo)');

			$requete->bindValue(':per_num',$cit->getPersNum());
			$requete->bindValue(':per_num_etu',$_SESSION['user_num']);
			$requete->bindValue(':cit_libelle',$cit->getCitationLibelle());
			$requete->bindValue(':cit_date',$cit->getCitationDate());
			$requete->bindValue(':cit_date_depo',$datetime);

			$retour=$requete->execute();
			return $retour;
  	}

		public function ajouterNote($note,$cit_num){
      $requete = $this->db->prepare(
			'INSERT INTO vote VALUES (:cit_num,:per_num,:note)');

			$requete->bindValue(':cit_num',$cit_num);
			$requete->bindValue(':per_num',$_SESSION['user_num']);
			$requete->bindValue(':note',$note);

			$requete->execute();
  	}

		public function aNoteLaCitation($num){
      $requete='SELECT COUNT(*) as result FROM vote where cit_num='.$num.' and per_num='.$_SESSION['user_num'];
      $sql=$this->db->prepare($requete);
      $sql->execute();
      $sql= $sql->fetch(PDO::FETCH_OBJ);
			return $sql->result;
    }


		public function supprimerCitation($citnum){
    	$requete = $this->db->prepare(
			'DELETE FROM vote WHERE cit_num='.$citnum);

			$retour=$requete->execute();

			$requete = $this->db->prepare(
			'DELETE FROM citation WHERE cit_num='.$citnum);

			$retour=$requete->execute();
    }


    public function getNbCitation(){
      $requete='SELECT count(*) as total FROM (SELECT c.cit_num,per_prenom,per_nom,cit_libelle,cit_date,cit_moy
				 FROM citation c JOIN personne p ON (c.per_num=p.per_num) LEFT JOIN
				 (SELECT cit_num,AVG(vot_valeur) as cit_moy FROM vote GROUP BY cit_num) a
				  ON c.cit_num=a.cit_num WHERE cit_valide=1 AND cit_date_valide is not null) nb';
      $sql=$this->db->prepare($requete);
      $sql->execute();
      return $sql->fetch(PDO::FETCH_OBJ);

    }



	public function getAllCitation(){
		$listeCitation=array();

		$sql='SELECT c.cit_num,per_prenom,per_nom,cit_libelle,cit_date,COALESCE(cit_moy,"N/A") as cit_moy
			 FROM citation c JOIN personne p ON (c.per_num=p.per_num) LEFT JOIN
			 (SELECT cit_num,AVG(vot_valeur) as cit_moy FROM vote GROUP BY cit_num) a
			  ON c.cit_num=a.cit_num WHERE cit_valide=1 AND cit_date_valide is not null';

		$requete=$this->db->prepare($sql);
		$requete->execute();

		while ($citation=$requete->fetch(PDO::FETCH_OBJ)){
			$listeCitation[]=new Citation($citation);
		}

		$requete->closeCursor();

		return $listeCitation;
	}


	public function getAllCitationNonValide(){
		$listeCitation=array();

		$sql='SELECT c.cit_num,per_prenom,per_nom,cit_libelle,cit_date
		FROM citation c,personne p
		WHERE c.per_num=p.per_num AND cit_valide=0 ';

		$requete=$this->db->prepare($sql);
		$requete->execute();

		while ($citation=$requete->fetch(PDO::FETCH_OBJ)){
			$listeCitation[]=new Citation($citation);
		}

		$requete->closeCursor();

		return $listeCitation;
	}


	public function validerCitation($citNum){

		$datetime = date("Y-m-d");
		$requete = $this->db->prepare(
		'UPDATE citation SET cit_valide=1,per_num_valide='.$_SESSION['user_num'].', cit_date_valide="'.$datetime.'"
		 WHERE cit_num='.$citNum);

		$requete->execute();
	}


	public function rechercheCitation(){
		$compteurCritere=0;
		$listeCitation=array();

		$sql='SELECT c.cit_num,per_prenom,per_nom,cit_libelle,cit_date,COALESCE(cit_moy,"N/A") as cit_moy
			 FROM citation c JOIN personne p ON (c.per_num=p.per_num) LEFT JOIN
			 (SELECT cit_num,AVG(vot_valeur) as cit_moy FROM vote GROUP BY cit_num) a
			  ON c.cit_num=a.cit_num WHERE cit_valide=1 AND cit_date_valide is not null';
		 	if (!(empty($_POST['per_num'])) && ($_POST['per_num']!="0")){
				$sql=$sql." AND ";
				$sql=$sql."c.per_num=".$_POST['per_num']." ";
				$compteurCritere++;
			}
			if (!(empty($_POST['cit_date']))){
				if ($compteurCritere!=0){
					$sql=$sql."AND cit_date='".$_POST['cit_date']."' ";
				}
				else {
					$sql=$sql." AND ";
					$sql=$sql."cit_date='".$_POST['cit_date']."' ";
				}
				$compteurCritere++;
			}
			if (!(empty($_POST['cit_moy']))){
				if ($compteurCritere!=0){
					$sql=$sql."AND cit_moy='".$_POST['cit_moy']."' ";
				}
				else {
					$sql=$sql." AND ";
					$sql=$sql."cit_moy='".$_POST['cit_moy']."' ";
				}
			}
			$requete=$this->db->prepare($sql);
			$requete->execute();

		while ($citation=$requete->fetch(PDO::FETCH_OBJ)){
			$listeCitation[]=new Citation($citation);
		}

		$requete->closeCursor();
		return $listeCitation;
	}

}
?>

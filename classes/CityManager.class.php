<?php
class CityManager{
		private $db;
		public function __construct($db){
			$this->db=$db;

		}
    public function add($city){
            $requete = $this->db->prepare(
			'INSERT INTO ville (vil_nom) VALUES (:nom);');

			$requete->bindValue(':nom',$city->getCityNom());

			$requete->execute();
    }

		public function supCity($citynum){

			$requete = $this->db->prepare(
			'UPDATE departement SET vil_num=NULL WHERE vil_num=:num');

			$requete->bindValue(':num',$citynum);
			$retour=$requete->execute();

      $requete = $this->db->prepare(
			'DELETE FROM ville WHERE vil_num=:num');

			$requete->bindValue(':num',$citynum);
			$retour=$requete->execute();
    }

		public function modif($citynum,$array){
			$requete = $this->db->prepare(
			"UPDATE ville SET vil_nom =:nom WHERE vil_num=$citynum");
			$requete->bindValue(':nom',$array["cityNom"]);
			$retour=$requete->execute();
		}

    public function getNbCity(){
      $requete='SELECT COUNT(*) as total FROM ville';
      $sql=$this->db->prepare($requete);
      $sql->execute();
      return $sql->fetch(PDO::FETCH_OBJ);
    }



		public function getAllCity(){
			$listeCity=array();

			$sql='SELECT vil_num,vil_nom FROM ville ORDER BY vil_num';

			$requete=$this->db->prepare($sql);
			$requete->execute();

			while ($city=$requete->fetch(PDO::FETCH_OBJ)){
				$listeCity[]=new City($city);
			}

			$requete->closeCursor();

			return $listeCity;
		}

		public function recherche($nomCity){
			$sql="SELECT count(*) as verif FROM ville WHERE vil_nom='".$nomCity."'";
			$requete=$this->db->prepare($sql);
			$requete->execute();

			$city=$requete->fetch(PDO::FETCH_OBJ);
			$requete->closeCursor();
			return $city->verif==0;

		}

}
?>

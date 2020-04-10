<?php
class SalarieManager{
	private $db;
		public function __construct($db){
			$this->db=$db;

		}

	public function add($salarie){

		$requete = $this->db->prepare("
		INSERT INTO salarie VALUES(:per_num,:tel_prof,:fon_num)");

		$requete->bindValue(':per_num',$salarie->getSalNum(), PDO::PARAM_STR);
		$requete->bindValue(':tel_prof',$salarie->getSalTelProf(), PDO::PARAM_STR);
		$requete->bindValue(':fon_num',$salarie->getSalFonNum(), PDO::PARAM_STR);

		$requete->execute();

	}

	public function getAllSalarie(){
		$listeSal=array();

		$sql='SELECT s.per_num,per_nom,sal_telprof,fon_num FROM salarie s
					JOIN personne p ON (p.per_num=s.per_num)';

		$requete=$this->db->prepare($sql);
		$requete->execute();
		while ($sal=$requete->fetch(PDO::FETCH_OBJ)){
			$listeSal[]=new Salarie($sal,$sal->sal_telprof,$sal->fon_num);
		}

		$requete->closeCursor();

		return $listeSal;

	}
}
?>

<?php
class YearManager{
	private $db;
		public function __construct($db){
			$this->db=$db;

		}

	public function getAllYear(){

		$listYear=array();
		$sql='SELECT year_num,year_name FROM year';
    $sql = $this->db->prepare($sql);
		$sql->execute();

		while ($year=$sql->fetch(PDO::FETCH_OBJ)){
			$listYear[]=new Year($year);
		}

		$sql->closeCursor();

		return $listYear;

	}

}
?>

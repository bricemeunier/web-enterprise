<?php
class DivisionManager{
	private $db;
		public function __construct($db){
			$this->db=$db;

		}

	public function getAllDiv(){

		$listeDiv=array();
		$sql='SELECT div_num,div_nom FROM division';
    $sql = $this->db->prepare($sql);
		$sql->execute();

		while ($div=$sql->fetch(PDO::FETCH_OBJ)){
			$listeDiv[]=new Division($div);
		}

		$sql->closeCursor();

		return $listeDiv;

	}

}
?>

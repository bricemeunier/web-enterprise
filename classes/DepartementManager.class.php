 <?php
class DepartementManager{
	private $db;
		public function __construct($db){
			$this->db=$db;

		}

	public function getAllDep(){

		$listeDep=array();
		$sql='SELECT dep_num,dep_nom FROM departement';
    $sql = $this->db->prepare($sql);
		$sql->execute();

		while ($dep=$sql->fetch(PDO::FETCH_OBJ)){
			$listeDep[]=new Departement($dep);
		}

		$sql->closeCursor();

		return $listeDep;

	}

}
?>

 <?php
class FonctionManager{
	private $db;
		public function __construct($db){
			$this->db=$db;

		}

	public function getAllFon(){

		$listeFon=array();
		$sql='SELECT fon_num,fon_libelle FROM fonction';
    $sql = $this->db->prepare($sql);
		$sql->execute();

		while ($fon=$sql->fetch(PDO::FETCH_OBJ)){
			$listeFon[]=new Fonction($fon);
		}

		$sql->closeCursor();

		return $listeFon;

	}

}
?>

 <?php
class PositionManager{
	private $db;
		public function __construct($db){
			$this->db=$db;

		}

	public function getAllPosition(){

		$listPosition=array();
		$sql='SELECT pos_num,pos_name FROM position';
    $sql = $this->db->prepare($sql);
		$sql->execute();

		while ($pos=$sql->fetch(PDO::FETCH_OBJ)){
			$listPosition[]=new Position($pos);
		}

		$sql->closeCursor();

		return $listPosition;

	}

}
?>

 <?php
class SchoolManager{
	private $db;
		public function __construct($db){
			$this->db=$db;

		}

	public function getAllSchool(){

		$listSchool=array();
		$sql='SELECT sch_num,sch_name FROM school';
    $sql = $this->db->prepare($sql);
		$sql->execute();

		while ($school=$sql->fetch(PDO::FETCH_OBJ)){
			$listSchool[]=new School($school);
		}

		$sql->closeCursor();

		return $listSchool;

	}

}
?>

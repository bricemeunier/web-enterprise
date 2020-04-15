<?php
class StudentManager{
	private $db;
		public function __construct($db){
			$this->db=$db;

		}

	public function add($student){

		$req = $this->db->prepare("
		INSERT INTO student VALUES(:per_num,:sch_num,:year_num)");

		$req->bindValue(':per_num',$student->getStudentNum(), PDO::PARAM_STR);
		$req->bindValue(':sch_num',$student->getStudentSchNum(), PDO::PARAM_STR);
		$req->bindValue(':year_num',$student->getStudentYearNum(), PDO::PARAM_STR);

		$req->execute();
	}


	public function updateStudent($studentNum){

		$list=array();
		foreach ($_SESSION['pers'] as $tmp){
			$list[]=$tmp;
		}


		$req = $this->db->prepare('UPDATE student SET sch_num='.$_POST['school'].', year_num='.$_POST['year'].' WHERE per_num='.$studentNum);
		$req->execute();
		if ($list[5]==''){
			$req = 'UPDATE people SET per_name="'.$list[0].'", per_f_name="'.$list[1].'",per_phone="'.$list[2].'",
			per_email="'.$list[3].'",per_login="'.$list[4].'" WHERE per_num='.$studentNum;
		}
		else {
			$req = 'UPDATE people SET per_name="'.$list[0].'", per_f_name="'.$list[1].'",per_phone="'.$list[2].'",
			per_email="'.$list[3].'",per_login="'.$list[4].'", per_pwd="'.$list[5].'" WHERE per_num='.$studentNum;
		}

		$req=$this->db->prepare($req);

		$req->execute();
	}

}
?>

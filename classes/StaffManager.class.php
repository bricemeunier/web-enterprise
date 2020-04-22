<?php
class StaffManager{
	private $db;
		public function __construct($db){
			$this->db=$db;

		}

	public function add($staff){

		$req = $this->db->prepare("
		INSERT INTO staff VALUES(:per_num,:staff_phone,:pos_num)");

		$req->bindValue(':per_num',$staff->getStaffNum(), PDO::PARAM_STR);
		$req->bindValue(':staff_phone',$staff->getStaffProPhone(), PDO::PARAM_STR);
		$req->bindValue(':pos_num',$staff->getStaffPositionNum(), PDO::PARAM_STR);

		$req->execute();

	}

	public function updateStaff($staffNum){

		$list=array();
		foreach ($_SESSION['pers'] as $tmp){
			$list[]=$tmp;
		}
		$req = $this->db->prepare('UPDATE staff SET staff_pro_phone="'.$_POST['staff_pro_phone'].'", pos_num='.$_POST['position'].' WHERE per_num='.$staffNum);
		$req->execute();
		if ($list[5]==''){
			$req = 'UPDATE people SET per_name="'.$list[0].'", per_f_name="'.$list[1].'",per_phone="'.$list[2].'",
			per_email="'.$list[3].'",per_login="'.$list[4].'" WHERE per_num='.$staffNum;
		}
		else {
			$req = 'UPDATE people SET per_name="'.$list[0].'", per_f_name="'.$list[1].'",per_phone="'.$list[2].'",
			per_email="'.$list[3].'",per_login="'.$list[4].'", per_pwd="'.$list[5].'" WHERE per_num='.$staffNum;
		}

		$req=$this->db->prepare($req);

		$req->execute();
	}

	public function getAllStaff(){
		$listStaff=array();
		return null;
		$sql='SELECT s.per_num,per_name,staff_pro_phone,pos_num FROM staff s
					JOIN people p ON (p.per_num=s.per_num)';

		$req=$this->db->prepare($sql);
		$req->execute();
		while ($staff=$req->fetch(PDO::FETCH_OBJ)){
			$listStaff[]=new staff($staff,$staff->staff_pro_phone,$staff->pos_num);
		}

		$req->closeCursor();

		return $listStaff;

	}
}
?>

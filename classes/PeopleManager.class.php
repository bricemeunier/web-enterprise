<?php
class PeopleManager{
	private $db;
		public function __construct($db){
			$this->db=$db;

		}

    public function add($person){
      $req = $this->db->prepare("
			INSERT INTO people (per_name,per_f_name,per_phone,per_email,per_login,per_pwd) VALUES (:name,:f_name,:phone,:email,:login,:password)");

			$req->bindValue(':name',$person->getPersonName(), PDO::PARAM_STR);
			$req->bindValue(':f_name',$person->getPersonFirstName(), PDO::PARAM_STR);
			$req->bindValue(':phone',$person->getPersonPhone(), PDO::PARAM_STR);
			$req->bindValue(':email',$person->getPersonEmail(), PDO::PARAM_STR);
			$req->bindValue(':login',$person->getPersonLogin(), PDO::PARAM_STR);
			$req->bindValue(':password',$person->getPersonPassword(), PDO::PARAM_STR);

			$req->execute();
    }


		public function getPerson($perNum){

      $req = $this->db->prepare('
			SELECT * from people WHERE per_num='.$perNum);

			$req->execute();

			while ($person=$req->fetch(PDO::FETCH_OBJ)){
					$p=new People($person);
			}
			return $p;
    }


		public function deletePerson($perNum){

			$listNum=array();

			$req='SELECT quo_num from quote WHERE per_num='.$perNum.' OR per_num_stu='.$perNum;
			$sql=$this->db->prepare($req);
			$sql->execute();
			while ($num=$sql->fetch(PDO::FETCH_OBJ)){
					$listNum[]=$num->quo_num;
			}

			if (!empty($listNum)){
				foreach($listNum as $num){
      		$req = $this->db->prepare(
					'DELETE from mark WHERE quo_num='.$num);
					$req->execute();

					$req = $this->db->prepare(
					'DELETE from quote WHERE quo_num='.$num);
					$req->execute();
				}
			}

			$req = $this->db->prepare(
			'DELETE from mark WHERE per_num='.$perNum);
			$req->execute();

			if ($this->isStudent($perNum)){
				$req = $this->db->prepare(
				'DELETE from student WHERE per_num='.$perNum);
				$req->execute();
			}
			else {
				$req = $this->db->prepare(
				'DELETE from staff WHERE per_num='.$perNum);
				$req->execute();
			}

			$req = $this->db->prepare(
			'DELETE from people WHERE per_num='.$perNum);
			$req->execute();

    }


    public function getPeopleNumber(){

      $req='SELECT COUNT(*) as total from people';
      $sql=$this->db->prepare($req);
      $sql->execute();
      return $sql->fetch(PDO::FETCH_OBJ);

    }


		public function getAllPeople(){
			$listPers=array();

			$sql='SELECT per_num,per_name,per_f_name from people';

			$req=$this->db->prepare($sql);
			$req->execute();

			while ($person=$req->fetch(PDO::FETCH_OBJ)){
				$listPers[]=new People($person);
			}

			$req->closeCursor();

			return $listPers;
		}


		public function getStudent($num){

			$sql='SELECT per_f_name,per_email,per_phone,sch_name,s.sch_num,year_num,city_name from people p
	    JOIN student s ON s.per_num=p.per_num
	    JOIN school d ON d.sch_num=s.sch_num
	    JOIN city v ON v.city_num=d.city_num
	    WHERE p.per_num='.$num;
			$req=$this->db->prepare($sql);
			$req->execute();

			return $req->fetch(PDO::FETCH_OBJ);
		}


		public function getDetailsStudent($num){
			$sql='SELECT per_f_name,per_email,per_phone,sch_name,city_name from people p
	    JOIN student s ON s.per_num=p.per_num
	    JOIN school d ON d.sch_num=s.sch_num
	    LEFT JOIN city v ON v.city_num=d.city_num
	    WHERE p.per_num='.$num;
			$req=$this->db->prepare($sql);
			$req->execute();

			return $req->fetch(PDO::FETCH_OBJ);
		}


		public function getIdPerson($login){
			$sql='SELECT per_num from people WHERE per_login="'.$login.'"';
			$req=$this->db->prepare($sql);
			$req->execute();

			return $req->fetch(PDO::FETCH_OBJ);
		}

		//modifierLoginAutorise
		public function checkIfLoginIsAvailable($login,$num){

			$sql='SELECT count(*) as result from people WHERE per_login="'.$login.'" AND per_num='.$num;
			$req=$this->db->prepare($sql);
			$req->execute();
			$req= $req->fetch(PDO::FETCH_OBJ);
			if ($req->result==1){ return true;}

			$sql='SELECT count(*) as result FROM (SELECT per_login from people
			WHERE per_login NOT IN (
			SELECT per_login from people where per_login!="'.$login.'"'.')) a';
			$req=$this->db->prepare($sql);
			$req->execute();

			$req= $req->fetch(PDO::FETCH_OBJ);
			return $req->result==0;
		}

		//rechercheParLogin
		public function researchLogin($login){
			$sql='SELECT count(*) as result from people WHERE per_login="'.$login.'"';
			$req=$this->db->prepare($sql);
			$req->execute();

			return $req->fetch(PDO::FETCH_OBJ);

		}


		public function getStaff($num){
			$sql='SELECT per_f_name,per_email,per_phone,staff_pro_phone,s.pos_num,pos_name from people p
	    JOIN staff s ON s.per_num=p.per_num
	    JOIN position f ON f.pos_num=s.pos_num
	    WHERE p.per_num='.$num;

			$req=$this->db->prepare($sql);
			$req->execute();

			$p=$req->fetch(PDO::FETCH_OBJ);

			$req->closeCursor();
			return $p;
		}


		public function getDetailsStaff($num){
			$sql='SELECT per_f_name,per_email,per_phone,staff_pro_phone,pos_name from people p
	    JOIN staff s ON s.per_num=p.per_num
	    JOIN position f ON f.pos_num=s.pos_num
	    WHERE p.per_num='.$num;
			$req=$this->db->prepare($sql);
			$req->execute();

			$p=$req->fetch(PDO::FETCH_OBJ);

			$req->closeCursor();
			return $p;
		}


		public function isStudent($num){
			$sql='SELECT count(*) from people p
			JOIN student s ON s.per_num=p.per_num
			WHERE p.per_num='.$num;
			$req=$this->db->prepare($sql);
			$req->execute();

			$res=0;

			$response=$req->fetch(PDO::FETCH_OBJ);
			foreach($response as $person=>$val){
				$rep=$val;
			}
			$req->closeCursor();
			return $rep==1;
		}

}
?>

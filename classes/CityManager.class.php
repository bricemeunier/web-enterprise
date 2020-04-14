<?php
class CityManager{
		private $db;
		public function __construct($db){
			$this->db=$db;

		}
    public function add($city){
            $req = $this->db->prepare(
			'INSERT INTO city (city_name) VALUES (:name);');

			$req->bindValue(':name',$city->getCityName());

			$req->execute();
    }

		public function deleteCity($citynum){

			$req = $this->db->prepare(
			'UPDATE school SET city_num=NULL WHERE city_num=:num');

			$req->bindValue(':num',$citynum);
			$req->execute();

      $req = $this->db->prepare(
			'DELETE FROM city WHERE city_num=:num');

			$req->bindValue(':num',$citynum);
			$req->execute();
    }

		public function update($citynum,$array){
			$req = $this->db->prepare(
			"UPDATE city SET city_name =:name WHERE city_num=$citynum");
			$req->bindValue(':name',$array["cityName"]);
			$req->execute();
		}

    public function getCityNumber(){
      $req='SELECT COUNT(*) as total FROM city';
      $sql=$this->db->prepare($req);
      $sql->execute();
      return $sql->fetch(PDO::FETCH_OBJ);
    }



		public function getAllCity(){
			$listCity=array();

			$sql='SELECT city_num,city_name FROM city ORDER BY city_name';

			$req=$this->db->prepare($sql);
			$req->execute();

			while ($city=$req->fetch(PDO::FETCH_OBJ)){
				$listCity[]=new City($city);
			}

			$req->closeCursor();

			return $listCity;
		}

		public function search($cityName){
			$sql="SELECT count(*) as verif FROM city WHERE city_name='".$cityName."'";
			$req=$this->db->prepare($sql);
			$req->execute();

			$city=$req->fetch(PDO::FETCH_OBJ);
			$req->closeCursor();
			return $city->verif==0;

		}

}
?>

<?php
class ConnexionManager{
	private $db;
		public function __construct($db){
			$this->db=$db;

		}

	public function connexionValide($login,$passwd){

    $salt = "48@!alsd";
    $passwordMD5 = md5(md5($passwd).$salt);
		$sql='SELECT per_num,per_login, per_admin FROM personne where per_login="'.$login.'" AND per_pwd="'.$passwordMD5.'"';
    $sql = $this->db->prepare($sql);
		$sql->execute();
		return $sql->fetch(PDO::FETCH_OBJ);
	}

}
?>

<?php
class People {
	private $personNum;
	private $personName;
  private $personFirstName;
	private $personPhone;
	private $personEmail;
	private $personLogin;
	private $personPassword;

		public function __construct($val = array()){
				if (!empty($val)){
					$this->create($val);
				}
			}

		public function create($data){
			foreach($data as $attributes=>$value){
				switch ($attributes){
					case 'per_num':$this->setPersonNum($value);break;
					case 'per_name':$this->setPersonName($value);break;
          case 'per_f_name':$this->setPersonFirstName($value);break;
					case 'per_phone':$this->setPersonPhone($value);break;
					case 'per_email':$this->setPersonEmail($value);break;
					case 'per_login':$this->setPersonLogin($value);break;
					case 'per_password':$this->setPersonPassword($value);break;
				}
			}
		}



		public function getPersonNum() {
			return $this->personNum;
		}
		public function setPersonNum($id){
			$this->personNum=$id;
		}

		public function getPersonName(){
			return $this->personName;
		    }
		public function setPersonName($name){
		    $this->personName=$name;
		    }
		public function getPersonFirstName(){
				return $this->personFirstName;
		}
		public function setPersonFirstName($firstName){
		    $this->personFirstName=$firstName;
		}

		public function getPersonPhone(){
				return $this->personPhone;
		}
		public function setPersonPhone($phone){
		    $this->personPhone=$phone;
		}

		public function getPersonEmail(){
				return $this->personEmail;
		}
		public function setPersonEmail($email){
		    $this->personEmail=$email;
		}

		public function getPersonLogin(){
				return $this->personLogin;
		}
		public function setPersonLogin($login){
		    $this->personLogin=$login;
		}

		public function getPersonPassword(){
				return $this->personPassword;
		}
		public function setPersonPassword($pwd){
				$salt = "48@!alsd";
	    	$pwd = md5(md5($pwd).$salt);
		   	$this->personPassword=$pwd;
		}
}

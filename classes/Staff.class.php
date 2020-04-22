<?php
class Staff extends People{
	private $staffPhone;
	private $posNum;
	private $pernum;
	private $perName;

		public function __construct($val = array(),$staffPhone,$posNum){
				if (!empty($val)){
					parent::__construct($val);
					//$this->staffPhone=$staffPhone;
					//$this->posNum=$posNum;
					foreach ($val as $value=>$attr){
						if ($value=="per_num"){
							$this->pernum=$attr;
						}
						if ($value=="per_name"){
							$this->perName=$attr;
						}
					}
				}
			}



		public function getStaffProPhone() {
			return $this->staffPhone;
		}

		public function getStaffPositionNum() {
			return $this->posNum;
		}

		public function getStaffNum() {
			return $this->pernum;
		}

		public function setStaffNum($num) {
			$this->pernum=$num;
		}

		public function getStaffName(){
			return $this->perName;
		}
		public function getStaffFirstName(){
				$this->getPersonFirstName();
		}

		public function getStaffPhone(){
				$this->getPersonPhone();
		}
		public function getStaffEmail(){
				$this->getPersonEmail();
		}

		public function getStaffLogin(){
				$this->getPersonLogin();
		}
		public function getStaffPassword(){
				$this->getPersonPassword();
		}
}

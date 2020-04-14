<?php
class Student extends People{
	private $yearNum;
	private $schNum;
	private $pernum;

		public function __construct($val = array(),$schNum,$yearNum){
				if (!empty($val)){
					parent::__construct($val);
					$this->schNum=$schNum;
					$this->yearNum=$yearNum;
				}
			}



		public function getStudentYearNum() {
			return $this->yearNum;
		}

		public function getStudentSchNum() {
			return $this->schNum;
		}

		public function getStudentNum() {
			return $this->pernum;
		}

		public function setStudentNum($num) {
			$this->pernum=$num;
		}

		public function getStudentName(){
			$this->getPersonName();
		    }
		public function getStudentFirstName(){
				$this->getPersonFirstName();
		}

		public function getStudentPhone(){
				$this->getPersonPhone();
		}
		public function getStudentEmail(){
				$this->getPersonEmail();
		}

		public function getStudentLogin(){
				$this->getPersonLogin();
		}
		public function getStudentPassword(){
				$this->getPersonPassword();
		}
}

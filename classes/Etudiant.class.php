<?php
class Etudiant extends Personne{
	private $divnum;
	private $depnum;
	private $pernum;

		public function __construct($valeurs = array(),$depnum,$divnum){
				if (!empty($valeurs)){
					parent::__construct($valeurs);
					$this->depnum=$depnum;
					$this->divnum=$divnum;
				}
			}



		public function getEtuDivNum() {
			return $this->divnum;
		}

		public function getEtuDepNum() {
			return $this->depnum;
		}

		public function getEtuNum() {
			return $this->pernum;
		}

		public function setEtuNum($num) {
			$this->pernum=$num;
		}

		public function getEtuNom(){
			$this->getPersnom();
		    }
		public function getEtuPrenom(){
				$this->getPersPrenom();
		}

		public function getEtuTel(){
				$this->getPersTel();
		}
		public function getEtuMail(){
				$this->getPersMail();
		}

		public function getEtuLogin(){
				$this->getPersLogin();
		}
		public function getEtuMDP(){
				$this->getPersMDP();
		}
}

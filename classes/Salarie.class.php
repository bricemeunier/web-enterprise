<?php
class Salarie extends Personne{
	private $telprof;
	private $fonnum;
	private $pernum;
	private $pernom;

		public function __construct($valeurs = array(),$telprof,$fonnum){
				if (!empty($valeurs)){
					parent::__construct($valeurs);
					$this->telprof=$telprof;
					$this->fonnum=$fonnum;
					foreach ($valeurs as $val=>$attribut){
						if ($val=="per_num"){
							$this->pernum=$attribut;
						}
						if ($val=="per_nom"){
							$this->pernom=$attribut;
						}
					}
				}
			}



		public function getSalTelProf() {
			return $this->telprof;
		}

		public function getSalFonNum() {
			return $this->fonnum;
		}

		public function getSalNum() {
			return $this->pernum;
		}

		public function setSalNum($num) {
			$this->pernum=$num;
		}

		public function getSalNom(){
			return $this->pernom;
		}
		public function getSalPrenom(){
				$this->getPersPrenom();
		}

		public function getSalTel(){
				$this->getPersTel();
		}
		public function getSalMail(){
				$this->getPersMail();
		}

		public function getSalLogin(){
				$this->getPersLogin();
		}
		public function getSalMDP(){
				$this->getPersMDP();
		}
}

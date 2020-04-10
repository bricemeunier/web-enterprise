<?php
class City {
	private $cityNum;
	private $cityNom;


		public function __construct($valeurs = array()){
				if (!empty($valeurs)){
					$this->affecte($valeurs);
				}
			}

		public function affecte($donnees){
			foreach($donnees as $attribut=>$valeur){
				switch ($attribut){
					case 'vil_num':$this->setCityNum($valeur);break;
					case 'vil_nom':$this->setCityNom($valeur);break;
				}
			}
		}



		public function getCityNum() {
			return $this->cityNum;
		}
		public function setCityNum($id){
			$this->cityNum=$id;
		}

		public function getCityNom(){
			return $this->cityNom;
		    }
		public function setCityNom($nom){
		    $this->cityNom=$nom;
		    }

}

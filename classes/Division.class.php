<?php
class Division {
	private $divNum;
	private $divNom;


		public function __construct($valeurs = array()){
				if (!empty($valeurs)){
					$this->affecte($valeurs);
				}
			}

		public function affecte($donnees){
			foreach($donnees as $attribut=>$valeur){
				switch ($attribut){
					case 'div_num':$this->setDivNum($valeur);break;
					case 'div_nom':$this->setDivNom($valeur);break;
				}
			}
		}



		public function getDivNum() {
			return $this->divNum;
		}
		public function setDivNum($id){
			$this->divNum=$id;
		}

		public function getDivNom(){
			return $this->divNom;
		    }
		public function setDivNom($nom){
		    $this->divNom=$nom;
		    }

}

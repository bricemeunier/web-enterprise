<?php
class Fonction {
	private $fonNum;
	private $fonLib;


		public function __construct($valeurs = array()){
				if (!empty($valeurs)){
					$this->affecte($valeurs);
				}
			}

		public function affecte($donnees){
			foreach($donnees as $attribut=>$valeur){
				switch ($attribut){
					case 'fon_num':$this->setFonNum($valeur);break;
					case 'fon_libelle':$this->setFonLib($valeur);break;
				}
			}
		}



		public function getFonNum() {
			return $this->fonNum;
		}
		public function setFonNum($id){
			$this->fonNum=$id;
		}

		public function getFonLib(){
			return $this->fonLib;
		    }
		public function setFonLib($nom){
		    $this->fonLib=$nom;
		    }

}

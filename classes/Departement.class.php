<?php
class Departement {
	private $depNum;
	private $depNom;


		public function __construct($valeurs = array()){
				if (!empty($valeurs)){
					$this->affecte($valeurs);
				}
			}

		public function affecte($donnees){
			foreach($donnees as $attribut=>$valeur){
				switch ($attribut){
					case 'dep_num':$this->setDepNum($valeur);break;
					case 'dep_nom':$this->setDepNom($valeur);break;
				}
			}
		}



		public function getDepNum() {
			return $this->depNum;
		}
		public function setDepNum($id){
			$this->depNum=$id;
		}

		public function getDepNom(){
			return $this->depNom;
		    }
		public function setDepNom($nom){
		    $this->depNom=$nom;
		    }

}

<?php
class MotInterdit {
	private $motId;
	private $motInterdit;


		public function __construct($valeurs = array()){
				if (!empty($valeurs)){
					$this->affecte($valeurs);
				}
			}

		public function affecte($donnees){
			foreach($donnees as $attribut=>$valeur){
				switch ($attribut){
					case 'mot_id':$this->setMotId($valeur);break;
					case 'mot_interdit':$this->setMotInterdit($valeur);break;
				}
			}
		}



		public function getMotId() {
			return $this->motId;
		}
		public function setMotId($id){
			$this->motId=$id;
		}

		public function getMotInterdit(){
			return $this->motInterdit;
		    }
		public function setMotInterdit($mot){
		    $this->motInterdit=$mot;
		    }

}

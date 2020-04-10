<?php
class Citation {
	private $citNum;
	private $citationLibelle;
  private $citationDate;
  private $nomProf;
  private $prenomProf;
  private $moyNote;
	private $perNum;
	private $etuPre;
	private $etuNom;



		public function __construct($valeurs = array()){
				if (!empty($valeurs)){
					$this->affecte($valeurs);
				}
			}

		public function affecte($donnees){
			foreach($donnees as $attribut=>$valeur){
				switch ($attribut){
					case 'etu_pre':$this->setEtuPre($valeur);zbreak;
					case 'etu_nom':$this->setEtuNom($valeur);break;
					case 'cit_moy':$this->setCitationMoyenne($valeur);break;
					case 'cit_num':$this->setCitationNum($valeur);break;
					case 'per_nom':$this->setNomProf($valeur);break;
          case 'per_prenom':$this->setPrenomProf($valeur);break;
          case 'cit_libelle':$this->setCitationLibelle($valeur);break;
          case 'cit_date':$this->setCitationDate($valeur);break;
					case 'per_num':$this->setPersNum($valeur);break;
				}
			}
		}



		public function setEtuPre($pre){
			$this->etuPre=$pre;
		}

		public function getEtuPre(){
			return $this->etuPre;
		}

		public function setEtuNom($nom){
			$this->etuNom=$nom;
		}

		public function getEtuNom(){
			return $this->etuNom;
		}

		public function setPersNum($num){
			$this->perNum=$num;
		}

		public function getPersNum(){
			return $this->perNum;
		}

		public function getCitationNum() {
			return $this->citNum;
		}
		public function setCitationNum($id){
			$this->citNum=$id;
		}

		public function getNomProf(){
			return $this->nomProf;
		    }
		public function setNomProf($nom){
		    $this->nomProf=$nom;
		    }

    public function getPrenomProf(){
    		return $this->prenomProf;
    		}
    public function setPrenomProf($prenom){
    		$this->prenomProf=$prenom;
    }

    public function getCitationLibelle(){
    		return $this->citationLibelle;
    		}
    public function setCitationLibelle($libelle){
    		$this->citationLibelle=$libelle;
    }
    public function getCitationDate(){
    		return $this->citationDate;
    		}
    public function setCitationDate($date){
    		$this->citationDate=$date;
    }

    public function getCitationMoyenne(){
    		return $this->moyNote;
    		}
    public function setCitationMoyenne($moy){
    		$this->moyNote=$moy;
    }
}

<?php
class Personne {
	private $persNum;
	private $persNom;
  private $persPrenom;
	private $persTel;
	private $persMail;
	private $persLogin;
	private $persMDP;

		public function __construct($valeurs = array()){
				if (!empty($valeurs)){
					$this->affecte($valeurs);
				}
			}

		public function affecte($donnees){
			foreach($donnees as $attribut=>$valeur){
				switch ($attribut){
					case 'per_num':$this->setPersNum($valeur);break;
					case 'per_nom':$this->setPersNom($valeur);break;
          case 'per_prenom':$this->setPersPrenom($valeur);break;
					case 'per_tel':$this->setPersTel($valeur);break;
					case 'per_mail':$this->setPersMail($valeur);break;
					case 'per_login':$this->setPersLogin($valeur);break;
					case 'per_pwd':$this->setPersMDP($valeur);break;
				}
			}
		}



		public function getPersNum() {
			return $this->persNum;
		}
		public function setPersNum($id){
			$this->persNum=$id;
		}

		public function getPersNom(){
			return $this->persNom;
		    }
		public function setPersNom($nom){
		    $this->persNom=$nom;
		    }
		public function getPersPrenom(){
				return $this->persPrenom;
		}
		public function setPersPrenom($prenom){
		    $this->persPrenom=$prenom;
		}

		public function getPersTel(){
				return $this->persTel;
		}
		public function setPersTel($tel){
		    $this->persTel=$tel;
		}

		public function getPersMail(){
				return $this->persMail;
		}
		public function setPersMail($mail){
		    $this->persMail=$mail;
		}

		public function getPersLogin(){
				return $this->persLogin;
		}
		public function setPersLogin($login){
		    $this->persLogin=$login;
		}

		public function getPersMDP(){
				return $this->persMDP;
		}
		public function setPersMDP($pwd){
				$salt = "48@!alsd";
	    	$pwd = md5(md5($pwd).$salt);
		   	$this->persMDP=$pwd;
		}
}

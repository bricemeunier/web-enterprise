 <?php
class MotInterditManager{
	private $db;
		public function __construct($db){
			$this->db=$db;

		}

	public function getAllMot(){

		$listeMot=array();
		$sql='SELECT mot_id,mot_interdit FROM mot';
    $sql = $this->db->prepare($sql);
		$sql->execute();

		while ($mot=$sql->fetch(PDO::FETCH_OBJ)){
			$listeMot[]=new MotInterdit($mot);
		}

		$sql->closeCursor();

		return $listeMot;

	}

  public function rechercheMotInterdit($phrase) {
    $listeMot=$this->getAllMot();
    $listeMotTrouve=array();
    $listeReturn=array();
    $phrase=' '.$phrase;
    foreach($listeMot as $mot) {
        if(strripos($phrase, $mot->getMotInterdit())) {
          $phrase=str_ireplace($mot->getMotInterdit(),"---",$phrase);
          $listeMotTrouve[]=$mot->getMotInterdit();
        }
    }
    $phrase = substr($phrase,1);
    $listeReturn[0]=$phrase;
    $listeReturn[1]=$listeMotTrouve;
    return $listeReturn;
  }
}
?>

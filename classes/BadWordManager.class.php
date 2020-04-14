 <?php
class BadWordManager{
	private $db;
		public function __construct($db){
			$this->db=$db;

		}

	public function getAllBadWord(){

		$wordList=array();
		$sql='SELECT word_id,bad_word FROM badWord';
    $sql = $this->db->prepare($sql);
		$sql->execute();

		while ($word=$sql->fetch(PDO::FETCH_OBJ)){
			$wordList[]=new BadWord($word);
		}

		$sql->closeCursor();

		return $wordList;

	}

  public function findBadWord($str) {
    $wordList=$this->getAllBadWord();
    $wordListFound=array();
    $listReturn=array();
    $str=' '.$str;
    foreach($wordList as $word) {
        if(strripos($str, $word->getBadWord())) {
          $str=str_ireplace($word->getBadWord(),"---",$str);
          $wordListFound[]=$word->getBadWord();
        }
    }
    $str = substr($str,1);
    $listReturn[0]=$str;
    $listReturn[1]=$wordListFound;
    return $listReturn;
  }
}
?>

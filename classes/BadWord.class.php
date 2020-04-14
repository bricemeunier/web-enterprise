<?php
class BadWord {
	private $wordId;
	private $badWord;


		public function __construct($val = array()){
				if (!empty($val)){
					$this->create($val);
				}
			}

		public function create($data){
			foreach($data as $attributes=>$value){
				switch ($attributes){
					case 'word_id':$this->setWordId($value);break;
					case 'bad_word':$this->setBadWord($value);break;
				}
			}
		}



		public function getWordId() {
			return $this->wordId;
		}
		public function setWordId($id){
			$this->wordId=$id;
		}

		public function getBadWord(){
			return $this->badWord;
		    }
		public function setBadWord($word){
		    $this->badWord=$word;
		    }

}

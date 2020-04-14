<?php
class Position {
	private $posNum;
	private $posName;


		public function __construct($val = array()){
				if (!empty($val)){
					$this->create($val);
				}
			}

		public function create($data){
			foreach($data as $attributes=>$value){
				switch ($attributes){
					case 'pos_num':$this->setPosNum($value);break;
					case 'pos_name':$this->setPosName($value);break;
				}
			}
		}



		public function getPosNum() {
			return $this->posNum;
		}
		public function setPosNum($id){
			$this->posNum=$id;
		}

		public function getPosName(){
			return $this->posName;
		    }
		public function setPosName($name){
		    $this->posName=$name;
		    }

}

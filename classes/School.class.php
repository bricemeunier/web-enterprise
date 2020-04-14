<?php
class School {
	private $schNum;
	private $schName;


		public function __construct($val = array()){
				if (!empty($val)){
					$this->create($val);
				}
			}

		public function create($data){
			foreach($data as $attributes=>$value){
				switch ($attributes){
					case 'sch_num':$this->setSchNum($value);break;
					case 'sch_name':$this->setSchName($value);break;
				}
			}
		}



		public function getSchNum() {
			return $this->schNum;
		}
		public function setSchNum($id){
			$this->schNum=$id;
		}

		public function getSchName(){
			return $this->schName;
		    }
		public function setSchName($name){
		    $this->schName=$name;
		    }

}

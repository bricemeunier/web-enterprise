<?php
class Year {
	private $yearNum;
	private $yearName;


		public function __construct($val = array()){
				if (!empty($val)){
					$this->create($val);
				}
			}

		public function create($data){
			foreach($data as $attributes=>$value){
				switch ($attributes){
					case 'year_num':$this->setYearNum($value);break;
					case 'year_name':$this->setYearName($value);break;
				}
			}
		}



		public function getYearNum() {
			return $this->yearNum;
		}
		public function setYearNum($id){
			$this->yearNum=$id;
		}

		public function getYearName(){
			return $this->yearName;
		    }
		public function setYearName($name){
		    $this->yearName=$name;
		    }

}

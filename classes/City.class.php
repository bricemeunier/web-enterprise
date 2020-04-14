<?php
class City {
	private $cityNum;
	private $cityName;


		public function __construct($val = array()){
				if (!empty($val)){
					$this->create($val);
				}
			}

		public function create($data){
			foreach($data as $attributes=>$value){
				switch ($attributes){
					case 'city_num':$this->setCityNum($value);break;
					case 'city_name':$this->setCityName($value);break;
				}
			}
		}



		public function getCityNum() {
			return $this->cityNum;
		}
		public function setCityNum($id){
			$this->cityNum=$id;
		}

		public function getCityName(){
			return $this->cityName;
		    }
		public function setCityName($name){
		    $this->cityName=$name;
		    }

}

<?php
class Quote {
	private $quoNum;
	private $quoteText;
  private $quoteDate;
  private $staffName;
  private $staffFirstName;
  private $markAverage;
	private $perNum;
	private $studentFirstName;
	private $studentName;



		public function __construct($val = array()){
				if (!empty($val)){
					$this->create($val);
				}
			}

		public function create($data){
			foreach($data as $attributes=>$value){
				switch ($attributes){
					case 'stu_f_name':$this->setStudentFirstName($value);break;
					case 'stu_name':$this->setStudentName($value);break;
					case 'quo_moy':$this->setQuoteAverageMark($value);break;
					case 'quo_num':$this->setQuoteNum($value);break;
					case 'per_name':$this->setStaffName($value);break;
          case 'per_f_name':$this->setStaffFirstName($value);break;
          case 'quo_quote':$this->setQuoteText($value);break;
          case 'quo_date':$this->setQuoteDate($value);break;
					case 'per_num':$this->setPersNum($value);break;
				}
			}
		}



		public function setStudentFirstName($name){
			$this->studentFirstName=$name;
		}
		public function getStudentFirstName(){
			return $this->studentFirstName;
		}

		public function setStudentName($name){
			$this->studentName=$name;
		}
		public function getStudentName(){
			return $this->studentName;
		}

		public function setPersNum($num){
			$this->perNum=$num;
		}
		public function getPersNum(){
			return $this->perNum;
		}

		public function getQuoteNum() {
			return $this->quoNum;
		}
		public function setQuoteNum($id){
			$this->quoNum=$id;
		}

		public function getStaffName(){
			return $this->staffName;
		    }
		public function setStaffName($name){
		    $this->staffName=$name;
		    }

    public function getStaffFirstName(){
    		return $this->staffFirstName;
    		}
    public function setStaffFirstName($name){
    		$this->staffFirstName=$name;
    }

    public function getQuoteText(){
    		return $this->quoteText;
    		}
    public function setQuoteText($quote){
    		$this->quoteText=$quote;
    }

		public function getQuoteDate(){
    		return $this->quoteDate;
    		}
    public function setQuoteDate($date){
    		$this->quoteDate=$date;
    }

    public function getQuoteAverageMark(){
    		return $this->markAverage;
    		}
    public function setQuoteAverageMark($average){
    		$this->markAverage=$average;
    }
}

<?php
class QuoteManager{
	private $db;
		public function __construct($db){
			$this->db=$db;

		}

		public function add($quote){
			$datetime = date("Y-m-d H:i:s");
      $req = $this->db->prepare(
			'INSERT INTO quote (per_num,per_num_stu,quo_quote,quo_date,quo_date_added) VALUES (:per_num,:per_num_stu,:quo_quote,:quo_date,:quo_date_added)');

			$req->bindValue(':per_num',$quote->getPersNum());
			$req->bindValue(':per_num_stu',$_SESSION['user_num']);
			$req->bindValue(':quo_quote',$quote->getQuoteText());
			$req->bindValue(':quo_date',$quote->getQuoteDate());
			$req->bindValue(':quo_date_added',$datetime);

			$retour=$req->execute();
			return $retour;
  	}


		public function addMark($mark,$quo_num){
      $req = $this->db->prepare(
			'INSERT INTO mark VALUES (:quo_num,:per_num,:mark)');

			$req->bindValue(':quo_num',$quo_num);
			$req->bindValue(':per_num',$_SESSION['user_num']);
			$req->bindValue(':mark',$mark);

			$req->execute();
  	}


		public function hasMarkedQuote($num){
      $req='SELECT COUNT(*) as result FROM mark where quo_num='.$num.' and per_num='.$_SESSION['user_num'];
      $sql=$this->db->prepare($req);
      $sql->execute();
      $sql= $sql->fetch(PDO::FETCH_OBJ);
			return $sql->result;
    }


		public function deleteQuote($quonum){
    	$req = $this->db->prepare(
			'DELETE FROM mark WHERE quo_num='.$quonum);

			$retour=$req->execute();

			$req = $this->db->prepare(
			'DELETE FROM quote WHERE quo_num='.$quonum);

			$retour=$req->execute();
    }


    public function getQuotesNumber(){
      $req='SELECT count(*) as total FROM (SELECT q.quo_num,per_f_name,per_name,quo_quote,quo_date,quo_moy
				 FROM quote q JOIN people p ON (q.per_num=p.per_num) LEFT JOIN
				 (SELECT quo_num,AVG(mark_value) as quo_moy FROM mark GROUP BY quo_num) a
				  ON q.quo_num=a.quo_num WHERE quo_valid=1 AND quo_date_valid is not null) nb';

      $sql=$this->db->prepare($req);
      $sql->execute();
      return $sql->fetch(PDO::FETCH_OBJ);

    }


		public function getAllQuotes(){
			$quoteList=array();

			$sql='SELECT q.quo_num,per_f_name,per_name,quo_quote,quo_date,COALESCE(quo_moy,"N/A") as quo_moy
				 FROM quote q JOIN people p ON (q.per_num=p.per_num) LEFT JOIN
				 (SELECT quo_num,AVG(mark_value) as quo_moy FROM mark GROUP BY quo_num) a
				  ON q.quo_num=a.quo_num WHERE quo_valid=1 AND quo_date_valid is not null';

			$req=$this->db->prepare($sql);
			$req->execute();

			while ($quote=$req->fetch(PDO::FETCH_OBJ)){
				$quoteList[]=new Quote($quote);
			}

			$req->closeCursor();

			return $quoteList;
		}


		public function getAllQuotesAwaiting(){
			$quoteList=array();

			$sql='SELECT q.quo_num,per_f_name,per_name,quo_quote,quo_date
			FROM quote q,people p
			WHERE q.per_num=p.per_num AND quo_valid=0 ';

			$req=$this->db->prepare($sql);
			$req->execute();

			while ($quote=$req->fetch(PDO::FETCH_OBJ)){
				$quoteList[]=new Quote($quote);
			}

			$req->closeCursor();

			return $quoteList;
		}


		public function approveQuote($quoNum){

			$datetime = date("Y-m-d");
			$req = $this->db->prepare(
			'UPDATE quote SET quo_valid=1,per_num_valid='.$_SESSION["user_num"].', quo_date_valid="'.$datetime.'"
			 WHERE quo_num='.$quoNum);

			$req->execute();
		}


		public function searchQuote(){
			$filter=0;
			$quoteList=array();

			$sql='SELECT q.quo_num,per_f_name,per_name,quo_quote,quo_date,COALESCE(quo_moy,"N/A") as quo_moy
				 FROM quote q JOIN people p ON (q.per_num=p.per_num) LEFT JOIN
				 (SELECT quo_num,AVG(mark_value) as quo_moy FROM mark GROUP BY quo_num) a
				  ON q.quo_num=a.quo_num WHERE quo_valid=1 AND quo_date_valid is not null';

			 	if (!(empty($_POST['per_num'])) && ($_POST['per_num']!="0")){
					$sql=$sql." AND ";
					$sql=$sql."q.per_num=".$_POST['per_num']." ";
					$filter++;
				}
				if (!(empty($_POST['cit_date']))){
					if ($filter!=0){
						$sql=$sql."AND quo_date='".$_POST['quo_date']."' ";
					}
					else {
						$sql=$sql." AND ";
						$sql=$sql."quo_date='".$_POST['quo_date']."' ";
					}
					$filter++;
				}
				if (!(empty($_POST['quo_moy']))){
					if ($filter!=0){
						$sql=$sql."AND quo_moy>='".$_POST['quo_moy']."' ";
					}
					else {
						$sql=$sql." AND ";
						$sql=$sql."quo_moy='".$_POST['quo_moy']."' ";
					}
				}
				$req=$this->db->prepare($sql);
				$req->execute();

			while ($quote=$req->fetch(PDO::FETCH_OBJ)){
				$quoteList[]=new Quote($quote);
			}

			$req->closeCursor();
			return $quoteList;
		}

}
?>

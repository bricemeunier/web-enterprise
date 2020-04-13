<?php
class Mypdo extends PDO
{

	protected $dbo;

	public function __construct ()
	{
		if (ENV=='dev'){
			$bool=true;
		}
		else
		{
			$bool=false;
		}
		try {
			$this->dbo =parent::__construct("mysql:host=".DBHOST."; dbname=".DBNAME, DBUSER, DBPASSWD,
			array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => $bool, PDO::ERRMODE_EXCEPTION => $bool));
			$req = "SET NAMES UTF8;";
			$resu = PDO::query($req);

		}
		catch (PDOException $e) {
			echo 'Error while connecting to the database : ' . $e->getMessage();
		}

	}

}

?>

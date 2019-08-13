<?php 
$USERNAME = 'root';
$PASSWORD = '';
$HOST = 'localhost';
$DB = 'movies_db';

class Database{
	private $Connection;
	
	function Database(){
		$this->Open_Connection();
	}
	
	public function Open_Connection(){
		global $HOST, $DB, $USERNAME, $PASSWORD;
		try{
			$this->Connection = new PDO("mysql:host=$HOST; dbname=$DB", $USERNAME, $PASSWORD);
			$this->Connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "You are connected !";
		}catch(PDOException $e){
			echo "Connection failed : ".$e->getMessage();
		}
	}
	
	public function Close_Connection(){
		$this->Connection = NULL;
	}
	
	public function Get_Connection(){
		return $this->Connection;
	}
}
?>
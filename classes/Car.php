<?php 
require_once "Database.php";

class Car{
	private static $database;
	
	private $ID;
	private $Year;
	private $Make;
	private $Model;
	private $OldPrice;
	private $Price;
	private $KM;
	private $Color;
	private $Image;
	
	function Car($Year,$Make,$Model,$OldPrice,
	                     $Price,$KM,$Color,$Image, $ID = null){
		$this->ID = $ID;
		$this->Year = $Year;
		$this->Make = $Make;
		$this->Model = $Model;
		$this->OldPrice = $OldPrice;
		$this->Price = $Price;
		$this->KM = $KM;
		$this->Color = $Color;
		$this->Image = $Image;
	}
	
	public static function Init_Database(){
		if(!isset(self::$database)){
			self::$database = new Database();
		}
	}
	
	public function Create(){
		$database = Database::Get_Instance();
		$connection = $database->Get_Connection();
		// self::init_database();
		// $connection = self::$database->GetConnection();
		try{
			$query  = "INSERT INTO CAR(Year, Make, Model, OldPrice, Price, KM, Color, Image) ";
			$query .= " VALUES(?, ?, ?, ?, ?, ?, ?, ? )";
		
			$stmt = $connection->prepare($query);
			$stmt->bindParam(1,$this->Year);
			$stmt->bindParam(2,$this->Make);
			$stmt->bindParam(3,$this->Model);
			$stmt->bindParam(4,$this->OldPrice);
			$stmt->bindParam(5,$this->Price);
			$stmt->bindParam(6,$this->KM);
			$stmt->bindParam(7,$this->Color);
			$stmt->bindParam(8,$this->Image);
		
			$stmt->execute();
			
			return $connection-> lastInsertId();
			
		}catch(PDOException $e){
			echo "Query Failed ".  $e->getMessage();
		}
	}
	public static function ReadCars(){
		try{
			self::Init_Database();
			$query = "SELECT * FROM cars";

		    $connection = self::$database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->execute();
			
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			return $result;
			
		}catch(PDOException $e){
			echo "INSERT Query Failed : ".$e->getMessage();
		}	
		
	}

}
?>
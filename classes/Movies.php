<?php 
require_once "Database.php";

class Movie{
	private static $database;
	
	private $ID;
	// private $totalRatings;
	// private $num_of_ratings;
	
	function Movie($ID, $Title, $totalRatings = NULL, $num_of_ratings = NULL) {
		$this->ID = $ID;
		$this->Title = $Title;
		$this->totalRatings = $totalRatings;
		$this->num_of_ratings = $num_of_ratings;
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
			$query  = "INSERT INTO movie (ID, Title, Avg_rating) ";
			$query .= " VALUES(?, ?, ?, ?, ?, ?, ?, ? )";
		
			$stmt = $connection->prepare($query);
			$stmt->bindParam(1,$this->ID);
			$stmt->bindParam(2,$this->Title);
			$stmt->bindParam(3,$this->Avg_rating);
		
			$stmt->execute();
			
			return $connection-> lastInsertId();
			
		}catch(PDOException $e){
			echo "Query Failed ".  $e->getMessage();
		}
	}

	public function Insert(){
		try{
			self::Init_Database();
			$query = "INSERT INTO movie (id, title,	totalRatings, num_of_ratings)";
			$query .= " VALUES(?,?,?,?)";
		    $connection = self::$database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->bindParam(1, $this->ID);
			$statement->bindParam(2, $this->Title);
			$statement->bindParam(3, $this->totalRatings);
			$statement->bindParam(4, $this->num_of_ratings);
			$statement->execute();
			// echo "User inserted ID = ".$connection->lastInsertId();
		}catch(PDOException $e){
			echo "INSERT Query Failed : ".$e->getMessage();
		}	
	}

	public function ReadMovieAvg($movieId){
		try{

			self::Init_Database();
			
			$query = "SELECT  AVG(movie_rating) from `movie_rating` WHERE movie_id = $movieId";
					
		    $connection = self::$database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->execute();
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			return $result[0];
		}catch(PDOException $e){
			echo "INSERT Query Failed : ".$e->getMessage();
		}	
	}
	public static function ReadMovies(){
		try{
			self::Init_Database();
			$query = "SELECT * FROM movie";

		    $connection = self::$database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->execute();
			
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			return $result;
			
		}catch(PDOException $e){
			echo "INSERT Query Failed : ".$e->getMessage();
		}	
	}

	public static function ReadMoviebyId($id){
		try{
			self::Init_Database();
			$query = "SELECT * FROM movie where id = $id";

		    $connection = self::$database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->execute();
			
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			return $result;
			
		}catch(PDOException $e){
			echo "INSERT Query Failed : ".$e->getMessage();
		}	
	}
	

	public static function ReadMovieRatingsByUserId($userId, $movieId){
		try{
			self::Init_Database();
			$query = "SELECT * FROM movie_rating where `user_id` = $userId AND `movie_id` = $movieId ";

		    $connection = self::$database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->execute();
			
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			return $result;
			
		}catch(PDOException $e){
			echo "INSERT Query Failed : ".$e->getMessage();
		}	
	}
	public static function rateMovieByUserID($userId, $movieId, $movieRating){
		try{

			// insert userid, movieid and user rate from frontend
			self::Init_Database();
			$query = "INSERT INTO movie_rating (user_id, movie_id, movie_rating)";
			$query .= " VALUES(?,?,?)";
		    $connection = self::$database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->bindParam(1, $userId);
			$statement->bindParam(2, $movieId);
			$statement->bindParam(3, $movieRating);
			$statement->execute();
		}catch(PDOException $e){
			echo "INSERT Query Failed : ".$e->getMessage();
		}	
	}
	

}
?>
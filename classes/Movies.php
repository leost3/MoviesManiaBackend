<?php 
require_once "Database.php";

class Movie{
	private static $database;
	
	// // private $ID;
	// private $totalRatings;
	// private $num_of_ratings;
	
	// function Movie($totalRatings = NULL, $num_of_ratings = NULL ){
	// 	// $this->ID = $ID;
	// 	$this->totalRatings = $totalRatings;
	// 	$this->num_of_ratings = $num_of_ratings;
	// }
	
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

	public function InsertIntoMovies($movieId, $totalRatings, $num_of_ratings, $userRate){
		try{
			self::Init_Database();

			// $num_of_ratings = $num_of_ratings = 1
			$query = "UPDATE `movie` SET `totalRatings`=$totalRatings + $userRate,`num_of_ratings`=$num_of_ratings WHERE id = $movieId";
			// $query = "SELECT * movie";
					
		    $connection = self::$database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->execute();

			return $num_of_ratings;
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
	

	public static function ReadMovieRatingsByUserId(){
		try{
			self::Init_Database();
			$query = "SELECT * FROM movie where id = $ID";

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
			// self::Init_Database();
			// $query = "INSERT INTO movie_rating (user_id, movie_id, movie_rating)";
			// $query .= " VALUES(?,?,?)";
		    // $connection = self::$database->Get_Connection();
			// $statement  = $connection->prepare($query);
			// $statement->bindParam(1, $userId);
			// $statement->bindParam(2, $movieId);
			// $statement->bindParam(3, $movieRating);
			// $statement->execute();
			// -------------------------------------------------
			self::Init_Database();
			$query1 = "SELECT totalRatings, num_of_ratings from  movie where id = $movieId";
			$connection = self::$database->Get_Connection();
			$statement  = $connection->prepare($query1);
			$statement->execute();
			
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			return $result;
		}catch(PDOException $e){
			echo "INSERT Query Failed : ".$e->getMessage();
		}	
	}
	

}
?>
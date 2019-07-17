<?php 
require_once "Database.php";

class FavoriteMovies{
	private static $database;
	
	
	public static function Init_Database(){
		if(!isset(self::$database)){
			self::$database = new Database();
		}
	}

	public static function InsertFavoriteMovie($movieId, $userId, $moviePosterPath, $movieTitle){
		try{

			// insert userid, movieid and user rate from frontend
			self::Init_Database();
			$query = "INSERT INTO favoritemovies (movieId, userId, moviePosterPath, movieTitle)";
			$query .= " VALUES(?,?,?,?)";
		    $connection = self::$database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->bindParam(1, $movieId);
			$statement->bindParam(2, $userId);
			$statement->bindParam(3, $moviePosterPath);
			$statement->bindParam(4, $movieTitle);
			$statement->execute();
		}catch(PDOException $e){
			echo "INSERT Query Failed : ".$e->getMessage();
		}	
	// }
	// 	try{
	// 		self::Init_Database();
	// 		// $query = "INSERT INTO `favoritemovies` (movieId, userId,	moviePosterPath, movieTitle)";
	// 		// $query .= " VALUES($movieId, $userId, $moviePosterPath, $movieTitle)";

	// 		// $query = "INSERT INTO `favoritemovies`(`movieId`, `userId`, `moviePosterPath`, `movieTitle`) VALUES (1,2,'asd','asd')";
	// 		$query = "INSERT INTO favoritemovies(`movieId`, `userId`, `moviePosterPath`, `movieTitle`) VALUES (".$movieId.",".$userId.",".$moviePosterPath.",".$movieTitle.")";

	// 	    $connection = self::$database->Get_Connection();
	// 		$statement  = $connection->prepare($query);
	// 		// $statement->bindParam(1, $userId);
	// 		// $statement->bindParam(2, $movieId);
	// 		// $statement->bindParam(3, $movieRating);
	// 		$statement->execute();
	// 	}catch(PDOException $e){
	// 		echo "INSERT Query Failed : ".$e->getMessage();
	// 	}	
	}
	
	// public function InsertFavoriteMovie($movieId, $userId, $moviePosterPath, $movieTitle){

	// 	try{
	// 		self::Init_Database();
	// 		$query  = "INSERT INTO favoritemovies (movieId, userId,	moviePosterPath, movieTitle) ";
	// 		$query .= " VALUES($movieId, $userId, $moviePosterPath, $movieTitle)";
	// 		$stmt = $connection->prepare($query);
	// 		$stmt->execute();					
	// 	}catch(PDOException $e){
	// 		echo "Query Failed ".  $e->getMessage();
	// 	}
	// }

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
	public static function getAllMoviesRatings(){
		try{
			self::Init_Database();
			$query = "SELECT * FROM movie_rating";

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
}
?>
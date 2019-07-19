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
    }
    
}
?>
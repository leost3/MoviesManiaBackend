<?php

require_once "../classes/Movies.php";
require_once "../classes/Favorites.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $action = $data['action'];

    switch ($action){
        case "getGeneralRatings":
            $result = Movie::ReadMovies();
            // echo json_encode(["result" => $result]);
            break;
        case "getRatings":
            $userId = $data['userId'];
            $movieId = $data['movieId'];
            $movieRatedByUser = Movie::ReadMovieRatingsByUserId($userId, $movieId);
            // $movieRatedByUser = Movie::ReadMovieById($movieId);
            $result = $movieRatedByUser;
            // $result2 = Movie::ReadMovieRatingsByUserId();

            break;
        case "getAllRatings":
            $allMoviesRatings = Movie::getAllMoviesRatings();
            // $movieRatedByUser = Movie::ReadMovieById($movieId);
            $result = $allMoviesRatings;
            // $result2 = Movie::ReadMovieRatingsByUserId();

            break;
        case "rateMovie":
            // Retrives userid, movieid, userrate from the frontend
            $userId = $data['userId'];
            $movieId = $data['movieId'];
            $userRate = $data['userRate'];
            // Rates particular movie by an user on table movie_rating
            $insertMovieRating = Movie::rateMovieByUserID($userId,$movieId,$userRate);
            $movieRatedByUser = Movie::ReadMovieRatingsByUserId($userId, $movieId);
            $result = $movieRatedByUser;
            break;
        case "getAvg":
            $movieId = $data['movieId'];
            $movieAvg = Movie::ReadMovieAvg($movieId);
            $result = $movieAvg;
            break;
        case "addToFavorites":
            $movieId = $data['movieId'];
            $userId = $data["userId"];
            $moviePosterPath = $data["poster_path"];
            $movieTitle = $data["movieTitle"];
            FavoriteMovies::InsertFavoriteMovie($movieId, $userId, $moviePosterPath, $movieTitle);
            // $result = "Movie $movieId inserted";
            $result = [$movieId, $userId, $moviePosterPath, $movieTitle];
            break;
        case "getFavorites":
            $userId = $data["userId"];
            $favorites = FavoriteMovies::ReadFavoriteMoviesbyId($userId);
            $result = $favorites;
            break;
        case "removeFromFavorites":
            $userId = $data["userId"];
            $movieId = $data['movieId'];

            FavoriteMovies::Delete_Favorite($userId, $movieId);
            $result = [$userId, $movieId];
            break;
        }   
        
        echo json_encode(["result" => $result]);
    // echo json_encode(["result" => $movieObj]);
}

// public static function InsertFavoriteMovie($movieId, $userId, $moviePosterPath, $movieTitle){
//     try{
//         // insert userid, movieid and user rate from frontend
//         self::Init_Database();
//         $query = "INSERT INTO favoritemovies (movieId, userId, moviePosterPath, movieTitle)";
//         $query .= " VALUES(?,?,?,?)";
//         $connection = self::$database->Get_Connection();
//         $statement  = $connection->prepare($query);
//         $statement->bindParam(1, $movieId);
//         $statement->bindParam(2, $userId);
//         $statement->bindParam(3, $moviePosterPath);
//         $statement->bindParam(4, $movieTitle);
//         $statement->execute();
//     }catch(PDOException $e){
//         echo "INSERT Query Failed : ".$e->getMessage();
//     }	
// }
<?php

require_once "../classes/Movies.php";
require_once "../classes/FavoriteMovies.php";


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
        }   
        
        echo json_encode(["result" => $result]);
    // echo json_encode(["result" => $movieObj]);
}
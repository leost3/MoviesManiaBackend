<?php

require_once "../classes/Movies.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $action = $data['action'];

    switch ($action){
        case "getGeneralRatings":
            $result = Movie::ReadMovies();
            // echo json_encode(["result" => $result]);
            break;
        case "getRatings":
            $Id = $data['movieId'];
            $result = Movie::ReadMovieById($Id);
            // $result2 = Movie::ReadMovieRatingsByUserId();

            break;
        case "rateMovie":
            // Retrives userid, movieid, userrate from the frontend
            $userId = $data['userId'];
            $movieId = $data['movieId'];
            $userRate = $data['userRate'];
            // Rates particular movie by an user on table movie_rating
            $insertMovieRating = Movie::rateMovieByUserID($userId,$movieId,$userRate);
            // Retrives the current numberOfRarings and the totalRating from table movie
            $totalRatings = $insertMovieRating[0]['totalRatings'];
            $num_of_ratings = $insertMovieRating[0]['num_of_ratings'];
            // Updates numberOfRarings and the totalRating on table movie
            $movie = Movie::InsertIntoMovies($movieId, $totalRatings, $num_of_ratings, $userRate);
            // $movie = Movie::InsertIntoMovies($movieId, 0, 0, 0);
            $result = $movie;
            // $result = $movieId;
            // $result = Movie::ReadMovieById($Id);
            // $result2 = Movie::ReadMovieRatingsByUserId();

            break;
        }
        
        echo json_encode(["result" => $result]);
    // echo json_encode(["result" => $movieObj]);
}
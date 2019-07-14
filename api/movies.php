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
            $userId = $data['userId'];
            $movieId = $data['movieId'];
            $userRate = $data['userRate'];
            $insertMovieRating = Movie::rateMovieByUserID($userId,$movieId,$userRate);
            $totalRatings = $insertMovieRating[0]['totalRatings'];
            $num_of_ratings = $insertMovieRating[0]['totalRatings'];
            $movie = Movie::InsertIntoMovies($movieId, $totalRatings, $num_of_ratings, $userRate);
            // $movie = Movie::InsertIntoMovies($movieId, 0, 0, 0);
            $result = ($movie);
            // $result = $movieId;
            // $result = Movie::ReadMovieById($Id);
            // $result2 = Movie::ReadMovieRatingsByUserId();

            break;
        }
        
        echo json_encode(["result" => $result]);
    // echo json_encode(["result" => $movieObj]);
}
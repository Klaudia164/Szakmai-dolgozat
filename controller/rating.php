<?php
    session_start();
    require '../model/movies.php';
    require '../includes/db.php';
    $movies = new Movies();
    if (isset($_POST['action'])){
        if(isset($_SESSION['id'])){
            $output = array(
                'rating'	=>	$movies -> get_rating($_POST['movieId'], $conn),
            );
            echo json_encode($output);
        }else{
            $output = array(
                'rating'	=>	0,
            );
            echo json_encode($output);
        }
    }
?>
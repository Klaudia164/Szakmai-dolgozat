<?php
    session_start();
    require '../model/movies.php';
    require '../model/series.php';
    require '../model/actors.php';
    require '../includes/db.php';
    $movies = new Movies();
    if (isset($_POST['action']) && $_POST['action']=="movies"){
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
    if (isset($_POST['action']) && $_POST['action']=="movie_avgrating"){
        $output = array(
            'avg' => $movies -> get_avgrating($_REQUEST["movieId"], $conn),
        );
    echo json_encode($output);
    }

    $actors = new Actors();
    if (isset($_POST['action']) && $_POST['action']=="actors"){
        if(isset($_SESSION['id'])){
            $output = array(
                'rating'	=>	$actors -> get_rating($_POST['actorsId'], $conn),
            );
            echo json_encode($output);
        }else{
            $output = array(
                'rating'	=>	0,
            );
            echo json_encode($output);
        }
    }
    if (isset($_POST['action']) && $_POST['action']=="actors_avgrating"){
        $output = array(
            'avg' => $actors -> get_avgrating($_REQUEST["actorsId"], $conn),
        );
    echo json_encode($output);
    }

    $series = new Series();
    if (isset($_POST['action']) && $_POST['action']=="series"){
        if(isset($_SESSION['id'])){
            $output = array(
                'rating'	=>	$series -> get_rating($_POST['seriesId'], $conn),
            );
            echo json_encode($output);
        }else{
            $output = array(
                'rating'	=>	0,
            );
            echo json_encode($output);
        }
    }
    if (isset($_POST['action']) && $_POST['action']=="series_avgrating"){
        $output = array(
            'avg' => $series -> get_avgrating($_REQUEST["seriesId"], $conn),
        );
    echo json_encode($output);
    }

?>
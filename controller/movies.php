<?php

if(isset($_POST['comment'])){
    $movies -> komment(htmlspecialchars($_POST['comment']), $_REQUEST['movieId'], $conn);
    unset($_POST['comment']);
}

if (isset($_POST['rating_data']) && isset($_SESSION['id'])){
    $movies -> set_rating($_POST['rating_data'], $_REQUEST['movieId'], $conn);
    unset($_POST['rating_data']);
}



include "view/movies.php";

?>
<?php

if(isset($_POST['comment'])){
    $censored=array();
    $cfile=fopen("censored.txt",'rw');
    while($sor = fgets($cfile)){
        $censored[]=trim($sor);
    }
    fclose($cfile);
    $comment=str_replace($censored,"***",$_POST['comment']);
    $movies -> komment(htmlspecialchars($comment), $_REQUEST['movieId'], $conn);
    header('location: index.php?page=movies&movieId='. $_REQUEST['movieId'].'');
}

if (isset($_POST['rating_data']) && isset($_SESSION['id'])){
    $movies -> set_rating($_POST['rating_data'], $_REQUEST['movieId'], $conn);
    unset($_POST);
}



include "view/movies.php";

?>
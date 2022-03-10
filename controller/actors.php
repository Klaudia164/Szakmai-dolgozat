<?php

if(isset($_POST['comment'])){
    $censored=array();
    $cfile=fopen("censored.txt",'rw');
    while($sor = fgets($cfile)){
        $censored[]=trim($sor);
    }
    fclose($cfile);
    $comment=str_replace($censored,"***",$_POST['comment']);
    $actors -> komment(htmlspecialchars($comment), $_REQUEST['actorsId'], $conn);
    header('location: index.php?page=actors&actorsId='. $_REQUEST['actorsId'].'');
}

if (isset($_POST['rating_data']) && isset($_SESSION['id'])){
    $actors -> set_rating($_POST['rating_data'], $_REQUEST['actorsId'], $conn);
    unset($_POST);
}

include "view/actors.php";

?>
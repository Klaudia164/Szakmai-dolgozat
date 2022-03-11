<?php

if(isset($_POST['comment'])){
    $censored=array();
    $cfile=fopen("censored.txt",'rw');
    while($sor = fgets($cfile)){
        $censored[]=trim($sor);
    }
    fclose($cfile);
    $comment = $_POST['comment'];
    $words = explode(" ", $comment);
    foreach($words as $word){
        if(in_array($word,$censored)){
            $replace="";
            for($i=0;$i<strlen($word);$i++){
                $replace.="*";
            }
            $comment=str_replace($word,$replace,$comment);
        }
    } 
    $actors -> komment(htmlspecialchars($comment), $_REQUEST['actorsId'], $conn);
    header('location: index.php?page=actors&actorsId='. $_REQUEST['actorsId'].'');
}

if (isset($_POST['rating_data']) && isset($_SESSION['id'])){
    $actors -> set_rating($_POST['rating_data'], $_REQUEST['actorsId'], $conn);
    unset($_POST);
}

include "view/actors.php";

?>
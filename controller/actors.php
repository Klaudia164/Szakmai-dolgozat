<?php

if(isset($_POST['comment'])){
    
    $comment = censore($_POST['comment']);
    $actors -> komment(htmlspecialchars($comment), $_REQUEST['actorsId'], $conn);
    header('location: index.php?page=actors&actorsId='. $_REQUEST['actorsId'].'');
}

if(isset($_POST['removeId'])){
    $actors -> delcomment($_POST['removeId'], $conn);
    header('location: index.php?page=actors&actorsId='. $_REQUEST['actorsId'].'');
}

if(isset($_POST['commentId']) && !empty($_POST['editcomment'])){
    $actors -> editcomment(censore($_POST['editcomment']), $_POST['commentId'], $conn);
    header('location: index.php?page=actors&actorsId='. $_REQUEST['actorsId'].'');
}

if (isset($_POST['rating_data']) && isset($_SESSION['id'])){
    $actors -> set_rating($_POST['rating_data'], $_REQUEST['actorsId'], $conn);
    unset($_POST);
}

function censore($mondat){
    $censored=array();
    $cfile=fopen("censored.txt",'rw');
    while($sor = fgets($cfile)){
        $censored[]=trim($sor);
    }
    fclose($cfile);
    $words = explode(" ", $mondat);
    foreach($words as $word){
        if(in_array($word,$censored)){
            $replace="";
            for($i=0;$i<strlen($word);$i++){
                $replace.="*";
            }
            $mondat=str_replace($word,$replace,$mondat);
        }
    } 
    return $mondat;
}

include "view/actors.php";

?>
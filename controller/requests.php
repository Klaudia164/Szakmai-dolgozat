<?php 
$error = '';
if(isset($_SESSION['id'])){
    $felhasznalo -> set_user($_SESSION['id'], $conn);
    if($felhasznalo -> get_permission() < 2){
        header('location: index.php?page=page');
        exit();
    }
}else{
    header('location: index.php?page=page');
    exit();
}


if(isset($_POST['accept'])){
   if($_POST['request_type']=="Movie"){
    $sql= "UPDATE `filmek` SET `elfogadva`='1' WHERE id=".$_REQUEST['movieId']."";
    $conn->query($sql);
   }
   if($_POST['request_type']=="Series"){
    $sql= "UPDATE `sorozatok` SET `elfogadva`='1' WHERE id=".$_REQUEST['seriesId']."";
    $conn->query($sql);
   }
   if($_POST['request_type']=="Actor/actress"){
    $sql= "UPDATE `szineszek` SET `elfogadva`='1' WHERE id=".$_REQUEST['actorsId']."";
    $conn->query($sql);
   }
   header('location: index.php?page=requests');
}

if(isset($_POST['decline'])){
    if($_POST['request_type']=="Movie"){
        $sql= "DELETE FROM `filmek` WHERE id=".$_REQUEST['movieId']."";
        $conn->query($sql);
    }
    if($_POST['request_type']=="Series"){
        $sql= "DELETE FROM `sorozatok` WHERE id=".$_REQUEST['seriesId']."";
        $conn->query($sql);
    }
    if($_POST['request_type']=="Actor/actress"){
        $sql= "DELETE FROM `szineszek` WHERE id=".$_REQUEST['actorsId']."";
        $conn->query($sql);
    }
    header('location: index.php?page=requests');
}

$sList = $series -> request_seriesLista($conn);

$aList = $actors -> request_actorsLista($conn);

$mList = $movies -> request_moviesLista($conn);
include "view/requests.php";
?>
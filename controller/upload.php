<?php

$uploadError = '';

if(isset($_POST["type"])){
    if($_POST["type"] == "0"){
        $uploadError .= "Please choose a type!";
    }elseif($_POST["type"] == "Movie"){
        if(empty($_POST["title"])){
            $uploadError .= 'Please write down the title of the movie!<br>';
        }
        if(empty($_POST["genre"])){
            $uploadError .= 'Please write down the genre of the movie!<br>';
        }
        if(empty($_POST["info"])){
            $uploadError .= 'Please write down the information of the movie!<br>';
        }
        if(empty($_FILES["bg"]['name'])){
            $uploadError .= 'Please choose a background for the movie!<br>';
        }else{
            $allowed_filetypes = array('image/png', 'image/jpg','image/jpeg');
            if (!in_array($_FILES["bg"]["type"], $allowed_filetypes) ) {
                $uploadError = "The file you want to upload is not an image!";
              }
        }
        if($uploadError == ''){
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["bg"]['name']);
            if (@move_uploaded_file($_FILES["bg"]["tmp_name"], $target_file)) {
                $sql = "INSERT INTO `filmek`(`nev`, `mufaj`, `info`, `hatter`) VALUES ('".$_POST['title']."','".$_POST['genre']."','".$_POST['info']."','".basename($_FILES["bg"]['name'])."')";
                $conn->query($sql);  
            }
              else {
                $uploadError = "Error";   
              } 
        }
    }elseif($_POST["type"] == "Series"){
        if(empty($_POST["title"])){
            $uploadError .= 'Please write down the title of the series!<br>';
        }
        if(empty($_POST["genre"])){
            $uploadError .= 'Please write down the genre of the series!<br>';
        }
        if(empty($_POST["info"])){
            $uploadError .= 'Please write down the information of the series!<br>';
        }
        if(empty($_FILES["bg"]['name'])){
            $uploadError .= 'Please choose a background for the series!<br>';
        }else{
            $allowed_filetypes = array('image/png', 'image/jpg','image/jpeg');
            if (!in_array($_FILES["bg"]["type"], $allowed_filetypes) ) {
                $uploadError = "The file you want to upload is not an image!";
              }
        }
        if($uploadError == ''){
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["bg"]['name']);
            if (@move_uploaded_file($_FILES["bg"]["tmp_name"], $target_file)) {
                $sql = "INSERT INTO `sorozatok`(`nev`, `mufaj`, `info`, `hatter`) VALUES ('".$_POST['title']."','".$_POST['genre']."','".$_POST['info']."','".basename($_FILES["bg"]['name'])."')";
                $conn->query($sql);  
            }
              else {
                $uploadError = "Error";   
              } 
        }
    }elseif($_POST["type"] == "Actor/actress"){
        if(empty($_POST["name"])){
            $uploadError .= 'Please write down the name of the actor or actress!<br>';
        }
        if(empty($_POST["gender"])){
            $uploadError .= 'Please write down the genre of the actor or actress!<br>';
        }
        if(empty($_POST["ainfo"])){
            $uploadError .= 'Please write down the information of the actor or actress!<br>';
        }
        if(empty($_FILES["abg"]['name'])){
            $uploadError .= 'Please choose a background for the actor or actress!<br>';
        }else{
            $allowed_filetypes = array('image/png', 'image/jpg','image/jpeg');
            if (!in_array($_FILES["abg"]["type"], $allowed_filetypes) ) {
                $uploadError = "The file you want to upload is not an image!";
              }
        }
        if($uploadError == ''){
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["abg"]['name']);
            if (@move_uploaded_file($_FILES["abg"]["tmp_name"], $target_file)) {
                $sql = "INSERT INTO `szineszek`(`nev`, `nem`, `info`, `hatter`) VALUES ('".$_POST['name']."','".$_POST['gender']."','".$_POST['ainfo']."','".basename($_FILES["abg"]['name'])."')";
                $conn->query($sql);  
            }
              else {
                $uploadError = "Error";   
              } 
        }
    }
}

include "view/upload.php";

?>
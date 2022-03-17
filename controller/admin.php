<?php 
$error = '';
if(isset($_SESSION['id'])){
    $felhasznalo -> set_user($_SESSION['id'], $conn);
    if($felhasznalo -> get_permission() < 3){
        header('location: index.php?page=page');
        exit();
    }
}else{
    header('location: index.php?page=page');
    exit();
}

if(isset($_POST['admin'])){
    if($_POST['felhasznalo'] == 0){
        $error .= 'Please choose a user<br>';
    }
    if($_POST['permission'] == 0){
        $error .= 'Please choose a permission<br>';
    }
    if($error == ''){
        $sql = "SELECT id FROM adminok WHERE id=".$_POST['felhasznalo']."";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $sql = "UPDATE adminok SET permission =".$_POST['permission']." WHERE id=".$_POST['felhasznalo']."";
            $conn->query($sql);
        }else{
            $sql = "INSERT INTO adminok (id, permission) VALUES (".$_POST['felhasznalo'].",".$_POST['permission'].")";
            $conn->query($sql);
        }
    }
}

if(isset($_POST['remove'])){
    if($_POST['removeadmin'] == 0){
        $error .= 'Please choose a user<br>';
    }
    if($error == ''){
        $sql = "DELETE FROM adminok WHERE id=".$_POST['removeadmin']."";
        $conn->query($sql);
    }
}
include "view/admin.php";

?>
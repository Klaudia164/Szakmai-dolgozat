<?php

if(!isset($_SESSION['id'])){
    header('Location: index.php?page=login');
    exit();
}


include "view/series.php";

?>
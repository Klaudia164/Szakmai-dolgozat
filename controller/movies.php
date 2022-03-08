<?php

if(isset($_POST['comment'])){
    $movies -> komment($_POST['comment'], $conn);
}

include "view/movies.php";

?>
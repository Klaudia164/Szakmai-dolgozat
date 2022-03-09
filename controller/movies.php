<?php

if(isset($_POST['comment'])){
    $movies -> komment($_POST['comment'], $_REQUEST['movieId'], $conn);
    unset($_POST['comment']);
}

include "view/movies.php";

?>
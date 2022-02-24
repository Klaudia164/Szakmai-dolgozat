<?php
if(!isset($_REQUEST["movieId"])){
    echo "<body class='page'>";
    foreach($movieList as $mId){
    $movies -> set_movie($mId, $conn);
    echo '<p><a href ="index.php?page=movies&movieId='.$mId.'">' .$movies -> get_nev().'</a></p>';
    }
} else {
    echo '<body style="background-image: url(images/'.$movies -> get_hatter().'); >';
    $movies -> set_movie($_REQUEST["movieId"], $conn);
    echo '<h1>' .$movies -> get_nev().'</h1>';
    echo '<p>' .$movies -> get_mufaj().'</p>';
    echo '<p>' .$movies -> get_info().'</p>';
    
}


?>
</body>
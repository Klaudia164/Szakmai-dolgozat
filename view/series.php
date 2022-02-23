<body class="page">
<?php
if(!isset($_REQUEST["seriesId"])){

    foreach($seriesList as $sId){
    $series -> set_series($sId, $conn);
    echo '<p><a href ="index.php?page=series&seriesId='.$sId.'">' .$series -> get_nev().'</a></p>';
    }
} else {
    $series -> set_series($_REQUEST["seriesId"], $conn);
    echo '<h1>' .$series -> get_nev().'</h1>';
    echo '<p>' .$series -> get_mufaj().'</p>';
    echo '<p>' .$series -> get_info().'</p>';
}


?>
</body>
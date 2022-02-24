<body class="page">
<?php
if(!isset($_REQUEST["actorsId"])){

    foreach($actorsList as $aId){
    $actors -> set_actors($aId, $conn);
    echo '<p><a href ="index.php?page=actors&actorsId='.$aId.'">' .$actors -> get_nev().'</a></p>';
    }
} else {
    $actors -> set_actors($_REQUEST["actorsId"], $conn);
    echo '<h1>' .$actors -> get_nev().'</h1>';
    echo '<p>' .$actors -> get_nem().'</p>';
    echo '<p>' .$actors -> get_info().'</p>';
}


?>
</body>
<h1>Request</h1>
<!-- Requests form létrehozása-->
<form method="post">
    <select name="request_type" class="select" id="type" onchange="type_change()">
        <option value="0"> Select type </option>
        <option value="Movie">Movie</option>
        <option value="Series">Series</option>
        <option value="Actor/actress">Actor/actress</option>
    </select>
    <?php 
    if(isset($_REQUEST['movieId']) || isset($_REQUEST['seriesId']) || isset($_REQUEST['actorsId'])){
    ?>
    <input type="submit" value="Accept" name="accept" class="submitupload">
    <input type="submit" value="Decline" name="decline" class="submitupload">
    <?php
    }
    ?>
</form>

<div id="series">
<?php
//A Requests-ben lévő adatok megjelenítése 
if(!isset($_REQUEST["seriesId"])){

    foreach($sList as $sId){

    $series -> set_series($sId, $conn);

    echo '<p><a href ="index.php?page=requests&seriesId='.$sId.'">' .$series -> get_nev().'</a></p>';

    }

} else {

    $series -> set_series($_REQUEST["seriesId"], $conn);

    ?>

    <div style='background-image: url(images/<?= $series -> get_hatter() ?>);background-repeat: no-repeat; background-attachment: scroll; background-size: cover; height: 50em; margin-top: 0;'>

        <?php

        echo '<h1 class="cim">' .$series -> get_nev().'</h1>';

        ?>

        </div>

    <div class="feloldal">

    <?php

    echo '<p>' .$series -> get_mufaj().'</p>';

    echo '<div class="info">' .$series -> get_info().'</div>';
}
?> 
</div>
</div>

<div id="movie">
<?php

if(!isset($_REQUEST["movieId"])){

    foreach($mList as $mId){

    $movies -> set_movie($mId, $conn);

    echo '<p><a href ="index.php?page=requests&movieId='.$mId.'">' .$movies -> get_nev().'</a></p>';

    }

} else {

    $movies -> set_movie($_REQUEST["movieId"], $conn);

    ?>

    <div style='background-image: url(images/<?= $movies -> get_hatter() ?>);background-repeat: no-repeat; background-attachment: scroll; background-size: cover; height: 50em; margin-top: 0;'>

        <?php

        echo '<h1 class="cim">' .$movies -> get_nev().'</h1>';

        ?>

        </div>

    <div class="feloldal">

    <?php

    echo '<p>' .$movies -> get_mufaj().'</p>';

    echo '<div class="info">' .$movies -> get_info().'</div>';
}
?>
</div>
</div>

<div id="actors">
    <?php
if(!isset($_REQUEST["actorsId"])){

foreach($aList as $aId){

$actors -> set_actors($aId, $conn);

echo '<p><a href ="index.php?page=requests&actorsId='.$aId.'">' .$actors -> get_nev().'</a></p>';

}

} else {

$actors -> set_actors($_REQUEST["actorsId"], $conn);

?>

<div style='background-image: url(images/<?= $actors -> get_hatter() ?>);background-repeat: no-repeat; background-attachment: scroll; background-size: cover; height: 50em; margin-top: 0;'>

    <?php

    echo '<h1 class="cim">' .$actors -> get_nev().'</h1>';

    ?>

    </div>

<div class="feloldal">

<?php

echo '<p>' .$actors -> get_nem().'</p>';

echo '<div class="info">' .$actors -> get_info().'</div>';

}
?>
</div>
</div>

<script>
    
<?php 
        if(isset($_REQUEST['movieId']) || (isset($_REQUEST['action']) && $_REQUEST['action'] == "movie") ){
            ?>
            document.getElementById("type").value="Movie";
            Movie();
            <?php
        }elseif(isset($_REQUEST['seriesId']) || (isset($_REQUEST['action']) && $_REQUEST['action'] == "series") ){
            ?>
            document.getElementById("type").value="Series";
            Series();
            <?php
        }elseif(isset($_REQUEST['actorsId']) || (isset($_REQUEST['action']) && $_REQUEST['action'] == "actors") ){
            ?>
            document.getElementById("type").value="Actor/actress";
            Actors();
            <?php
        }else{
            ?>
            document.getElementById("type").value="0";
            None();
            <?php
        }
    ?>

    function type_change(){

        var type = document.getElementById("type").value;

        if(type == "Movie"){

            location.href="index.php?page=requests&action=movie";

        }else if(type == "Actor/actress"){

            location.href="index.php?page=requests&action=actors";

        }else if(type == "Series"){

            location.href="index.php?page=requests&action=series";

        }else{

            location.href="index.php?page=requests";

        }
    }

    function Movie(){
        document.getElementById("movie").style.display = "block";

        document.getElementById("actors").style.display = "none";

        document.getElementById("series").style.display = "none";
    }

    function Actors(){
        document.getElementById("actors").style.display = "block";

        document.getElementById("movie").style.display = "none";

        document.getElementById("series").style.display = "none";
    }

    function Series(){
        document.getElementById("series").style.display = "block";

        document.getElementById("movie").style.display = "none";

        document.getElementById("actors").style.display = "none";
    }
    function None(){
        document.getElementById("actors").style.display = "none";

        document.getElementById("movie").style.display = "none";

        document.getElementById("series").style.display = "none";
    }

</script>
<?php



session_start();



require 'includes/db.php';

require 'model/felhasznalok.php';

require 'model/movies.php';

require 'model/series.php';

require 'model/actors.php';



$felhasznalo = new felhasznalok();

$movies = new Movies();

$movieList = $movies -> filmekListaja($conn);



$series = new Series();

$seriesList = $series -> sorozatokListaja($conn);



$actors = new Actors();

$actorsList = $actors -> szineszekListaja($conn);

// default page

$page = 'page';



// kilépés végrehajtása
if(!empty($_REQUEST['action'])) {

	if($_REQUEST['action'] == 'logout') session_unset();

}



if(isset($_REQUEST['page'])) {

        if(file_exists('controller/'.$_REQUEST['page'].'.php')) {

                $page = $_REQUEST['page']; 

        }

}



$menupontok = array(    'page' => "<span class='bi bi-house'></span> Main", 

                        'movies' => "<span class='bi bi-film'></span> Movies",

                        'actors' => "<span class='bi bi-person-video2'></span> Actors",

                        'series' => "<span class='bi bi-film forgat'></span> Tv shows",

                        'upload' => "<span class='bi bi-upload'></span> Upload",

                        'admin' => "<span class='bi bi-person-lines-fill'></span> Admin",

                        'requests' => "<span class='bi bi-archive'></span> Requests",

                        'login' => "<span class='bi bi-box-arrow-in-right'></span> Login",

                        'regisztracio' => "<span class='bi bi-person-plus'></span> Register",

                );



$title = $menupontok[$page];



include 'includes/htmlheader.php';

if(!isset($_REQUEST["movieId"]) || !isset($_REQUEST["actorsId"]) || !isset($_REQUEST["seriesId"])){
        echo "<body class='page'>";
}else{
        ?>

                <body>

        <?php
}


include 'includes/menu.php';

include 'controller/'.$page.'.php';
?>

</body>
</html>
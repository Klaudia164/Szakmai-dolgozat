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

// router
if(isset($_REQUEST['page'])) {
        if(file_exists('controller/'.$_REQUEST['page'].'.php')) {
                $page = $_REQUEST['page']; 
        }
}

$menupontok = array(    'page' => "<span class='bi bi-house'></span> Main", 
                        'movies' => "<span class='bi bi-film'></span> Movies",
                        'actors' => "<span class='bi bi-people'></span> Actors",
                        'series' => "<span class='bi bi-film forgat'></span> Tv shows",
                        'login' => "<span class='bi bi-box-arrow-in-right'></span> Login",
                        'regisztracio' => "<span class='bi bi-person-plus'></span> Register",
                );

$title = $menupontok[$page];

include 'includes/htmlheader.php';
?>
<body>
<?php

include 'includes/menu.php';
include 'controller/'.$page.'.php';

?>
</body>
</html>
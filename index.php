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
                        'actors' => "<span class='bi bi-person-video2'></span> Actors",
                        'series' => "<span class='bi bi-film forgat'></span> Tv shows",
                        'admin' => "<span class='bi bi-person-lines-fill'></span> Admin",
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
<!--<audio id="audiotag1" preload="auto" ><source src="audio/nggyu.mp3" type="audio/mpeg"></audio>
<h3></h3>
<a href="javascript:play_single_sound();" class="audio">Play this song ;)</a>
<script type="text/javascript">
    function play_single_sound() {
        document.getElementById('audiotag1').volume=0.1;
        document.getElementById('audiotag1').play();
    }
    </script>-->
</body>
</html>
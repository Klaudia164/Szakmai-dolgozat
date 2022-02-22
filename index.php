<?php

session_start();

require 'includes/db.php';
require 'model/felhasznalok.php';
require 'model/movies.php';
$felhasznalo = new felhasznalok();
$movies = new movies();
$movieList = $movies -> filmekListaja($conn);

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

$menupontok = array(    'page' => "Main", 
                        'login' => "Login",
                        'regisztracio' => "Register",
                        'movies' => "Movies",
                        'actors' => "Actors",
                        'series' => "Tv shows",
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
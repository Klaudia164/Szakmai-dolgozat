<?php

session_start();

//require 'includes/db.php';
require 'model/felhasznalok.php';
$felhasznalo = new felhasznalok();

// default page
$page = 'page';

// kilépés végrehajtása
if(!empty($_REQUEST['action'])) {
	if($_REQUEST['action'] == 'kilepes') session_unset();
}

// ki vagy be vagyok lépve?
if(!empty($_SESSION["id"])) {
        $szoveg = $_SESSION["nev"].": Kilépés";
        $action = "kilepes";
}
else {
        $szoveg = "Belépés";
        $action = "belepes";        
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
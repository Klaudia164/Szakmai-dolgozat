<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
      <?php
      
        foreach($menupontok as $key => $value) {
            $active = '';
            if($_SERVER['REQUEST_URI'] == '/klaudia/szakdolgozat/'.$key) $active = ' active';

            if($key == 'login' || $key == 'regisztracio'){
              if(!isset($_SESSION['id'])){
                ?>
                  <li class="nav-item<?php echo $active; ?>">
                    <a class="nav-link" href="index.php?page=<?php echo $key; ?>"><?php echo $value; ?></a>
                  </li>
                <?php
              }
            }else{
              if($key == 'admin'){
                if(isset($_SESSION['id'])){
                  $felhasznalo -> set_user($_SESSION['id'], $conn);
                  if($felhasznalo -> get_permission() > 2){
                    ?>
                      <li class="nav-item<?php echo $active; ?>">
                        <a class="nav-link" href="index.php?page=<?php echo $key; ?>"><?php echo $value; ?></a>
                      </li>
                    <?php
                  }
                }
              }else{
                ?>
                <li class="nav-item<?php echo $active; ?>">
                  <a class="nav-link" href="index.php?page=<?php echo $key; ?>"><?php echo $value; ?></a>
                </li>
                <?php
              }
            }           
        }
        if(isset($_SESSION['id'])){
          ?>
              <li class="nav-item">
                <a class="nav-link" href="index.php?action=logout"><span class="bi bi-box-arrow-left"></span> Logout: <?php echo $_SESSION["felhasznalonev"]; ?></a>
              </li>
            <?php
        } 
        ?>
        </ul>
    </div>
      <?php
      if( isset($_REQUEST['page']) && ( ($_REQUEST['page'] == "movies" && empty($_REQUEST['movieId'])) || ($_REQUEST['page'] == "actors"  && empty($_REQUEST['actorsId'])) || ($_REQUEST['page'] == "series" && empty($_REQUEST['seriesId'])))){
        
        ?>
    
    <form class="d-flex keres" method = "post">
      <input class="sch" type="search" name="search" aria-label="Search">
    </form>
      
    <?php
      }
      ?>
</nav>
<nav class="navbar navbar-expand-lg navbar-dark shadow">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
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
            }elseif($key == 'movies' || $key == 'actors' || $key == 'series'){
              if(isset($_SESSION['id'])){
              ?>
              <li class="nav-item<?php echo $active; ?>">
                  <a class="nav-link" href="index.php?page=<?php echo $key; ?>"><?php echo $value; ?></a>
              </li>
              <?php
              }
            }else{
            ?>
            <li class="nav-item<?php echo $active; ?>">
                <a class="nav-link" href="index.php?page=<?php echo $key; ?>"><?php echo $value; ?></a>
            </li>
            <?php
           
            }           
        }
        if(isset($_SESSION['id'])){
          ?>
              <li class="nav-item">
                <a class="nav-link" href="index.php?action=logout">Logout: <?php echo $_SESSION["felhasznalonev"]; ?></a>
              </li>
            <?php
        } 

      ?>
    </ul>
  </div>
</nav>
<div>
    <h2>Login</h2>
    <p>Töltsd ki a mezőket, hogy belépj.</p>

    <?php 
    if(!empty($loginError)){
        echo '<div class="alert alert-danger">' . $loginError . '</div>';
    }        
    ?>

    <form action="index.php?page=login" method="post" class="row g-3">
    <div class="form-group col-md-3">
        <label>Felhasználónév</label>
        <input type="text" name="user" class="form-control">
    </div>    
    <div class="form-group col-auto">
        <label>Jelszó</label>
        <input type="password" name="pw" class="form-control">
    </div>
    <div class="form-group col-auto">
        <input type="submit" class="btn btn-primary" value="Login">
    </div>
    <p>Még nincs felhasználód? <a href="regisztracio.php">Regisztrálj itt</a>.</p>
    </form>
</div>
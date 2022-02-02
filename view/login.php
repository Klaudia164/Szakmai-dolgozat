<div>
    <h2>Login</h2>
    <p>Fill out the fields to login.</p>

    <?php 
    if(!empty($loginError)){
        echo '<div class="alert alert-danger">' . $loginError . '</div>';
    }        
    ?>

    <form action="index.php?page=login" method="post" class="row g-3">
    <div class="form-group col-md-3">
        <label>Username</label>
        <input type="text" name="user" class="form-control">
    </div>    
    <div class="form-group col-auto">
        <label>Password</label>
        <input type="password" name="pw" class="form-control">
    </div>
    <div class="form-group col-auto">
        <input type="submit" class="btn btn-primary" value="Login">
    </div>
    <p>Not registerd yet? <a href="index.php?page=regisztracio">Register here.</a>.</p>
    </form>
</div>
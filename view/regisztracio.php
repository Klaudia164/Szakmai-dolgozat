<?php
require_once "includes/db.php";
 
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Írj be egy felhasználónevet.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "A felhasználónévben csak betűk, számok, és alsóvonal használható.";
    } else{

        $sql = "SELECT id FROM felhasznalok WHERE felhasznalonev = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){

            mysqli_stmt_bind_param($stmt, "s", $param_username);
            

            $param_username = trim($_POST["username"]);
            

            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Ez a felhasználónév már foglalt.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Sajnos valami baj történt. Légyszives próbálkozz meg újra később.";
            }


            mysqli_stmt_close($stmt);
        }
    }
    

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "A jelszó legalább 6 betűs kell hogy legyen.";
    } else{
        $password = trim($_POST["password"]);
    }
    

    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Légyszives ismételd meg a jelszavat.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "A két jelszó nem egyezik.";
        }
    }
    

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        

        $sql = "INSERT INTO felhasznalok (felhasznalonev, jelszo) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){

            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            

            $param_username = $username;
            $param_password = md5($password); // Creates a password hash
            

            if(mysqli_stmt_execute($stmt)){

                header("location: page.php");
            } else{
                echo "Sajnos valami baj történt. Légyszives próbálkozz meg újra később.";
            }


            mysqli_stmt_close($stmt);
        }
    }
    
    
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Regisztráció</h2>
        <p>Légyszives töltsd ki a mezőket, hogy létrehozz egy felhasználót.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Felhasználónév</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Jelszó</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Jelszó újra</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Már van felhasználód? <a href="login.php">Bejelentkezés</a>.</p>
        </form>
    </div>    
</body>
</html>
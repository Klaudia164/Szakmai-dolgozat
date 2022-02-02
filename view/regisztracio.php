<?php
//require_once "includes/db.php";
 
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Please pick a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Only letters, numbers, and underscores can be used in the username.";
    } else{

        $sql = "SELECT id FROM felhasznalok WHERE felhasznalonev = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){

            mysqli_stmt_bind_param($stmt, "s", $param_username);
            

            $param_username = trim($_POST["username"]);
            

            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Error. Please try again later.";
            }


            mysqli_stmt_close($stmt);
        }
    }
    

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must be at least 6 letters long.";
    } else{
        $password = trim($_POST["password"]);
    }
    

    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm your password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "The two passwords do not match.";
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
                echo "Error. Please try again later.";
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
        <h2>Register</h2>
        <p>Please fill out the fields to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already registered? <a href="login.php">Sign in</a>.</p>
        </form>
    </div>    
</body>
</html>
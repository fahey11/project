<?php
    require_once 'database.php';
    $username = $password = "";
    $username_err = $password_err = "";
    //Checks if all variables are valid for logging into account securely
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["username"]))){
            $username_err = 'Please enter username.';
        }else{
            $username = trim($_POST["username"]);
        }
        if(empty(trim($_POST['password']))){
            $password_err = 'Please enter your password.';
        }else{
            $password = trim($_POST['password']);
        }
        if(empty($username_err) && empty($password_err)){
            $sql = "SELECT username, password FROM users WHERE username = ?";
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                $param_username = $username;
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1){                    
                        mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($password, $hashed_password)){
                                session_start();
                                $_SESSION['username'] = $username;
                                header("location: welcome.php");
                            }else{
                                $password_err = 'The password you entered was not valid.';
                            }
                        }
                    }else{
                        $username_err = 'No account found with that username.';
                    }
                }else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($link);
    }
?>

<!DOCTYPE html>
<html>

<!--Scripts-->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://fahey11.000webhostapp.com/project/js/java.js"></script>
    <script> 
        $(function(){
            $("#header").load("https://fahey11.000webhostapp.com/project/html/headerin.php"); 
        });
    </script> 
    <script> 
        $(function(){
            $("#footer").load("https://fahey11.000webhostapp.com/project/html/footer.html"); 
        });
    </script> 
</head>

<div id="header"></div>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://fahey11.000webhostapp.com/project/css/style.css">
</head>

<!--Fields for variables to be entered into-->
<body>
    <h2 class="header">Login</h2>
    <p>Please fill in your credentials to login.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="margbot <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <label>Username</label>
        <input type="text" name="username" class="reformed" value="<?php echo $username; ?>">
        <span class="aid"><?php echo $username_err; ?></span>
    </div>    
    <div class="margbot <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <label>Password</label>
        <input type="password" name="password" class="reformed">
        <span class="aid"><?php echo $password_err; ?></span>
    </div>
    <div class="margbot">
        <input type="submit" class="button" value="Login">
    </div>
    <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
    </form>
    </div>    
</body>

<div id="footer"></div>

</html>
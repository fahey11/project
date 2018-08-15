<?php
    require_once 'database.php';
    $username = "";
    $password = "";
    $confirm_password = "";
    $email = "";
    $account = "0";
    $username_err = "";
    $password_err = "";
    $confirm_password_err = "";
    $email_err = "";
    $account_err = "";
    //Creates new users(applicants and managers) if no errors and all fields valid
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter a username.";
        }else{
            $sql = "SELECT id FROM users WHERE username = ?";
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                $param_username = trim($_POST["username"]);
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $username_err = "This username is already taken.";
                    }else{
                        $username = trim($_POST["username"]);
                    }
                }else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            mysqli_stmt_close($stmt);
        }
        if(empty(trim($_POST['password']))){
            $password_err = "Please enter a password.";     
        }else{
            $password = trim($_POST['password']);
        }
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = 'Please confirm password.';     
        }else{
            $confirm_password = trim($_POST['confirm_password']);
            if($password != $confirm_password){
                $confirm_password_err = 'Password did not match.';
            }
        }
        if(empty(trim($_POST['email']))){
            $email_err = "Please enter a valid email.";     
        }else{
                $email = trim($_POST['email']);
        }
        if(empty(trim($_POST['account']))){
            $account_err = "Please select a type of account.";     
        }else{
            $account = trim($_POST['account']);
        }
        if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($account_err)){
            $sql = "INSERT INTO users (username, password, email, account) VALUES (?, ?, ?, ?)";
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_password, $param_email, $param_account);
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                $param_email = $email;
                $param_account = $account;
                if(mysqli_stmt_execute($stmt)){
                    header("location: login.php");
                }else{
                    echo "Something went wrong. Please try again later.";
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://fahey11.000webhostapp.com/project/css/style.css">
</head>

<!--Fields for inputting variables-->
<body>
        <h2 class="header">Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="margbot <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username"class="reformed" value="<?php echo $username; ?>">
                <span class="aid"><?php echo $username_err; ?></span>
            </div>    
            <div class="margbot <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="reformed" value="<?php echo $password; ?>">
                <span class="aid"><?php echo $password_err; ?></span>
            </div>
            <div class="margbot <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="reformed" value="<?php echo $confirm_password; ?>">
                <span class="aid"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="margbot <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="reformed" value="<?php echo $email; ?>">
                <span class="aid"><?php echo $email_err; ?></span>
            </div>
            <div class="margbot <?php echo (!empty($account_err)) ? 'has-error' : ''; ?>">
                <label>Account Type</label>
                <br>
                <input type="radio" name="account" value="1" checked="checked">Applicant
                <input type="radio" name="account" value="2">Manager
            </div>
            <div class="margbot">
                <input type="submit" class="button" value="Submit">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>

<div id="footer"></div>

</html>
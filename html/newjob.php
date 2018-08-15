<?php
    require_once 'database.php';
    session_start();
    if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
        header("location: login.php");
        exit;
    }
    $job_name = "";
    $job_city = "";
    $job_desc = "";
    $job_name_err = "";
    $job_city_err = "";
    $job_desc_err = "";

    //Creates new job opening for manager + error checks
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["job_name"]))){
            $username_err = "Please enter a job name.";
        }else{
            $sql = "SELECT id FROM job WHERE job_name = ?";
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_job_name);
                $param_job_name = trim($_POST["job_name"]);
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $job_name_err = "This job name is already taken.";
                    }else{
                        $job_name = trim($_POST["job_name"]);
                    }
                }else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            mysqli_stmt_close($stmt);
        }
        if(empty(trim($_POST['job_city']))){
                $job_city_err = "Please enter a city.";     
        }else{
            $job_city = trim($_POST['job_city']);
        }
        if(empty(trim($_POST['job_desc']))){
            $job_desc_err = "Please enter a valid description.";     
        }else{
            $job_desc = trim($_POST['job_desc']);
        }
        if(empty($job_name_err) && empty($job_city_err) && empty($job_desc_err)){
            $sql = "INSERT INTO job (username, job_name, job_city, job_desc) VALUES (?, ?, ?, ?)";
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_job_name, $param_job_city, $param_job_desc);
                $param_username = $_SESSION['username'];
                $param_job_name = $job_name;
                $param_job_city = $job_city;
                $param_job_desc = $job_desc;
                if(mysqli_stmt_execute($stmt)){
                    header("location: manager.php");
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
            $("#header").load("https://fahey11.000webhostapp.com/project/html/headerout.php"); 
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
    <title>New Job</title>
    <link rel="stylesheet" href="https://fahey11.000webhostapp.com/project/css/style.css">
</head>

<!--Input Fields for variables-->
<body>
        <h2 class="header">Sign Up</h2>
        <p>Please fill this form to create a new job</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="margbot <?php echo (!empty($job_name_err)) ? 'has-error' : ''; ?>">
                <label>Job Name</label>
                <input type="text" name="job_name"class="reformed" value="<?php echo $job_name; ?>">
                <span class="aid"><?php echo $job_name_err; ?></span>
            </div>    
            <div class="margbot <?php echo (!empty($job_city_err)) ? 'has-error' : ''; ?>">
                <label>Job City</label>
                <input type="text" name="job_city" class="reformed" value="<?php echo $job_city; ?>">
                <span class="aid"><?php echo $job_city_err; ?></span>
            </div>
            <div class="margbot <?php echo (!empty($job_desc_err)) ? 'has-error' : ''; ?>">
                <label>Job Description</label>
                <input type="text" name="job_desc" class="reformed" value="<?php echo $job_desc; ?>">
                <span class="aid"><?php echo $job_desc_err; ?></span>
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
<?php
    require_once 'database.php';
    session_start();
    if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
        header("location: login.php");
        exit;
    }
    //Creates new application
    $sql = "INSERT INTO applications (job_name, username) VALUES ('".$_SESSION['job_name']."', '".$_SESSION['username']."');";
    if (!$link->query($sql) === TRUE) {
        echo "Error: " . $sql . "<br>" . $link->error;
    }
    //Adds to application count
    $sql2 = "UPDATE job SET app_count = app_count+1 WHERE job_name = '".$_SESSION['job_name']."'";
    if (!$link->query($sql2) === TRUE) {
        echo "Error: " . $sql2 . "<br>" . $link->error;
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
    <title>Welcome</title>
    <link rel="stylesheet" href="https://fahey11.000webhostapp.com/project/css/style.css">
</head>

<body>
    <h1 class="header">Application Successfully Sent.</h1>
    <br>
    <?php
        echo "<p><a href='applicant.php' class='btn btn-danger'>Head to Applicant Site</a></p>";
    ?>
    <div id="footer"></div>
</body>

</html>
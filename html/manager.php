<?php
    require_once 'database.php';
    session_start();
    if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
        header("location: login.php");
        exit;
    }
?>
 
<!DOCTYPE html>
<html lang="en">

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

<h1 class="header">Manage your Openings Here</h1>

<br>
    
<?php
    $username = $_SESSION['username'];
    //Shows all job openings for current manager logged in
    $sql = "SELECT job_name, job_city, job_desc, app_count FROM job WHERE username = '".$username."'";
    $result = $link->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "Name: ".$row["job_name"]."<br>";
            echo "City: ".$row["job_city"]."<br>";
            echo "Description: ".$row["job_desc"]."<br>";
            echo "Application Counter: ".$row["app_count"]."<br><br>";
         }
    }
    echo "<p><a href='newjob.php' class='button'>add new job</a></p>"; 
?>
    
<div id="footer"></div>
    
</body>
</html>
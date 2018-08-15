<?php
    require_once 'database.php';
    session_start();
    if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
        header("location: login.php");
        exit;
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

<body>
    <h1 class="header">Applicant site</h1>
<?php
    $applicant = $_SESSION['username'];
    //Finds and displays all job openings
    $sql = "SELECT username, job_name, job_city, job_desc FROM job WHERE 1";
    $result = $link->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "Manager: ".$row["username"]."<br>";
            echo "Name: ".$row["job_name"]."<br>";
            echo "City: ".$row["job_city"]."<br>";
            echo "Description: ".$row["job_desc"]."<br>";
            $_SESSION["job_name"] = $row["job_name"];
            echo "<form action='application.php'><input type='submit' value='Submit'></form><br><br>";
        }
    }
?>
</body>
  
<div id="footer"></div>

</html>
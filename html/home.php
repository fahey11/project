<!DOCTYPE html>
<html>
    
<?php  require_once 'database.php';
?> 

<!--Scripts-->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fahey11.000webhostapp.com/project/css/style.css">
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

<!--Shows two most popular jobs-->
<body>
    <h1 class="header">Hottest Jobs</h1>
    <br>
    <?php
        $counter = 0;  
        $sql = "SELECT job_name, job_city, job_desc, app_count FROM job WHERE 1";
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $row = $result->fetch_assoc();
            echo "Name: ".$row["job_name"]."<br>";
            echo "City: ".$row["job_city"]."<br>";
            echo "Description: ".$row["job_desc"]."<br>";
            echo "Application Counter: ".$row["app_count"]."<br><br>";
            $row = $result->fetch_assoc();
            echo "Name: ".$row["job_name"]."<br>";
            echo "City: ".$row["job_city"]."<br>";
            echo "Description: ".$row["job_desc"]."<br>";
            echo "Application Counter: ".$row["app_count"]."<br><br>";
        }
    ?>
</body>

<div id="footer"></div>

</html>
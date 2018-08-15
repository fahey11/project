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

<body>
    <h1 class="header">Analytics</h1>
    <br>
    <?php
        $jobs = 0;    
        $man = 0;
        $counter = 0;
        $app = 0;
        //Checks how many managers and applicants
        $sql = "SELECT account FROM users WHERE 1"; 
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                if($row["account"] == 1){
                    $app++;
                }else{
                    $man++;
                }           
            }
        }
        //Checks how many applications and jobs
        $sql = "SELECT app_count FROM job WHERE 1";
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $jobs++;
                $counter +=$row["app_count"];
            }
        }
        echo "<table class='table'><tr><th>Data</th><th>Score</th></tr><tr><td>Managers</td><td>".$man."</td> </tr><tr><td>Openings</td><td>".$jobs."</td> </tr><tr><td>Applicants</td><td>".$app."</td> </tr><tr><td>Applications</td><td>".$counter."</td></tr></table>";
    ?>
</body>

<div id="footer"></div>

</html>
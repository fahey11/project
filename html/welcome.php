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

<!--Checks if manager or applicant, then provides link to appropriote site-->
<body>
    <h1 class="header">Hello, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>. Welcome to our site.</h1>
    <br>
    <?php
        $username = $_SESSION['username'];
        $sql = "SELECT username, account FROM users WHERE username = '".$username."'";
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row["account"] == 1){
                    echo "<p><a href='applicant.php' class='button'>Head to Applicant Site</a></p>";
                }elseif($row["account"] == 2){
                    echo "<p><a href='manager.php' class='button'>Head to Manager Site</a></p>";
                }
            }
        }
    ?>
    
<div id="footer"></div>
    
</body>
</html>
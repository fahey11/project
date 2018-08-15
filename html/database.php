<?php
    //Reusuable Code used to log into database
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'id6794161_admin');
    define('DB_PASSWORD', 'pass123');
    define('DB_NAME', 'id6794161_project');
    
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>
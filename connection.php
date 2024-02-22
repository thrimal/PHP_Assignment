<?php 
    $servername = "localhost";
    $username = "root"; //enter your mysql username
    $password = ""; //don't enter mysql password here because phpmyadmin doesn't require pw.
    $db_name = "assignment";  
    $conn = new mysqli($servername, $username, $password, $db_name, 3307); // configure your mysql port here.
    if($conn->connect_error){
        die("Connection failed".$conn->connect_error);
    }
    echo "";
    
    ?>
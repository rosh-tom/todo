<?php 
    require_once('config.php');
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if($conn->connect_error){
        die('Connection Failed. Error: '. $conn->connect_error);
    }

?>
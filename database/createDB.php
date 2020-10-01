<?php 

    require_once('config.php');
    $conn = new mysqli($servername, $username, $password); 
    if($conn->connect_error){
        die('Connection Failed. Error: '. $conn->connect_error);
    }
    $sqlQuery = "create database ". $dbname;

    if ($conn->query($sqlQuery) === true) {
        echo "Database Created";
    }else{
        echo "Failed. "; 
    }
    $conn->close();

?>
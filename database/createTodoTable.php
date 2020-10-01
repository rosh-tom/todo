<?php 

    require_once('connection.php');
    $tablename = 'tbl_todos';
    $sqlQuery = "create table ". $tablename ."(
        id int(6) unsigned auto_increment primary key,
        todo varchar(255) not null, 
        created_at timestamp default current_timestamp,
        updated_at timestamp default current_timestamp on update current_timestamp
    )";

    if($conn->query($sqlQuery)){
        echo $tablename ." is successfully created. ";
    }else{
        echo "failed creating table (". $tablename .") Error: ". $conn->error;
    }

    $conn->close(); 

?>
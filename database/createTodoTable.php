<?php 

    require_once('connection.php');
    $tablename = 'tbl_todos';
    $sqlQuery = "create table ". $tablename ."(
        id int(6) unsigned auto_increment primary key,
        user_id int(6) not null,
        todo varchar(255) not null, 
        status varchar(2) not null default '0',
        created_at timestamp default now(),
        updated_at timestamp default now() on update now()
    )";

    if($conn->query($sqlQuery)){
        echo $tablename ." is successfully created. ";
    }else{
        echo "failed creating table (". $tablename .") Error: ". $conn->error;
    } 
    $conn->close(); 
?>
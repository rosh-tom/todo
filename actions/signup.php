<?php 
    session_start();
    require_once('../database/connection.php');

    function passwordHash($password){
        return $password = password_hash($password, PASSWORD_DEFAULT);
    }

    if(isset($_POST['btn_signup'])){

        $data = [
            'firstname' =>  $_POST['firstname'],
            'lastname'  =>  $_POST['lastname'],
            'email'     =>  $_POST['email'],
            'password'  =>  $_POST['password'],
            'password_c'=>  $_POST['password_c']
        ]; 
        // $_SESSION['temp'] = $data; 

        if($data['password'] != $data['password_c']){
            $data['err_message'] = "Password did not match. ";
            $_SESSION['temp'] = $data;
            header("location: ../register.php"); 
        }else{
            $sqlQuery = "insert into tbl_users (
                firstname, lastname, email, password
                ) values (
                    '". $data['firstname'] ."', '". $data['lastname']."', '". $data['email'] ."', '". passwordHash($data['password']) ."'
                )";
            if($conn->query($sqlQuery) === true){ 
                $data['scs_message'] = "Account successfully created. ";
                unset($data['password']);
                unset($data['password_c']); 
                $_SESSION['temp'] = $data; 
                header("location: ../login.php");
            }else{
                $data['err_message'] = "Something went wrong. ERROR: ". $conn->error;
                $_SESSION['temp'] = $data;  
                header("location: ../register.php"); 
            }  
        } 
        
    }else{
        header("location: ../index.php");
    }


?>
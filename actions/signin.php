<?php 

    session_start();
    require_once('../database/connection.php');

    function passwordHash($password){
        return $password = password_hash($password, PASSWORD_DEFAULT);
    }

    if(isset($_POST['btn_signin'])){
        $data = [
            'email'     =>  $_POST['email'],
            'password'  =>  $_POST['password']
        ];
        $sqlQuery = "select * from tbl_users where email = '". $data['email'] ."'";
        $result = $conn->query($sqlQuery);

        if($result->num_rows > 0){

            $row = $result->fetch_assoc();

            if(password_verify($data['password'], $row['password'])){
                $_SESSION['isLoggedin'] = true;
                $_SESSION['id'] = $row['id'];
                header("location: ../home.php");
            }else{
                $data['err_message'] = "Password did not match the email. ";
                unset($data['password']);
                $_SESSION['temp'] = $data;
                header("location: ../login.php");
            }

        }else{ 
            $data['err_message'] = "Email not found in our database. ".  $conn->error;
            unset($data['email']);
            unset($data['password']);
            $_SESSION['temp'] = $data;  
            header("location: ../login.php");
        }
       
        
    }else{
        header("location: ../index.php");
    }


?>
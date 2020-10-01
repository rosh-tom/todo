<?php 

    session_start();
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);

    if($uri_segments[2] == 'home.php'){  

        if(!isset($_SESSION['isLoggedin'])){
            $data = [
                'err_message' => 'Please log in first'
            ];
            $_SESSION['temp'] = $data;
            header("location: login.php");
        }
    }elseif(
        $uri_segments[2] == 'login.php' or 
        $uri_segments[2] == 'index.php' or 
        $uri_segments[2] == 'register.php' or 
        $uri_segments[1] == 'todo'){

        if(isset($_SESSION['isLoggedin'])){ 
            header("location: home.php");
        }
    }


?>
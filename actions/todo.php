<?php 
    session_start();
    require_once('../database/connection.php');

    $received_data = json_decode(file_get_contents("php://input"));
     
        if($received_data->action == 'insert'){ 
            $todo =$received_data->txtTodo;

            $sqlQuery = "select * from tbl_todos where todo = '". $todo ."' and user_id =". $_SESSION['id'];
            $result = $conn->query($sqlQuery);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                if($row['status'] == '1'){
                    $data = array(
                        'err_message' => 'Already done! You can delete the done and add it again. '
                    );
                }else{
                    $data = array(
                        'err_message' => 'Already Exist!. '
                    ); 
                }  
                echo json_encode($data); 
            }else{
                $sqlQuery = "insert into tbl_todos (user_id, todo) values (". $_SESSION['id'] .", '". $todo ."')";

                if($conn->query($sqlQuery) === true){
                    $data = array(
                        'err_message' => 'good'
                    );
                }else{
                    $data = array(
                        'err_message' => 'bad'
                    );  
                }   
                echo json_encode($data); 
            } 
                
        }elseif($received_data->action == 'fetchAll'){
            $data = array();
            $sqlQuery = "select * from tbl_todos where user_id = ". $_SESSION['id'] ." and status = '0' order by created_at desc";
            $result = $conn->query($sqlQuery);

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $data [] = $row;
                }
            }else{
                $data [] = array(
                    'todo' => 'Empty'
                );
            } 
            echo json_encode($data); 
        }elseif($received_data->action == 'fetchSelected'){
            $id = $received_data->id;
            $sqlQuery = "select * from tbl_todos where id = ". $id;
            $result = $conn->query($sqlQuery);
            $row = $result->fetch_assoc();
            $data = array();
            $data['id'] = $row['id'];
            $data['todo'] = $row['todo'];
            echo json_encode($data); 
        }elseif($received_data->action == 'done'){
            $id = $received_data->id;
            $data = array();
            $sqlQuery = "update tbl_todos set status = '1' where id = ". $id;
            if($conn->query($sqlQuery)){
                $data['data'] = 'Deleted';
            }else{
                $data['data'] = 'Error';
            }
            echo json_encode($data); 

        }elseif($received_data->action == 'updateSingle'){
            $todo = $received_data->todo;
            $sqlQuery = "select * from tbl_todos where todo = '". $todo ."' and user_id =". $_SESSION['id'];
            $result = $conn->query($sqlQuery);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                if($row['status'] == '1'){
                    $data = array(
                        'message' => 'Already done! You can delete the done and add it again. '
                    );
                }else{
                    $data = array(
                        'message' => 'Already Exist!. '
                    );
                } 
                echo json_encode($data);
            }else{ 
                $todo = $received_data->todo;
                $id = $received_data->id;
                $data = array();
                $sqlQuery = "update tbl_todos set todo = '". $todo ."' where id =". $id;
                if($conn->query($sqlQuery)){
                    $data['message'] = 'Good';
                }else{
                    $data['message'] = 'Error';
                }
                 
                echo json_encode($data);
            } 
        }
      
?>
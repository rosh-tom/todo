<?php 
    require_once('../database/connection.php');

    $received_data = json_decode(file_get_contents("php://input"));
     
        if($received_data->action == 'insert'){ 
            $todo =$received_data->txtTodo;
            $sqlQuery = "insert into tbl_todos (todo) values ('". $todo ."')";

            if($conn->query($sqlQuery) === true){
                $data = array(
                    'message' => 'success'
                );
            }else{
                $data = array(
                    'message' => 'bad'
                );
            }  
            echo json_encode($data); 
        }elseif($received_data->action == 'fetchAll'){
            $data = array();
            $sqlQuery = "select * from tbl_todos order by created_at desc";
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
            $sqlQuery = "delete from tbl_todos where id = ". $id;
            if($conn->query($sqlQuery)){
                $data['data'] = 'Deleted';
            }else{
                $data['data'] = 'Error';
            }
            echo json_encode($data); 
        }elseif($received_data->action == 'updateSingle'){
            $todo = $received_data->todo;
            $id = $received_data->id;
           $data = array();
            $sqlQuery = "update tbl_todos set todo = '". $todo ."' where id =". $id;
            if($conn->query($sqlQuery)){
                $data['data'] = 'Good';
            }else{
                $data['data'] = 'Error';
            }
 
            
            echo json_encode($data);
        }
      
?>
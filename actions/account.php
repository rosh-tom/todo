<?php 
    session_start();
    require_once('../database/connection.php');

    $received_data = json_decode(file_get_contents("php://input")); 

    if($received_data->action == 'myTodos'){ 
        $sqlQuery = "select * from tbl_todos where status = '1' and user_id = ". $_SESSION['id'] ." order by updated_at desc";
        $result = $conn->query($sqlQuery);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $row['created_at'] = date("m/d/Y", strtotime($row['created_at']));  
                $row['updated_at'] = date("m/d/Y", strtotime($row['created_at']));  
                $data [] = $row;
            }
        }else{
            $data [] = array(
                'todo' => "Empty"
            );
        }
        echo json_encode($data);
    }elseif($received_data->action == 'deleteTodo'){

        $id = $received_data->id; 
        $sqlQuery = "delete from tbl_todos where id = ". $id;
        if($conn->query($sqlQuery) === true){
            $data = [
                'message' => 'Successfully Delete' 
            ];
        }else{
            $data = [
                'message' => 'Error' 
            ];
        }
        echo json_encode($data);        
    }
    
?>
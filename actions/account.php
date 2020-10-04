<?php 
    session_start();
    require_once('../database/connection.php');

    $received_data = json_decode(file_get_contents("php://input")); 

    if($received_data->action == 'myTodos'){ 
        
        $page = $received_data->myPage;
        $numPage = $received_data->numPage; 
        $sqlQuery = "Select * from tbl_todos where status = '1' and user_id = ". $_SESSION['id'];
        $result = $conn->query($sqlQuery);
        $numberOfResult = $result->num_rows;

        $data ['numberOfPages'] = ceil($numberOfResult/$numPage);
        $data ['page'] = $page;
        
         
        $pageFirstResult = ($page-1)*$numPage; 

        $sqlQuery = "select * from tbl_todos where
                     status = '1' and user_id = ". $_SESSION['id'] ." order by updated_at desc limit ". $pageFirstResult .", ". $numPage;
        $result = $conn->query($sqlQuery);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $row['created_at'] = date("m/d/Y", strtotime($row['created_at']));  
                $row['updated_at'] = date("m/d/Y", strtotime($row['created_at']));  
                $data ['data'] [] = $row;
            }
        }else{
            $data ['data'] [] = array(
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
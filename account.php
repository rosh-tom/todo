<?php include('inc/header.php'); ?>
<div class="container">  
    <?php include('inc/nav.php'); ?> 
    <?php 
        require_once('database/connection.php');
        $sqlQuery = "select * from tbl_users where id = ". $_SESSION['id'];
        $result = $conn->query($sqlQuery);
        $row = $result->fetch_assoc();        
     ?>
    
    <div class="row">
        <div class="col-sm-12">
            <a href="home.php" class="btn btn-success" style="margin-top: 10px; margin-bottom: 10px;"> &#8249; Back </a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h3>Contextual Colors</h3>
            <p>Use the contextual classes to provide "meaning through colors":</p>
            <p class="text-muted">This text is muted.</p>
            <p class="text-primary">This text is important.</p>
            <p class="text-success">This text indicates success.</p>
            <p class="text-info">This text represents some information.</p>
            <p class="text-warning">This text represents a warning.</p>
            <p class="text-danger">This text represents danger.</p>
        </div>
    </div>
  

</div>  
<?php include('inc/footer.php'); ?>
 
 
<div class="header clearfix">  
    <?php 
        if($uri_segments[2] == 'login.php'){ 
    ?>
        <div class="nav nav-pills pull-right">
            <a href="register.php" class="btn btn-lg btn-success btn-block">Register</a>
        </div>
    <?php  
        }elseif($uri_segments[2] == 'register.php'){ 
    ?> 
        <div class="nav nav-pills pull-right">
            <a href="login.php" class="btn btn-lg btn-primary btn-block">Login</a>
        </div>
    <?php 
        }elseif($uri_segments[2] == 'home.php'){ 
    ?>
        <div class="nav nav-pills pull-right">  
            <a href="actions/logout.php" class="btn btn-danger btn-sm">Log Out</a>  
        </div>
    <?php 
        }
    ?>

    <h3 class="text-muted logo"> <a href="/todo">TODO</a> </h3>
</div>   
 
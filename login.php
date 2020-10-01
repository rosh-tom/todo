 

<?php include('inc/header.php'); ?>
<div class="container">  
    <?php include('inc/nav.php'); ?> 

    <form class="form-signin" action="actions/signin.php" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
         
        <input 
            type="email" 
            class="form-control" 
            placeholder="Email Address" 
            required  
            name = "email"
            value="<?php 
                if(isset($_SESSION['temp']['email'])){ 
                    echo $_SESSION['temp']['email'] .'"'; 
                } else{
                    echo '"' . 'autofocus';
                }
            ?>
        >  
        <input 
            type="password"
            class="form-control" 
            placeholder="Password" 
            required 
            name="password" 
            <?php 
                if(! isset($_SESSION['temp']['password'])){ 
                    echo ' autofocus'; 
                } 
            ?>
        >

        <div class="checkbox"> 

        </div>
        <button class="btn btn-lg btn-primary btn-block last" type="submit" name="btn_signin">Sign in</button>
 
        <?php 
            if(isset($_SESSION['temp']['err_message'])){
                echo "<div class='alert alert-danger'>";
                echo $_SESSION['temp']['err_message'];
                echo "</div>"; 
            } 
            if(isset($_SESSION['temp']['scs_message'])){
                echo "<div class='alert alert-success'>";
                echo $_SESSION['temp']['scs_message'];
                echo "</div>"; 
            } 
        ?>
    </form>
  

</div>  
<?php include('inc/footer.php'); ?>
<?php unset($_SESSION['temp']) ?>
 
<?php include('inc/header.php'); ?>
 
<div class="container">  
    <?php include('inc/nav.php') ?>

    <form class="form-signin" autocomplete="off" method="post" action="actions/signup.php">
        
        <h3 class="form-signin-heading">Enter Account Information</h3> 

        <input 
            type="text" 
            name="firstname" 
            class="form-control" 
            placeholder="First Name" 
            required 
            autofocus 
            value="<?php 
                if(isset($_SESSION['temp']['firstname'])){ 
                    echo $_SESSION['temp']['firstname']; 
                }
            ?>"
        >        
        <input 
            type="text" 
            name="lastname" 
            class="form-control" 
            placeholder="Last Name" 
            required 
            autofocus
            value="<?php 
                if(isset($_SESSION['temp']['lastname'])){ 
                    echo $_SESSION['temp']['lastname']; 
                }
            ?>"
        >
        <input 
            type="email" 
            name="email" 
            class="form-control" 
            placeholder="Email address" 
            required 
            autofocus 
            value="<?php 
                if(isset($_SESSION['temp']['email'])){ 
                    echo $_SESSION['temp']['email']; 
                }
            ?>"
        >
        <input 
            type="password" 
            name="password" 
            class="form-control" 
            placeholder="Password" 
            required 
            autofocus 
        >
        <input 
            type="password" 
            name="password_c" 
            class="form-control last" 
            placeholder="Confirm Password" 
            required 
            autofocus 
        > 
        
        <button class="btn btn-lg btn-success btn-block last" type="submit" name="btn_signup">Sign Up</button>
 
        <?php 
            if(isset($_SESSION['temp']['err_message'])){
                echo "<div class='alert alert-danger'>";
                echo $_SESSION['temp']['err_message'];
                echo "</div>"; 
            } 
        ?> 

      </form>

<?php include('inc/footer.php'); ?>

</div>
 
<?php unset($_SESSION['temp']) ?>
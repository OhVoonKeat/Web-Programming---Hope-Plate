<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> Hope Plate - Login </title>
	<link rel = "stylesheet" href = "Styles.css">
	<?php
	    require ('sessionTimeoutfunction.php'); 
	?>
</head>

<body>
	<?php
    	$showAlert = false;
    	$role = '';
        include 'createHopePlateDatabase.php';
    ?>
    
    <?php 
    	// Check whether the session variables are set and if not fill in null values
    	if (isset($_SESSION['login_role'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid role)') {
    	        echo "<script> alert('Please select what you want to login as.'); </script>";
    	        unset($_SESSION['error_message']);
    	        $role = '';
    	    }
    	    else {
    	        $role = $_SESSION['login_role'];
    	    }
    	}
    	
    	if (isset($_SESSION['login_email'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid email)') {
    	        echo "<script> alert('Invalid input. Please try again...'); </script>";
    	        $email = $_SESSION['error_message'];
    	        unset($_SESSION['error_message']);
    	    }
    	    else {
    	        $email = $_SESSION['login_email'];
    	    }
    	}
    	else {
    	    $email = '';
    	}
    	
    	if (isset($_SESSION['login_password'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid password)') {
    	        echo "<script> alert('Invalid password. Please try again...'); </script>";
    	        unset($_SESSION['error_message']);
    	        $password = '';
    	    }
    	    else {
    	        $password = $_SESSION['login_password'];
    	    }
    	}
    	else {
    	    $password = '';
    	}
    	
    	// Print any error messages, if they exist:
    	if (isset($_SESSION['error_message'])) {
    	    $errorMessages = "Error! The following error(s) occurred:\\n";
    	    $errorMessages .= $_SESSION['error_message'];
    	    
    	    echo "<script> alert('$errorMessages'); </script>";
    	    
    	    unset($_SESSION['error_message']);
    	}
    	
    ?>
    
	<div class = "form-login">
    	<h1> HOPE PLATE </h1>
        <p> Welcome back! </p>
        <form class = "form-register-login" action = "handleLoginForm.php" method = "post">
        	<div class = "left-form">
        		<div class = "form-group">
            		<label for = "login_role"> Login as: </label>
            		<div style = "display: flex; flex-direction: row; gap: 10px;">
              			<input type = "radio" id = "user" name = "login_role" value = "user" <?php if ($role == 'user') echo 'checked'; ?>>
              			<label for = "user"> User </label>
              			<input type = "radio" id = "admin" name = "login_role" value = "admin" <?php if ($role == 'admin') echo 'checked'; ?>>
              			<label for = "admin"> Admin </label> 
          			</div>
            	</div>
            	<div class = "form-group">
              		<label for = "register_email"> Email: </label> 
                	<input type = "email" id = "login_email" name = "login_email" value = "<?php echo $email ?>" required>
                </div>
               	<div class = "form-group">
               		<label for = "register_password"> Password: </label>
					<p style = "margin-top:5px; font-size:12px "> *Requirement: 8 to 20 characters </p>
               		<input type = "password" id = "login_password" name = "login_password" value = "<?php echo $password ?>" required>
               	</div>
               	<div class = "form-group">
               		<button type = "submit" name = "login" value = "Login"> LOGIN </button>
               	</div>
        	</div>
        </form>
	</div>
</body>
</html>
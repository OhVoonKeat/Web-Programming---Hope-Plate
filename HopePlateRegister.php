<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> Hope Plate - Register </title>
	<link rel = "stylesheet" href = "Styles.css">
	<?php
	    require ('sessionTimeoutfunction.php'); 
	?>
</head>

<body>
    <?php
    	$showAlert = false;
    	$gender = '';
        include 'createHopePlateDatabase.php';

    	// Check whether the session variables are set and if not fill in null values
    	if (isset($_SESSION['register_name'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid name)') {
    	       echo "<script> alert('Invalid input. Please try again...'); </script>";
    	       $name = $_SESSION['error_message'];
    	       unset($_SESSION['error_message']);
    	    }
    	    else {
    	       $name = $_SESSION['register_name'];
    	    }
    	}
    	else {
    	    $name = '';
    	}
    	
    	if (isset($_SESSION['register_email'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid email)') {
    	        echo "<script> alert('Invalid input. Please try again...'); </script>";
    	        $email = $_SESSION['error_message'];
    	        unset($_SESSION['error_message']);
    	    }
    	    else {
    	        $email = $_SESSION['register_email'];
    	    }
    	}
    	else {
    	    $email = '';
    	}
    	
    	if (isset($_SESSION['register_phone'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid phone number)') {
    	       echo "<script> alert('Invalid input. Please try again...'); </script>";
    	       $phone = $_SESSION['error_message'];
    	       unset($_SESSION['error_message']);
    	    }
    	    else {
    	        $phone = $_SESSION['register_phone'];
    	    }
    	}
    	else {
    	    $phone = '';
    	}
    	
    	if (isset($_SESSION['register_gender'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid gender)') {
    	        echo "<script> alert('Please select your gender.'); </script>";
    	        unset($_SESSION['error_message']);
    	    }
    	    else {
    	        $gender = $_SESSION['register_gender'];
    	    }
    	}
    	
    	if (isset($_SESSION['register_DOB'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid date of birth)') {
    	        echo "<script> alert('Invalid date of birth. Please try again...'); </script>";
    	        unset($_SESSION['error_message']);
    	    }
    	    elseif (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(You can\'t be here if you are borned in the future)'){
    	        echo "<script> alert('Invalid date of birth. You can\'t be here if you are borned in the future'); </script>";
    	        unset($_SESSION['error_message']);
    	    }
    	    else {
    	        $dob = $_SESSION['register_DOB'];
    	    }
    	}
    	
    	if (isset($_SESSION['register_password'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid password)') {
    	        echo "<script> alert('Invalid password. Please try again...'); </script>";
    	        unset($_SESSION['error_message']);
    	        $password = '';
    	    }
    	    else {
    	        $password = $_SESSION['register_password'];
    	    }
    	}
    	else {
    	    $password = '';
    	}
    	
    	if (isset($_SESSION['register_confirm_password'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid confirm password)') {
    	        echo "<script> alert('Invalid comfirm password. Please try again...'); </script>";
    	        unset($_SESSION['error_message']);
    	        $confirm_password = '';
    	    }
    	    else {
    	        $confirm_password = $_SESSION['register_confirm_password'];
    	    }
    	}
    	else {
    	    $confirm_password = '';
    	}
    	
    	if (isset($_SESSION['register_confirm_password']) && isset($_SESSION['register_password'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Confirm password must be same as the password)') {
    	        echo "<script> alert('Confirm password must be same as the password'); </script>";
    	        unset($_SESSION['error_message']);
    	        $password = '';
    	        $confirm_password = '';
    	    }
    	    else {
    	        $password = $_SESSION['register_password'];
    	        $confirm_password = $_SESSION['register_confirm_password'];
    	    }
    	}
    	else {
    	    $password = '';
    	    $confirm_password = '';
    	}
    	
    	if (isset($_SESSION['error_message'])) {
    	    echo "<script> alert('" . $_SESSION['error_message'] . "'); </script>";
    	    unset($_SESSION['error_message']);
    	}
    ?>
    
	<div class = "form-register">
    	<h1> HOPE PLATE </h1>
        <p> Join us on the path to ZERO HUNGER! <br><br><br></p>
        <form class = "form-register-login" action = "handleRegisterForm.php" method = "post">
        	<div class = "left-form">
            	<div class = "form-group">
        			<label for = "register_name"> Name: </label>
        			<input type = "text" id = "register_name" name = "register_name" value = "<?php echo $name ?>">
        		</div>
            	<div class = "form-group">
            		<label for = "register_email"> Email: </label> 
            		<input type = "email" id = "register_email" name = "register_email" value = "<?php echo $email ?>">
            	</div>
            	<div class = "form-group">
            		<label for = "register_phone"> Phone number: </label>
            		<p style = "margin-top:5px; font-size:12px "> *Example: XXX-XXXXXXX </p>
            		<input type = "tel" id = "register_phone" name = "register_phone" value = "<?php echo $phone ?>">
            	</div>
            	<div class = "form-group">
            		<label for = "register_gender"> Gender: </label>
            		<div style = "display: flex; flex-direction: row; gap: 10px;">
              			<input type = "radio" id = "male" name = "register_gender" value = "male" <?php if ($gender == 'male') echo 'checked'; ?>>
              			<label for = "male"> Male </label>
              			<input type = "radio" id = "female" name = "register_gender" value = "female" <?php if ($gender == 'female') echo 'checked';?>>
              			<label for = "female"> Female </label> 
              			<input type = "radio" id = "other" name = "register_gender" value = "other" <?php if ($gender == 'other') echo 'checked';?>>
              			<label for = "other"> Other </label>
          			</div>
            	</div>
        	</div>
        	<div class = "right-form">
            	<div class = "form-group">
            		<label for = "register_DOB"> Date of birth: </label>
            		<input type = "date" id = "register_DOB" name = "register_DOB" value = "<?php echo $dob ?>">
            	</div>
            	<div class = "form-group">
            		<label for = "register_password"> Password: </label>
            		<p style = "margin-top:5px; font-size:12px "> *Requirement: 8 to 20 characters </p>
            		<input type = "password" id = "register_password" name = "register_password" value = "<?php echo $password ?>">
            	</div>
            	<div class = "form-group">
            		<label for = "register_confirm_password"> Confirm password: </label>
            		<input type = "password" id = "register_confirm_password" name = "register_confirm_password" 
            		value = "<?php echo $confirm_password?>">
            	</div>
            	<div class = "form-group">
            		<button type = "submit" name = "register" value = "Register"> REGISTER </button>
            	</div>
        	</div>
        </form>
	</div>
</body>
</html>
<?php 
    session_start();
?>


<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> Hope Plate - Edit Profile </title>
	<link rel = "stylesheet" href = "Styles.css">
	<?php
	   require ('sessionTimeoutfunction.php'); 
	?>
</head>

<body>
	<?php
        $showAlert = false;
        include 'createHopePlateDatabase.php';
        
        if(!isset($_SESSION['role'])){
            exit;
        }
        
        // Retrieve the admin's information:
        if ($_SESSION['role'] == 'admin') {
            $admin_id = $_SESSION['admin_id'];
            $sql = "SELECT name, email, phone_num, gender, dob, pass FROM admin_table WHERE admin_id = $admin_id";
            $result = @mysqli_query ($conn, $sql);
            
            if (mysqli_num_rows($result) == 1) { // Valid admin ID, show the form.
                // Get the admin's information:
                $row = mysqli_fetch_array ($result, MYSQLI_NUM);
                
                // Assign the admin's information to session variables
                $_SESSION['updated_name'] = $row[0];
                $_SESSION['updated_email'] = $row[1];
                $_SESSION['updated_phone'] = $row[2];
                $_SESSION['updated_gender'] = $row[3];
                $_SESSION['updated_DOB'] = $row[4];
                $_SESSION['database_orignal_password'] = $row[5]; 
                $_SESSION['updated_original_password'] = '';
                $_SESSION['updated_new_password'] = '';
                $_SESSION['updated_new_confirm_password'] = '';
                
                $name = $_SESSION['updated_name'];
                $email = $_SESSION['updated_email'];
                $phone = $_SESSION['updated_phone'];
                $gender = $_SESSION['updated_gender'];
                $dob = $_SESSION['updated_DOB'];
            }
            else {
                echo "<script> alert('An error occur. Please try again.'); </script>";
            }
        }
        
        if ($_SESSION['role'] == 'user') {
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT name, email, phone_num, gender, dob, pass FROM user_table WHERE user_id = $user_id";
            $result = @mysqli_query ($conn, $sql);
            
            if (mysqli_num_rows($result) == 1) { // Valid user ID, show the form.
                // Get the user's information:
                $row = mysqli_fetch_array ($result, MYSQLI_NUM);
                
                // Assign the admin's information to session variables
                $_SESSION['updated_name'] = $row[0];
                $_SESSION['updated_email'] = $row[1];
                $_SESSION['updated_phone'] = $row[2];
                $_SESSION['updated_gender'] = $row[3];
                $_SESSION['updated_DOB'] = $row[4];
                $_SESSION['database_orignal_password'] = $row[5];
                $_SESSION['updated_original_password'] = '';
                $_SESSION['updated_new_password'] = '';
                $_SESSION['updated_new_confirm_password'] = '';
                
                $name = $_SESSION['updated_name'];
                $email = $_SESSION['updated_email'];
                $phone = $_SESSION['updated_phone'];
                $gender = $_SESSION['updated_gender'];
                $dob = $_SESSION['updated_DOB'];
                
            }
            else {
                echo "<script> alert('An error occur. Please try again.'); </script>";
            }
        }
        
    ?>
    	
    <?php 
    	// Check whether the session variables are set and if not fill in null values
    	if (isset($_SESSION['updated_name'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid name)') {
    	       echo "<script> alert('Invalid name. Please try again...'); </script>";
    	       unset($_SESSION['error_message']);
    	    }
    	    else {
    	       $name = $_SESSION['updated_name'];
    	    }
    	}
    	else {
    	    $name = '';
    	}
    	
    	if (isset($_SESSION['updated_email'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid email)') {
    	        echo "<script> alert('Invalid email. Please try again...'); </script>";
    	        unset($_SESSION['error_message']);
    	    }
    	    else {
    	        $email = $_SESSION['updated_email'];
    	    }
    	}
    	else {
    	    $email = '';
    	}
    	
    	if (isset($_SESSION['updated_phone'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid phone number)') {
    	       echo "<script> alert('Invalid phone number. Please try again...'); </script>";
    	       unset($_SESSION['error_message']);
    	    }
    	    else {
    	        $phone = $_SESSION['updated_phone'];
    	    }
    	}
    	else {
    	    $phone = '';
    	}
    	
    	if (isset($_SESSION['updated_DOB'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid date of birth)') {
    	        echo "<script> alert('Invalid date of birth. Please try again...'); </script>";
    	        unset($_SESSION['error_message']);
    	    }
    	    elseif (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(You can\'t be here if you are borned in the future)'){
    	        echo "<script> alert('Invalid date of birth. You can\'t be here if you are borned in the future'); </script>";
    	        unset($_SESSION['error_message']);
    	    }
    	    else {
    	        $dob = $_SESSION['updated_DOB'];
    	    }
    	}
    	
    	if (isset($_SESSION['updated_original_password'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid password)') {
    	        echo "<script> alert('Invalid original password. Please try again...'); </script>";
    	        unset($_SESSION['error_message']);
    	        $ori_password = '';
    	    }
    	    else if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Wrong original password)') {
    	        echo "<script> alert('Wrong original password. Please try again...'); </script>";
    	        unset($_SESSION['error_message']);
    	        $ori_password = '';
    	    }
    	    else {
    	        $ori_password = $_SESSION['updated_original_password'];
    	    }
    	}
    	else {
    	    $ori_password = '';
    	}
    	
    	if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Wrong original password)') {
    	    echo "<script> alert('Wrong original password. Please try again...'); </script>";
    	    unset($_SESSION['error_message']);
    	    $ori_password = '';
    	}

    	if (isset($_SESSION['updated_new_confirm_password']) && isset($_SESSION['updated_new_password'])) {
    	    if (isset($_SESSION['error_message'])) {
    	        if ($_SESSION['error_message'] == '(Invalid new password)') {
    	            echo "<script> alert('Invalid new password. Please try again...'); </script>";
    	            unset($_SESSION['error_message']);
    	            $new_password = '';
    	            $new_confirm_password = '';
    	        } elseif ($_SESSION['error_message'] == '(Confirm password must be same as the password)') {
    	            echo "<script> alert('Confirm password must be same as the password'); </script>";
    	            unset($_SESSION['error_message']);
    	            $new_password = '';
    	            $new_confirm_password = '';
    	        } elseif ($_SESSION['error_message'] == '(Invalid confirm password)') {
    	            echo "<script> alert('Invalid confirm password. Please try again...'); </script>";
    	            unset($_SESSION['error_message']);
    	            $new_password = '';
    	            $new_confirm_password = '';
    	        }
    	    } else {
    	        $new_password = $_SESSION['updated_new_password'];
    	        $new_confirm_password = $_SESSION['updated_new_confirm_password'];
    	    }
    	} else {
    	    $new_password = '';
    	    $new_confirm_password = '';
    	}
    	
    	if (isset($_SESSION['updated_original_password']) && isset($_SESSION['updated_new_password'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(The original password are the same as the new password)') {
    	        echo "<script> alert('The original password are the same as the new password'); </script>";
    	        unset($_SESSION['error_message']);
    	        $ori_password = '';
    	        $new_password = '';
    	        $new_confirm_password = '';
    	    }
    	    else {
    	        $ori_password = $_SESSION['updated_original_password'];
    	        $new_password = $_SESSION['updated_new_password'];
    	        $new_confirm_password = $_SESSION['updated_new_confirm_password'];
    	    }
    	}
    	else {
    	    $ori_password = '';
    	    $new_password = '';
    	    $new_confirm_password = '';
    	}
    	
    	if (isset($_SESSION['updated_original_password'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(You did not fill in new password)') {
    	        echo "<script> alert('You did not fill in new password.'); </script>";
    	        unset($_SESSION['error_message']);
    	        $ori_password = '';
    	        $new_password = '';
    	        $new_confirm_password = '';
    	    }
    	    else {
    	        $ori_password = $_SESSION['updated_original_password'];
    	        $new_password = $_SESSION['updated_new_password'];
    	        $new_confirm_password = $_SESSION['updated_new_confirm_password'];
    	   }
    	}
    	else {
    	    $ori_password = '';
    	    $new_password = '';
    	    $new_confirm_password = '';
    	}
    	
    	if (isset($_SESSION['updated_new_password'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(You did not fill in original password)') {
    	        echo "<script> alert('You did not fill in original password.'); </script>";
    	        unset($_SESSION['error_message']);
    	        $ori_password = '';
    	        $new_password = '';
    	        $new_confirm_password = '';
    	    }
    	    else {
    	        $ori_password = $_SESSION['updated_original_password'];
    	        $new_password = $_SESSION['updated_new_password'];
    	        $new_confirm_password = $_SESSION['updated_new_confirm_password'];
    	    }
    	}
    	else {
    	    $ori_password = '';
    	    $new_password = '';
    	    $new_confirm_password = '';
    	}
    	
        if (isset($_SESSION['error_message'])) {
    	    echo "<script> alert('{$_SESSION["error_message"]}'); </script>";
    	    unset($_SESSION['error_message']);
    	}
    	
    ?>
    
	<div class = "edit-profile">
    	<h1> Edit Profile </h1>
    	<form class = "form" style = "background-color: transparent; margin-bottom: 0;" action = "handleEditProfile.php" method = "post">
    	<div class = "form-group">
    		<label for = "updated_name"> Name: </label>
    		<input type = "text" id = "updated_name" name = "updated_name" value = "<?php echo $name ?>" required>
    	</div>
    	<div class = "form-group">
    		<label for = "updated_email"> Email: </label> 
    		<input type = "email" id = "updated_email" name = "updated_email" value = "<?php echo $email ?>" required>
    	</div>
    	<div class = "form-group">
    		<label for = "updated_phone"> Phone Number: </label>
    		<p style = "margin-top:5px; font-size:12px "> *Example: XXX-XXXXXXX </p>
    		<input type = "tel" id = "updated_phone" name = "updated_phone" value = "<?php echo $phone ?>" required>
    	</div>
    	<div class = "form-group">
    		<label for = "updated_gender"> Gender: </label>
    		<div style = "display: flex; flex-direction: row; gap: 10px; align-items: center; justify-content: flex-start; margin-top: 5px;">
        		<div style = "display: flex; align-items: center; gap: 5px;">
            		<input type = "radio" id = "male" name = "updated_gender" value = "male" <?php if (strtolower($gender) == 'male') echo 'checked'; ?>>
            		<label for = "male"> Male </label>
        		</div>
        		<div style = "display: flex; align-items: center; gap: 5px;">
            		<input type = "radio" id = "female" name = "updated_gender" value = "female" <?php if (strtolower($gender) == 'female') echo 'checked'; ?>>
            		<label for = "female"> Female </label>
        		</div>
        		<div style = "display: flex; align-items: center; gap: 5px;">
            		<input type = "radio" id = "other" name = "updated_gender" value = "other" <?php if (strtolower($gender) == 'other') echo 'checked'; ?>>
            		<label for = "other"> Other </label>
        		</div>
    		</div>
		</div>
        <div class = "form-group">
            <label for = "updated_DOB"> Date of Birth: </label>
            <input type = "date" id = "updated_DOB" name = "updated_DOB" value = "<?php echo $dob ?>">
        </div> 
        <p> <b> Fill in below only if you wish to change your password. </b> </p>
        <div class = "form-group">
        	<label for = "updated_original_password">  Original Password: </label>
            <p style = "margin-top:5px; font-size:12px "> *Requirement: 8 to 20 characters </p>
            <input type = "password" id = "updated_original_password" name = "updated_original_password" value = "">
        </div>
        <div class = "form-group">
            <label for = "updated_new_password"> New Password: </label>
            <p style = "margin-top:5px; font-size:12px "> *Requirement: 8 to 20 characters </p>
            <input type = "password" id = "updated_new_password" name = "updated_new_password" value = "">
        </div>
        <div class = "form-group">
            <label for = "updated_new_confirm_password"> Confirm New Password: </label>
            <input type = "password" id = "updated_new_confirm_password" name = "updated_new_confirm_password" 
             value = "">
        </div>
    	<div class = "form-group">
    		<button type = "submit" name = "submit" value = "Submit"> EDIT </button>
    		<button type = "button" onclick = "window.location.href = 'HopePlateProfile.php'"> BACK </button>
    	</div>
    	</form>
    	
    </div>
    <?php
        mysqli_close($conn);
    ?>
</body>
</html>
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
        
        // Check for a valid user ID, through GET or POST:
        if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From admin panel
            $_SESSION['id'] = $_GET['id'];
            $id = $_GET['id'];
        } 
        elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form admin panel
            $_SESSION['id'] = $_POST['id'];
            $id = $_POST['id'];
        }
        else { // No valid ID, kill the script.
            header('Location: HopePlateAdminPanel.php');
            exit();
        }

        $sql = "SELECT name, email, phone_num, gender, dob FROM user_table WHERE user_id = $id";
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
                    
            $name = $_SESSION['updated_name'];
            $email = $_SESSION['updated_email'];
            $phone = $_SESSION['updated_phone'];
            $gender = $_SESSION['updated_gender'];
            $dob = $_SESSION['updated_DOB'];
        }
        else {
            echo "<script> alert('An error occur. Please try again.'); </script>";
        }
    	
    ?>
    
	<div class = "edit-profile">
    	<h1> Edit Profile </h1>
    	<form class = "form" style = "background-color: transparent; margin-bottom: 0;" action = "handleAdminEditProfile.php" method = "post">
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
    	<div class = "form-group">
    		<button type = "submit" name = "submit" value = "Submit"> EDIT </button>
    		<button type = "button" onclick = "window.location.href = 'HopePlateAdminPanel.php'"> BACK </button>
    	</div>
    	</form>
    	
    </div>
    
    <?php
        mysqli_close($conn);
    ?>
</body>
</html>
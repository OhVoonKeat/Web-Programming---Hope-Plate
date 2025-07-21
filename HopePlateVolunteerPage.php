<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> Hope Plate - Volunteer </title>
	<link rel = "stylesheet" href = "Styles.css">
	<?php
	    require ('sessionTimeoutfunction.php'); 
	?>
</head>

<body>
	<?php
	   $showAlert = false;
	   $gender = '';
	   $role_preference = '';
	   include 'createHopePlateDatabase.php';

	// Check whether the session variables are set and if not fill in null values
	if (isset($_SESSION['volunteer_name'])) {
	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid name)') {
	       echo "<script> alert('Invalid input. Please try again...'); </script>";
	       $name = $_SESSION['error_message'];  
	       unset($_SESSION['error_message']);
	    }
	    else {
	       $name = $_SESSION['volunteer_name'];
	    }
	}
	else {
	    $name = '';
	}
	
	if (isset($_SESSION['volunteer_gender'])) {
	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid gender)') {
	        echo "<script> alert('Please select your gender.'); </script>";
	        unset($_SESSION['error_message']);
	    }
	    else {
	        $gender = $_SESSION['volunteer_gender'];
	    }
	}
	
	
	
	if (isset($_SESSION['volunteer_email'])) {
	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid email)') {
	        echo "<script> alert('Invalid input. Please try again...'); </script>";
	        $email = $_SESSION['error_message'];
	        unset($_SESSION['error_message']);
	    }
	    else {
	        $email = $_SESSION['volunteer_email'];
	    }
	}
	else {
	    $email = '';
	}
	
	if (isset($_SESSION['volunteer_phone'])) {
	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid phone number)') {
	       echo "<script> alert('Invalid input. Please try again...'); </script>";
	       $phone = $_SESSION['error_message'];
	       unset($_SESSION['error_message']);
	    }
	    else {
	        $phone = $_SESSION['volunteer_phone'];
	    }
	}
	else {
	    $phone = '';
	}
	if (isset($_SESSION['home_address'])) {
	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid address)') {
	       echo "<script> alert('Invalid input. Please try again...'); </script>";
	       $home_address = $_SESSION['error_message'];
	       unset($_SESSION['error_message']);
	    }
	    else {
	       $home_address = $_SESSION['home_address'];
	    }
	}
	else {
	    $home_address = '';
	}
	
	if (isset($_SESSION['available_date'])) {
	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid available date)') {
	        echo "<script> alert('Invalid available date. Please try again...'); </script>";
	        unset($_SESSION['error_message']);
	    }
	    else {
	        $available_date = $_SESSION['available_date'];
	    }
	}
	
	if (isset($_SESSION['role_preference'])) {
	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid role preference)') {
	        echo "<script> alert('Invalid role preference.'); </script>";
	        unset($_SESSION['error_message']);
	    }
	    else {
	        $role_preference = $_SESSION['role_preference'];
	    }
	}
	
	if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == 'Error inserting record, please try again. We apologize for any inconvenience.') {
	    echo "<script> alert('" . $_SESSION['error_message'] . "'); </script>";
	}
	?>
	
	<div class = "header-container">
    	<div class = "nav-title"> Hope Plate </div>
    	<div class = "top-nav">
    		<a href = "HopePlateHomePage.php"> Home </a>
    		<a href = "HopePlateDonationPage.php"> Donation </a>
    		<a href = "HopePlateVolunteerPage.php"> Volunteer </a>
    		<a href = "HopePlateEventsPage.php"> Events </a>
    		<a href = "HopePlateContactUs.php"> Contact Us </a>
    	</div>
    	<div class = "profile-button">
    		<a href = "HopePlateOptions.php">
    			<img src = "Images/Profile.png" alt = "Button_img">
    		</a>
    	</div>
    </div>
    
    <div class = "form-title">
    	<h1> Volunteer Registration Form </h1>
    	<p style = "text-align: center; padding-bottom: 50px;"> Join us to help the people in need! <br> With your participation, we will work towards a
    	hunger-free comunity. <br> Please fill out the form below so that we can have basic information about you. <br> We will contact you later on 
    	for more detailed information about the volunteer events. <br> For more information about the events that are currently being held, feel free
    	to check the Events page. </p>
    	<form class = "form" action = "handleVolunteerForm.php" method = "post">
    	<div class = "form-group">
    		<label for = "volunteer_name"> Name: </label>
    		<input type = "text" id = "volunteer_name" name = "volunteer_name" value = "<?php echo $name; ?>" required>
    	</div>
    	
    	<div style="margin-bottom:15px">
    		<label for = "volunteer_gender">Gender:</label>
    		<input type = "radio" name = "volunteer_gender" value = "male" id = "male" <?php if ($gender == 'male') echo 'checked'; ?>>
    		<label for = "male"> Male </label>
    		<input type = "radio" name = "volunteer_gender" value = "female" id = "female" <?php if ($gender == 'female') echo 'checked'; ?>>
    		<label for = "female"> Female </label>
    		<input type = "radio" name = "volunteer_gender" value = "other" id = "other" <?php if ($gender == 'other') echo 'checked'; ?>>
    		<label for = "other"> Other </label>
    	</div>
    	
    	<div class = "form-group">
    		<label for = "volunteer_email"> Email: </label> 
    		<input type = "email" id = "volunteer_email" name = "volunteer_email" value = "<?php echo $email; ?>" required>
    	</div>
    	
    	<div class = "form-group">
    		<label for = "volunteer_phone"> Phone number: </label>
    		<p style = "margin-top:5px; font-size:12px "> *Example: XXX-XXXXXXX </p>
    		<input type = "tel" id = "volunteer_phone" name = "volunteer_phone" value = "<?php echo $phone; ?>" required>
    	</div>
    	
    	<div class = "form-group">
    		<label for = "home_address"> Home Address: </label>
    		<input type = "text" id = "home_address" name = "home_address" value = "<?php echo $home_address; ?>" required>
    	</div>
    	
    	<div class = "form-group">
    	<label for = "available_date"> Date Available: </label>
    		<input type = "date" name = "available_date" id = "available_date" style = "height:30px; width:200px;"
    		min = "<?php echo date('Y-m-d'); ?>" value =  "<?php echo $available_date ?>" required>
    	</div>
    	
    	<div class = "form-group">
    	<label for = "role_preference"> Role preference: </label>
    	<p style = "margin-top:5px; font-size:12px "> *It is not guaranteed that you will get the role </p>
    	<select style = "font-family: 'Comic Sans MS'; Times New Roman, Inter; ; height: 30px;" name = "role_preference">
        	<option value = "none" id = "none" <?php if ($role_preference == 'none') echo 'selected'; ?>> None </option>
        	<option value = "transportation" id = "transportation" <?php if ($role_preference == 'transportation') echo 'selected'; ?>> 
        	Transportation </option>
        	<option value = "collecting_and_distributing_food" id = "collecting_and_distributing_food" 
        	<?php if ($role_preference == 'collecting_and_distributing_food') echo 'selected'; ?>> Collecting and Distributing Food </option>
        	<option value = "sorting_and_packaging_food" id = "sorting_and_packaging_food"
        	<?php if ($role_preference == 'sorting_and_packaging_food') echo 'selected'; ?>> Sorting and Packaging Food </option>
        	<option value = "others" id = "others" <?php if ($role_preference == 'others') echo 'selected'; ?>> Others </option>
    	</select>
    	</div>
    	
    	<div style = "margin-top: 50px">
   		<input type = "checkbox" id = "check" name = "check" value = "check" required>
		<label for = "checkbox_description" style = "font-size: 15px"> 
		I volunteer to help with the events organised by Hope Plate. I am aware that there are potential risks involved in the volunteer activities 
		and Hope Plate is not held legally liable for any of my injuries or accidents that may have occurred during the volunteer activities.
		</label><br>
    	</div>
    	
    	<div class = "form-group">
    		<button type = "submit" name = "submit" value = "Submit"> SUBMIT </button>
    	</div>
    	</form>
    </div>
</body>
</html>
<?php 
    session_start()
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> Hope Plate - Contact Us </title>
	<link rel = "stylesheet" href = "Styles.css">
	<?php
	    require ('sessionTimeoutfunction.php'); 
	?>
</head>

<body>
	<?php
	   $showAlert = false;
	   include 'createHopePlateDatabase.php';
	   
	// Check whether the session variables are set and if not fill in null values
	if (isset($_SESSION['contact_name'])) {
	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid name)') {
	       echo "<script> alert('Invalid input. Please try again...'); </script>";
	       $name = $_SESSION['error_message'];  
	    }
	    else {
	       $name = $_SESSION['contact_name'];
	    }
	}
	else {
	    $name = '';
	}
	
	if (isset($_SESSION['contact_email'])) {
	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid email)') {
	        echo "<script> alert('Invalid input. Please try again...'); </script>";
	        $email = $_SESSION['error_message'];
	    }
	    else {
	        $email = $_SESSION['contact_email'];
	    }
	}
	else {
	    $email = '';
	}
	
	if (isset($_SESSION['contact_phone'])) {
	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid phone number)') {
	       echo "<script> alert('Invalid input. Please try again...'); </script>";
	       $phone = $_SESSION['error_message'];
	    }
	    else {
	        $phone = $_SESSION['contact_phone'];
	    }
	}
	else {
	    $phone = '';
	}
	if (isset($_SESSION['contact_messages'])) {
	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Please tell us why you wish to contact us)') {
	       echo "<script> alert('Invalid input. Please try again...'); </script>";
	       $messages = $_SESSION['error_message'];
	    }
	    else {
	       $messages = $_SESSION['contact_messages'];
	    }
	}
	else {
	    $messages = '';
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
    	<h1> Contact Us </h1>
    	<p style = "text-align: center; padding-bottom: 50px;"> Have any question? Drop us a message or reach us through our social media! </p>
    	<form class = "form" action = "handleContactForm.php" method = "post">
    	<div class = "form-group">
    		<label for = "contact_name"> Name: </label>
    		<input type = "text" id = "contact_name" name = "contact_name" value = "<?php echo $name; ?>" required>
    	</div>
    	<div class = "form-group">
    		<label for = "contact_email"> Email: </label> 
    		<input type = "email" id = "contact_email" name = "contact_email" value = "<?php echo $email; ?>" required>
    	</div>
    	<div class = "form-group">
    		<label for = "contact_phone"> Phone number: </label>
    		<p style = "margin-top:5px; font-size:12px "> *Example: XXX-XXXXXXX </p>
    		<input type = "tel" id = "contact_phone" name = "contact_phone" value = "<?php echo $phone; ?>" required>
    	</div>
    	<div class = "form-group">
    		<label for = "contact_messages"> Messages: </label>
    		<textarea id = "contact_messages" name = "contact_messages" rows = "5" required> <?php echo $messages; ?> </textarea>
    	</div>
    	<div class = "form-group">
    		<button type = "submit" name = "submit" value = "Submit"> SUBMIT </button>
    	</div>
    	</form>
    </div>
    <div class = "footer" style = "padding-top: 50px;">
    	<p style = "text-decoration: underline;"> Contacts </p>
    	<p> Location&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Hope Plate Company, 
    		Jalan Sunway, Subang Jaya <br> Contact Number&nbsp;&nbsp;&nbsp;: <a href = "tel:+0132334552" class = "link"> 013-223-4552 (Jason) </a>
    		<br> Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
    		<a href = "mailto:hopeplate@gmail.com" class = "link">hopeplate@gmail.com </a> <br> Working Hours&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 9am-6pm </p>
    	<div class = "icon">	
    	<button type = "button" onclick = "window.location.href = 'https://www.instagram.com/hope_plate';"> 
		<img src ="Images/Instagram Icon.png" alt = "Instagram"> 
		</button>
		<button type = "button" onclick = "window.location.href = 'https://www.x.com/hope_plate';"> 
		<img src ="Images/X Icon.png" alt = "X"> 
		</button> 
		<button type = "button" onclick = "window.location.href = 'https://www.facebook.com/hope_plate';"> 
		<img src ="Images/Facebook Icon.png" alt = "Facebook"> 
		</button>
		</div> 
	</div>
</body>
</html>
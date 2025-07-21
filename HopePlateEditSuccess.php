<?php 
    session_start();
    require('createHopePlateDatabase.php');
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> Hope Plate - Edit Profile (Susscess) </title>
	<link rel = "stylesheet" href = "Styles.css">
	<?php
	    require ('sessionTimeoutfunction.php'); 
	?>
</head>

<body>
	<?php 
    	// Fetch the updated data from the database
    	if ($_SESSION['role'] == 'admin') {
    	    // Set the session data:
    	    $id = $_SESSION['admin_id'];
    	    
    	    $sql = "SELECT name, email, phone_num, gender, dob FROM admin_table WHERE admin_id = $id";
    	    $result = mysqli_query($conn, $sql);
    	    
    	    if ($result && mysqli_num_rows($result) == 1) {
    	        $row = mysqli_fetch_assoc($result);
    	        $_SESSION['name'] = $row['name'];
    	        $_SESSION['email'] = $row['email'];
    	        $_SESSION['phone_num'] = $row['phone_num'];
    	        $_SESSION['gender'] = $row['gender'];
    	        $_SESSION['dob'] = $row['dob'];
    	    } 
    	    else {
    	        $_SESSION['error_message'] = "Failed to retrieve updated profile information. Please log out and log in again.";
    	        exit;
    	    }

    	}
	   
    	// Fetch the updated data from the database
    	if ($_SESSION['role'] == 'user') {
    	   // Set the session data:
    	   $id = $_SESSION['user_id'];
    	        
    	   $sql = "SELECT name, email, phone_num, gender, dob FROM user_table WHERE user_id = $id";
    	   $result = mysqli_query($conn, $sql);
    	        
    	   if ($result && mysqli_num_rows($result) == 1) {
    	       $row = mysqli_fetch_assoc($result);
    	       $_SESSION['name'] = $row['name'];
    	       $_SESSION['email'] = $row['email'];
    	       $_SESSION['phone_num'] = $row['phone_num'];
    	       $_SESSION['gender'] = $row['gender'];
    	       $_SESSION['dob'] = $row['dob'];
    	   }
    	   else {
    	       $_SESSION['error_message'] = "Failed to retrieve updated profile information. Please log out and log in again.";
    	       exit;
    	   }
        }  
	?>
	
	<div class = "form-success">
        <h1> Thank you! </h1>
        <p style = "text-align: center;"> Your data is successfully updated! </p>
        <button onclick = "window.location.href = 'HopePlateProfile.php'"> OK </button>
    </div>
</body>
</html>
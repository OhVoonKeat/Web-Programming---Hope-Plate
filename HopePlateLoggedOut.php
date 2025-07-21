<?php
    session_start();	// Access the existing session.
    
    // If no session variable exists, redirect the user:
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin'){
            if (!isset($_SESSION['admin_id'])) {
            
                // Need the functions:
                require ('loginFunctions.php');
                redirect_user('HopePlateProfileAdmin.php');
            
            }
        
            else { // Cancel the session:
            
                $_SESSION = array();
                session_destroy();
            }
        }
        
        else if ($_SESSION['role'] == 'user') {
            if (!isset($_SESSION['user_id'])) {
                
                // Need the functions:
                require ('loginFunctions.php');
                redirect_user('HopePlateProfileUser.php');
                
            }
            
            else { // Cancel the session:
                
                $_SESSION = array();
                session_destroy();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> Hope Plate - Logged Out </title>
	<link rel = "stylesheet" href = "Styles.css">
</head>

<body>
	<div class = "form-success">
        <h1> Good Bye! </h1>
        <p style = "text-align: center;"> Your are now logged out. <br> Have a nice day! </p>
        <button onclick = "window.location.href = 'HopePlateHomePage.php'"> OK </button>
    </div>
</body>
</html>
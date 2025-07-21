<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> Hope Plate - Options </title>
	<link rel = "stylesheet" href = "Styles.css">
	<?php
	    require ('sessionTimeoutfunction.php'); 
	?>
</head>

<body>
	<div class = "form-option">
    	<h1> Welcome </h1>
        <p style = "text-align: center;"> Please select one of the options below <br><br><br><br><br>
        <a href = "HopePlateRegister.php"> Register </a> <br><br><br>
        <a href = "HopePlateLogin.php"> Login </a> <br><br><br>
        <a href = "HopePlateProfile.php"> Profile </a> <br><br><br>
        <a href = "HopePlateHomePage.php"> Go Back to Home Page </a>
        </p>
	</div>
</body>
</html>
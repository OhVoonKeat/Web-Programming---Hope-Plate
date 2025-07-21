<?php 
    session_start();
?>


<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> Hope Plate - Contact Us (Susscessful submission) </title>
	<link rel = "stylesheet" href = "Styles.css">
	<?php
	    require ('sessionTimeoutfunction.php'); 
	?>
</head>

<body>
	<div class = "form-success">
        <h1> Thank you! </h1>
        <p style = "text-align: center;"> Your message has been received. <br> We will get back to you soon. </p>
        <button onclick = "window.location.href = 'HopePlateContactUs.php'"> Go Back </button>
    </div>
</body>
</html>
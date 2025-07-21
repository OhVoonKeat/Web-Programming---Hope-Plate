<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> Hope Plate - Register (Susscessful register) </title>
	<link rel = "stylesheet" href = "Styles.css">
	<?php
	    require ('sessionTimeoutfunction.php'); 
	?>
</head>

<body>
	<div class = "form-success">
        <h1 style = "font-size: 50px;"> Congratulations </h1>
        <p style = "text-align: center;"> Your have successfully registered! <br> Welcome to our big family! </p>
        <button onclick = "window.location.href = 'HopePlateHomePage.php'"> OK </button>
    </div>
</body>
</html>
<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> Hope Plate - Deleted Your Account </title>
	<link rel = "stylesheet" href = "Styles.css">
	<?php
	    require ('sessionTimeoutfunction.php'); 
	?>
</head>

<body>
	<div class = "form-success">
        <h1 style = "font-size: 50px;"> Good Bye </h1>
        <p style = "text-align: center;"> User account is deleted. <br> ( •̯́ ^ •̯̀) </p>
        <button onclick = "window.location.href = 'HopePlateAdminPanel.php'"> OK </button>
    </div>
</body>
</html>
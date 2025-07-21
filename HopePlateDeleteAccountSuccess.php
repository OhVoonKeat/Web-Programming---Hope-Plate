<?php
    session_start();
    session_destroy();
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> Hope Plate - Deleted Your Account </title>
	<link rel = "stylesheet" href = "Styles.css">
</head>

<body>
	<div class = "form-success">
        <h1 style = "font-size: 50px;"> Good Bye </h1>
        <p style = "text-align: center;"> Your account is deleted. <br> Hope you will join us back soon. <br> ( •̯́ ^ •̯̀) </p>
        <button onclick = "window.location.href = 'HopePlateHomePage.php'"> OK </button>
    </div>
</body>
</html>
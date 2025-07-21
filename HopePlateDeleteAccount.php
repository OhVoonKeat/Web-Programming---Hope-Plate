<?php
    session_start();
?>


<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset="UTF-8">
	<title> Hope Plate - Deleting your account </title>
	<link rel = "stylesheet" href = "Styles.css">
	<?php
	    require ('sessionTimeoutfunction.php'); 
	?>
</head>

<body>
	<?php
        $showAlert = false;
        include 'createHopePlateDatabase.php';
        
        // If no session value is present, redirect the user:
        if (!isset($_SESSION['role'])) {

	       // Need the functions:
	       require ('loginFunctions.php');
	       redirect_user('HopePlateLogin.php');	

        }
        
        if (isset($_SESSION['error_message'])) {
            echo "<script> alert('{$_SESSION['error_message']}'); </script>";
            unset ($_SESSION['error_message']);
        }
        
    ?>
    
	<div class = "profile">
		<h1> Permanently delete your account </h1>
		<p> Are you sure you want to delete your HOPE PLATE account and leaving HOPE PLATE? (Q w Q) </p>
		
		<form class = "form" style = "align-items: center; background-color: transparent; display: flex; flex-direction: column; gap: 20px;
		justify-content: center;" action = "handleDeleteUser.php" method = "post">
			<div style = "display: flex; flex-direction: row; gap: 20px;">
				<input type = "radio" name = "confirm" value = "Yes"> Yes 
				<input type = "radio" name = "confirm" value = "No" checked = "checked"> No
				<input type = "hidden" name = "" value = "' . $id . '" />
			</div>
			<div class = "form-group">
				<button style = "width: 100%;" type = "submit" name = "delete" value = "Delete"> CONFIRM </button>
			</div>
		</form>
	</div>
</body>
</html>

   
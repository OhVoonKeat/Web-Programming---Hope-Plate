
<?php
    session_start();
?>


<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset="UTF-8">
	<title> Hope Plate - Deleting account </title>
	<link rel = "stylesheet" href = "Styles.css">
	<?php
	    require ('sessionTimeoutfunction.php'); 
	?>
</head>

<body>
	<?php
        $showAlert = false;
        include 'createHopePlateDatabase.php';
        
        if(!isset($_SESSION['role'])){
            exit;
        }
        
        // Check for a valid user ID, through GET or POST:
        if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From admin panel
            $_SESSION['id'] = $_GET['id'];
            $id = $_GET['id'];
        }
        elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form admin panel
            $_SESSION['id'] = $_POST['id'];
            $id = $_POST['id'];
        }
        else { // No valid ID, kill the script.
            header('Location: HopePlateAdminPanel.php');
            exit();
        }
        
        if (isset($_SESSION['error_message'])) {
            echo "<script> alert('{$_SESSION['error_message']}'); </script>";
            unset ($_SESSION['error_message']);
        }
        
        $sql = "SELECT name, email FROM user_table WHERE user_id = $id";
        $result = @mysqli_query ($conn, $sql);
        if (mysqli_num_rows($result) == 1) { // Valid admin ID, show the form.
            // Get the admin's information:
            $row = mysqli_fetch_array ($result, MYSQLI_NUM);
            
            // Assign the admin's information to session variables
            $_SESSION['delete_name'] = $row[0];
            $_SESSION['delete_email'] = $row[1];
       
            
            $name = $_SESSION['delete_name'];
            $email = $_SESSION['delete_email'];

        }
        else {
            echo "<script> alert('An error occur. Please try again.'); </script>";
        }
    ?>
    
	<div class = "profile">
		<h1> Permanently delete <?php echo $name . "'s"?> account </h1>
		<p> Are you sure you want to delete the user HOPE PLATE account (<?php echo $email ?>) ? (Q w Q) </p>
		
		<form class = "form" style = "align-items: center; background-color: transparent; display: flex; flex-direction: column; gap: 20px;
		justify-content: center;" action = "handleAdminDelete.php" method = "post">
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

   
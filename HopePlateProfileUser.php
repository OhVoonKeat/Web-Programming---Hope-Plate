<?php
    session_start();
?>


<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> Hope Plate - Profile </title>
	<link rel = "stylesheet" href = "Styles.css">
	<?php
	    require ('sessionTimeoutfunction.php'); 
	?>
</head>

<body>
	<?php
    	if (isset($_SESSION['error_message'])) {
    	    echo "<script> alert('{$_SESSION['error_message']}'); </script>";
    	    unset ($_SESSION['error_message']);
    	}
	   
        // If no session value is present, redirect the user:
        if (!isset($_SESSION['user_id'])) {

	       // Need the functions:
	       require ('loginFunctions.php');
	       redirect_user('HopePlateLogin.php');	

        }
        
        echo "<script> alert('Login successful: Welcome back!'); </script>";
    ?>
    
	<div class = "profile">
		<div class = "profile-pic">
			<img src = "Images/Profile.png" alt = "Profile_img">
		</div>
		<?php
		    echo "<h1> {$_SESSION['name']} </h1>";
            echo "<h2> {$_SESSION['role']} </h2>";
		?>
		
		<div class = "profile-content">
			<div>
			<?php
			     echo "<h3> User id: <br> {$_SESSION['user_id']} </h3>";
			     echo "<h3> Email: <br> <a href = 'mailto:{$_SESSION["email"]}' class = 'link'> {$_SESSION['email']} </a> </h3>";
			     echo "<h3> Contact number: <br> <a href = 'tel: {$_SESSION["phone_num"]}' class = 'link'> {$_SESSION['phone_num']} </a> </h3>";
			?>		
			</div>
			<div>
			<?php 
			     echo "<h3> Gender: <br> {$_SESSION['gender']} </h3>";
			     echo "<h3> Date of birth: <br> {$_SESSION['dob']} </h3>";
			?>
			</div>
		</div>
		<div style = "display: flex; flex-direction: row; gap: 50px;">
			<button style = "width: 100%;" onclick = "window.location.href='HopePlateEditProfile.php';"> EDIT PROFILE</button>
			<button onclick = "window.location.href = 'HopePlateHomePage.php';"> BACK TO HOME PAGE </button>
			<button onclick = "window.location.href = 'HopePLateLoggedOut.php';"> LOG OUT </button>
			<button onclick = "window.location.href = 'HopePLateDeleteAccount.php';"> DELETE ACCOUNT </button>
		</div>
	</div>
</body>
</html>

   
<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> Hope Plate - Home Page </title>
	<link rel = "stylesheet" href = "Styles.css">
	<?php
	    require ('sessionTimeoutfunction.php'); 
	?>
</head>

<body>
	<?php
	   $showAlert = true;
	   include 'createHopePlateDatabase.php';
	?>
	
	<div class = "header-container">
    	<div class = "nav-title"> Hope Plate </div>
    	<div class = "top-nav">
    		<a href = "HopePlateHomePage.php"> Home </a>
    		<a href = "HopePlateDonationPage.php"> Donation </a>
    		<a href = "HopePlateVolunteerPage.php"> Volunteer </a>
    		<a href = "HopePlateEventsPage.php"> Events </a>
    		<a href = "HopePlateContactUs.php"> Contact Us </a>
    	</div>
    	<div class = "profile-button">
    		<a href = "HopePlateOptions.php">
    			<img src = "Images/Profile.png" alt = "Button_img">
    		</a>
    	</div>
    </div>
    
    <div class = "company-section">
    	<img src = "Images/Hope Plate.png" alt = "HopePlate_img">
    	<p> ZERO HUNGER&nbsp;&nbsp;|&nbsp;&nbsp;FOOD COLLECTION AND DISTRIBUTION&nbsp;&nbsp;|&nbsp;&nbsp;HOPE AND SUPPORT </p>
    </div>
    
    <div class = "introduction-container">
    	<h1> Introduction </h1>
    </div>
    
    <div class = "content">
    	<p> Hope Plate was founded with the belief that no one should end their day with an empty stomach.
    		As the number of people who are still suffering in hunger continues to rise, 
    		Hope Plate was established to narrow down the big gap between the surplus food and millions of people who still cannot access healthy 
    		and nutritious food in this 21 st century. In order to achieve the second SDG goal, Zero Hunger by 2030, Hope Plate steps in to lend a hand
    		to the community in need. We aim to provide long-term solutions that not only address current needs but also work towards a future where 
    		hunger is an issue of the past. For instance, Hope Plate focuses on empowering the communities in need, encouraging every single individual 
    		to not waste food and ensuring everyone can have an opportunity to have a healthier and hunger-free life. </p>
    	<img src = "Images/Company.png" alt = "Company_img">
    </div>
    
    <div class = "mission-container">
    	<h1> Mission</h1>
    </div>
    
    <div class = "content" style = "gap: 150px;">
    	<img src =  "Images/Zero Hunger.png" alt = "ZeroHunger_img" style = "height: auto; width: 20%;">
    	<p> Ours’ mission is to fight against hunger and build a world where everyone can access healthy and nutritious food. 
    	    Hope Plate not only provides short-term support by food distribution to help the communities that suffer in hunger,
    	    but also provides long-term solutions to hunger by empowering the communities with resources, education, and knowledge. 
    	    This is to prepare the communities to ensure that they can survive even without the help from Hope Plate in the future. 
    	    Hope Plate focuses on sustainable and good food practices, as well as building strong local partnerships. 
    	    Besides, we collaborate with farmers, businesses, volunteers, and food suppliers,
    	    hoping to work hand in hand towards the future of zero hunger. </p>
    </div>
    
    <div class = "goal-container">
    	<h1> Our goal </h1>
    </div>
    
    <div class = "content" style = "gap: 200px;">
    	<p> Ours’ final goal is to play an important role on the road towards Zero Hunger. 
    	    Hope Plate envisioned the world in the near future where no one suffers from hunger and works towards it.
    	    Through food distribution, sustainable and good food practices, strong local partnerships, and collaboration with various fields, 
    	    we hope that the efforts we make can decrease the hunger rate, and prepare every single individual in the communities
    	    that suffer from hunger with resources and knowledge needed for long-term nutrioral self-sufficiency. </p>
    	<img src = "Images/Holding Spoon.png" alt = "HoldingSpoon_img" style = "height: 500px; width: auto;">
    </div>
    
    <div class = "footer">
    	<p> &copy; 2024 Hope Plate. All Rights Reserved. </p>
    </div>
    
</body>

</html>

<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> Hope Plate - Events </title>
	<link rel = "stylesheet" href = "Styles.css">
	<?php
	    require ('sessionTimeoutfunction.php'); 
	?>
</head>

<body>
	<?php
	   $showAlert = false;
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
    
    <div class = "event-content">
        <br>
        <h1> Events </h1>
        <br>
        
        <h2> Ongoing Events </h2>
        <br>
        
        <div class = "carousel" id = "carousel1">
            <button class = "arrow left" onclick = "moveSlide(1, 'carousel1')"> &#10094; </button>
            <div class = "carousel-images">
                <div class = "carousel-item">
                    <img src = "Images/OnGoingEvent1.jpg" alt = "On_Going_Event_1">
                    <div class = "bottom-left">
                    	<dl>
                        	<dt> Food for Madagascar </dt>
                        	<dd> To support people in Madagascar, our crew is flying there with support items. </dd>
                        </dl>
                    </div>
                </div>
                <div class = "carousel-item">
                    <img src = "Images/OnGoingEvent2.jpg" alt = "On_Going_Event_2">
                    <div class = "bottom-left">
                    	<dl>
                        	<dt> Flying to Africa </dt>
                        	<dd> Changing lives of Africans for the better. </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <button class = "arrow right" onclick = "moveSlide(1, 'carousel1')"> &#10095; </button>
        </div>
    	
    	<br>
    	<h2> Future Events </h2>
    	<br>
    	
        <div class = "carousel" id = "carousel2">
            <button class = "arrow left" onclick = "moveSlide(1, 'carousel2')"> &#10094; </button>
            <div class = "carousel-images">
                <div class = "carousel-item">
                    <img src = "Images/FutureEvent1.jpg" alt = "Future_Event_1">
                    <div class = "bottom-left">
                    	<dl>
                        	<dt> Showing love for people in need </dt>
                        	<dd> Planning our next event within Asia...... </dd>
                        </dl>
                    </div>
                </div>
                <div class = "carousel-item">
                    <img src = "Images/FutureEvent2.jpg" alt = "Future_Event_2">
                    <div class = "bottom-left">
                    	<dl>
                        	<dt> Sponsored by Malls </dt>
                        	<dd> Malls giving us resources to donate in future events. </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <button class = "arrow right" onclick = "moveSlide(1, 'carousel2')"> &#10095; </button>
        </div>
    	
    	<br>
    	<h2> Past Events </h2>
    	<br>
    	
    	<div class = "carousel" id = "carousel3">
        <button class = "arrow left" onclick = "moveSlide(1, 'carousel3')"> &#10094; </button>
        <div class = "carousel-images">
            <div class = "carousel-item">
                <img src = "Images/PastEvent1.jpg" alt = "Past_Event_1">
                <div class = "bottom-left">
                	<dl>
                    	<dt> Hope Plate Gathering </dt>
                    	<dd> Members group together on a special day to have a buffet. </dd>
                    </dl>
                </div>
            </div>
            <div class = "carousel-item">
                <img src = "Images/PastEvent2.jpg" alt = "Past_Event_2">
                <div class = "bottom-left">
                	<dl>
                    	<dt> Supporting the Locals </dt>
                    	<dd> Sharing food with local people in need. </dd>
                    </dl>
                </div>
            </div>
        </div>
        <button class = "arrow right" onclick = "moveSlide(1, 'carousel3')"> &#10095; </button>
    	</div>
    	
    	<br>
    	<div class = "footer">
        	<p> &copy; 2024 Hope Plate. All Rights Reserved. </p>
     	</div>
     </div>
</body>  
 
<script>
	function moveSlide(direction, carouselId) {
    	const carousel = document.getElementById(carouselId);
        const images = carousel.querySelector('.carousel-images');
        const imageCount = images.children.length;
    
        // Get the current translateX value of the images container
        const currentTransform = parseInt(window.getComputedStyle(images).transform.split(',')[4]) || 0;
    
        // Calculate the new transform value
        const newTransform = currentTransform + (direction * 100); // 100 for 100% image width
    
        // If we reach the last or first image, loop back
        if (newTransform > 0) {
            images.style.transform = `translateX(-${(imageCount - 1) * 100}%)`;
        } else if (newTransform <= -(imageCount - 1) * 100) {
            images.style.transform = 'translateX(0)';
        } else {
            images.style.transform = `translateX(${newTransform}%)`;
        }
    }
</script>
</html>
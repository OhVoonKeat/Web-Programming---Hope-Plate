<?php
    session_start();
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> Hope Plate - Donation </title>
	<link rel = "stylesheet" href = "Styles.css">
	<?php
	    require ('sessionTimeoutfunction.php'); 
	?>
</head>

<body>
	<?php
	   $showAlert = false;
	   include 'createHopePlateDatabase.php';
	   
    	// Check whether the session variables are set and if not fill in null values
    	if (isset($_SESSION['donator_name'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid name)') {
    	       echo "<script> alert('Invalid input. Please try again...'); </script>";
    	       $donator_name = $_SESSION['error_message'];
    	       unset($_SESSION['error_message']);
    	    }
    	    else {
    	       $donator_name = $_SESSION['donator_name'];
    	    }
    	}
    	else {
    	    $donator_name = '';
    	}
    	
    	if (isset($_SESSION['donator_gender'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid gender)') {
    	        echo "<script> alert('Please select your gender.'); </script>";
    	        unset($_SESSION['error_message']);
    	    }
    	    else {
    	        $donator_gender = $_SESSION['donator_gender'];
    	    }
    	}
    	
    	if (isset($_SESSION['donator_email'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid email)') {
    	        echo "<script> alert('Invalid input. Please try again...'); </script>";
    	        $donator_email = $_SESSION['error_message'];
    	        unset($_SESSION['error_message']);
    	    }
    	    else {
    	        $donator_email = $_SESSION['donator_email'];
    	    }
    	}
    	else {
    	    $donator_email = '';
    	}
    	
    	if (isset($_SESSION['donator_phone'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid phone number)') {
    	       echo "<script> alert('Invalid input. Please try again...'); </script>";
    	       $donator_phone = $_SESSION['error_message'];
    	       unset($_SESSION['error_message']);
    	    }
    	    else {
    	        $donator_phone = $_SESSION['donator_phone'];
    	    }
    	}
    	else {
    	    $donator_phone = '';
    	}
    	
    	if (isset($_SESSION['type_of_donation'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid donation type)') {
    	        echo "<script> alert('Please select the donation type.'); </script>";
    	        $donation_type = $_SESSION['error_message'];
    	        unset($_SESSION['error_message']);
    	    }
    	    else {
    	        $donation_type = $_SESSION['type_of_donation'];
    	    }
    	}
    	else {
    	    $donation_type = ''; 
    	}
    	
    	
    	if (isset($_SESSION['food_donation_type'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid food donation type)') {
    	        echo "<script> alert('Please select the food donation type'); </script>";
    	        $food_donation_type = $_SESSION['error_message'];
    	        unset($_SESSION['error_message']);
    	    }
    	    else {
    	        $food_donation_type = $_SESSION['food_donation_type'];
    	    }
    	}
    	else {
    	    $food_donation_type = '';
    	}
    	
    	if (isset($_SESSION['food_collection_date'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid collection date)') {
    	        echo "<script> alert('Invalid collection date. Please try again...'); </script>";
    	        unset($_SESSION['error_message']);
    	    }
    	    else {
    	        $food_collection_date = $_SESSION['food_collection_date'];
    	    }
    	}
    	
    	if (isset($_SESSION['food_donation_location'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid location)') {
    	       echo "<script> alert('Invalid input. Please try again...'); </script>";
    	       $food_donation_location = $_SESSION['error_message'];
    	       unset($_SESSION['error_message']);
    	    }
    	    else {
    	       $food_donation_location = $_SESSION['food_donation_location'];
    	    }
    	}
    	else {
    	    $food_donation_location = '';
    	}
    	
    	if (isset($_SESSION['payment_method'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid payment method)') {
    	        echo "<script> alert('Please select the payment method.'); </script>";
    	        $payment_method = $_SESSION['error_message'];
    	        unset($_SESSION['error_message']);
    	    }
    	    else {
    	        $payment_method = $_SESSION['payment_method'];
    	    }
    	}
    	else {
    	    $payment_method = '';
    	}
    	
    	if (isset($_SESSION['amount'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid amount)') {
    	        echo "<script> alert('Invalid input. Please try again...'); </script>";
    	        $amount= $_SESSION['error_message'];
    	        unset($_SESSION['error_message']);
    	    }
    	    else {
    	        $amount = $_SESSION['amount'];
    	    }
    	}
    	else {
    	    $amount = '';
    	}
    	
    	if (isset($_SESSION['card_number'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid card number)') {
    	        echo "<script> alert('Invalid card number. Please try again...'); </script>";
    	        $card_number = $_SESSION['error_message'];
    	        unset($_SESSION['error_message']);
    	    }
    	    else {
    	        $card_number = $_SESSION['card_number'];
    	    }
    	}
    	else {
    	    $card_number = '';
    	}
    	
    	if (isset($_SESSION['cvv'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid CVV)') {
    	        echo "<script> alert('Invalid CVV. Please try again...'); </script>";
    	        $cvv = $_SESSION['error_message'];
    	        unset($_SESSION['error_message']);
    	    }
    	    else {
    	        $cvv = $_SESSION['cvv'];
    	    }
    	}
    	else {
    	    $cvv = '';
    	}
    	
    	if (isset($_SESSION['card_expiry_date'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid expiry date)') {
    	        echo "<script> alert('Invalid expiry date. Please try again...'); </script>";
    	        $card_expiry_date = $_SESSION['error_message'];
    	        unset($_SESSION['error_message']);
    	    }
    	    else if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Your card already expired)') {
                echo "<script> alert('Card expired. Please try again...'); </script>";
                $card_expiry_date = $_SESSION['error_message'];
                unset($_SESSION['error_message']);
    	    }
    	    else {
    	        $card_expiry_date = $_SESSION['card_expiry_date'];
    	    }
    	}
    	else {
    	    $card_expiry_date = '';
    	}
    	
    	if (isset($_SESSION['bank'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid bank)') {
    	        echo "<script> alert('Please select a bank.'); </script>";
    	        $bank= $_SESSION['error_message'];
    	        unset($_SESSION['error_message']);
    	    }
    	    else {
    	        $bank = $_SESSION['bank'];
    	    }
    	}
    	else {
    	    $bank= '';
    	}
    	
    	
    	if (isset($_SESSION['PayPal_Email'])) {
    	    if (isset($_SESSION['error_message']) && $_SESSION['error_message'] == '(Invalid PayPal email)') {
    	        echo "<script> alert('Invalid input. Please try again...'); </script>";
    	        $PayPal_Email= $_SESSION['error_message'];
    	        unset($_SESSION['error_message']);
    	    }
    	    else {
    	        $PayPal_Email = $_SESSION['PayPal_Email'];
    	    }
    	}
    	else {
    	    $PayPal_Email = '';
    	}
    	
    	if (isset($_SESSION['error_message'])) {
    	    echo "<script> alert('" . $_SESSION['error_message'] . "'); </script>";
    	}
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
    
    <div class = "form-title">
    	<h1> Donation </h1>
    	<p style = "text-align: center; padding-bottom: 50px;"> Donate food or money to help people in need! <br> By filling in this form, 
    	you will be able to help community in need from all around the world! <br> We will send you an email about the details of your donation for future
    	reference after we received your donation. <br> All donations will reach to people in need. </p>
    	<form id = "donationform" class = "form" action = "handleDonationForm.php" method = "post">
        	<div class = "form-group">
        		<label for = "donator_name"> Name: </label>
        		<input type = "text" id = "donator_name" name = "donator_name" value = "<?php echo $donator_name; ?>" required>
        	</div>
        	
        	<div style = "margin-bottom: 15px">
        		<label for = "gender"> Gender: </label>
        		<input type = "radio" name = "donator_gender" value = "male" id = "male"
        		<?php echo (isset($donator_gender) && $donator_gender == 'male') ? 'checked' : ''; ?>> 
        		<label for = "male"> Male </label> 
        		<input type = "radio" name = "donator_gender" value = "female" id = "female" 
        		<?php echo (isset($donator_gender) && $donator_gender == 'female') ? 'checked' : ''; ?>>
        		<label for = "female"> Female </label>
        		<input type = "radio" name = "donator_gender" value = "other" id = "other" 
        		<?php echo (isset($donator_gender) && $donator_gender == 'other') ? 'checked' : ''; ?>>
        		<label for = "other"> Other </label>
        	</div>
        	
        	<div class = "form-group">
        		<label for = "donator_email"> Email: </label> 
        		<input type = "email" id = "donator_email" name = "donator_email" value = "<?php echo $donator_email; ?>" required>
        	</div>
        	
        	<div class = "form-group">
        		<label for = "donator_phone"> Phone number: </label>
        		<p style = "margin-top:5px; font-size:12px "> *Example: XXX-XXXXXXX </p>
        		<input type = "tel" id = "donator_phone" name = "donator_phone" value = "<?php echo $donator_phone; ?>" required>
        	</div>
        	
        	<div style="margin-bottom:15px">
        		<label for = "type_of_donation"> Type of donation: </label>
        		<input type = "radio" name = "type_of_donation" value = "Food" id = "Food"
        		<?php echo (isset($donation_type) && $donation_type == 'Food') ? 'checked' : ''; ?>>
        		<label for = "Food"> Food </label>
        		<input type = "radio" name = "type_of_donation" value = "Money" id = "Money" 
        		<?php echo (isset($donation_type) && $donation_type == 'Money') ? 'checked' : ''; ?>>
        		<label for = "Money"> Money </label>
        	</div>
        	
        	<div style =  "display: none; margin-bottom: 15px" id = 'money_donation'>
        		<h3> Money Donation </h3>
        		<label for = "payment_method"> Payment Method: </label> <br>
        		<input type = "radio" name = "payment_method" value = "Credit Card" id = "Credit Card" 
        		<?php echo (isset($payment_method) && $payment_method == 'Credit Card') ? 'checked' : ''; ?>>
        		<label for = "Credit Card"> Credit Card </label> <br>
        		<input type = "radio" name = "payment_method" value = "Bank Transfer" id = "Bank Transfer" 
        		<?php echo (isset($payment_method) && $payment_method == 'Bank Transfer') ? 'checked' : ''; ?> >
        		<label for = "Bank Transfer"> Bank Transfer </label> <br>
        		<input type = "radio" name = "payment_method" value = "PayPal" id = "PayPal" 
        		<?php echo (isset($payment_method) && $payment_method == 'PayPal') ? 'checked' : ''; ?>>
        		<label for = "Paypal"> Paypal </label>
        		
        		<div class = "form-group" id = "credit-card" style = "display: none">
            		<label for = "card_number"> Credit Card Number: </label>
            		<p style = "margin-top: 5px; font-size: 12px "> *16 digits without - and spaces </p>
            		<input type = "text" id = "card_number" name = "card_number" style = "margin-bottom:10px" value = "<?php echo $card_number; ?>"><br>
    		
            		<label for = "cvv"> Card CVV: </label>
            		<p style = "margin-top: 5px; font-size: 12px "> *3 digits </p>
            		<input type = "text" id = "cvv" name = "cvv" style = "margin-bottom:10px" value = "<?php echo $cvv; ?>"><br>
            		
            		<label for = "card_expiry_date"> Card Expiry Date: </label>
            		<p style = "margin-top: 5px; font-size: 12px "> *MM/YY (Example: 03/23). Do include "/" and if the month or year is sigle digit,
            		add a "0" in front of it </p>
            		<input type = "text"  id = "card_expiry_date" name = "card_expiry_date" style = "margin-bottom: 10px"
            		value = "<?php echo $card_expiry_date; ?>" ><br>
                		
            	</div>
            	
            	<div id = "bank-transfer" style = "margin-top: 15px; display: none;">
            		<label for = "bank"> Bank Choice: </label> <br>
            		<select id = "bank" name = "bank" style = "font-family: 'Comic Sans MS', Times New Roman, Inter; font-size: 20px; width: 100%" required>
            			<option value = "Maybank" id = "Maybank" <?php echo ($bank == 'Maybank') ? 'selected' : ''; ?>> Maybank </option>
            			<option value = "Public Bank" id = "Public Bank" <?php echo ($bank == 'Public Bank') ? 'selected' : ''; ?>> Public Bank</option>
            			<option value = "HSBC Bank" id = "HSBC Bank" <?php echo ($bank == 'HSBC Bank') ? 'selected' : ''; ?>> HSBC Bank </option>
            			<option value = "CIMB Bank" id = "CIMB Bank" <?php echo ($bank == 'CIMB Bank') ? 'selected' : ''; ?>> CIMB Bank </option>
            			<option value = "RHB Bank" id = "RHB Bank" <?php echo ($bank == "RHB Bank") ? 'selected' : ''; ?>> RHB Bank </option>
            			<option value = "Bank Islam" id = "Bank Islam" <?php echo ($bank == 'Bank Islam') ? 'selected' : ''; ?>> Bank Islam </option>
            		</select>
        		</div>
        		
        		<div class = "form-group" id = "PayPal1" style = "margin-top:15px; display:none;">        		
            		<label for = "PayPal_Email"> PayPal Email: </label>
            		<input type = "email" id = "PayPal_Email" name = "PayPal_Email" value = "<?php echo $PayPal_Email;?>" >
        	    </div>   
        	    
        	    <div class = "form-group" style = "margin-top: 15px; display:none;" id = "amount-box">
            	    <label for = "amount"> Donation Amount: </label>
            	    <p style = "margin-top:5px; font-size:12px "> *All the amount entered will be converted to RM. Fill in the amount in 2 decimal point. 
            	    Example: XXX.XX </p>
        			<input type = "text" id = "amount" name = "amount" style = "margin-bottom: 10px;" value = "<?php echo $amount; ?>">     		
        		</div>	
        	</div>
        	
        	<div class = "form-group" style = "display: none;" id = 'food_donation'>
        		<h3> Food Donation </h3>
        		<label for = "food_donation_type"> Food donation type: </label>
        		<select id = food_donation_type name = "food_donation_type" style = "font-family: 'Comic Sans MS', Times New Roman, Inter;
        		font-size: 20px; width: 100%;">
        			<option value = "Canned Food" id = "Canned Food" <?php echo ($food_donation_type == 'Canned Food') ? 'selected' : ''; ?>>
        			Canned Food (Canned Beans etc.) </option>
        			<option value = "Dry Goods" id = "Dry Goods" <?php echo ($food_donation_type == 'Dry Goods') ? 'selected' : ''; ?>> 
        			Dry Goods (Rice, noodles etc.) </option>
        			<option value = "Packaged Food" id = "Packaged Food" <?php echo ($food_donation_type == 'Packaged Food') ? 'selected' : ''; ?>>
        			Packaged Food (Cooking oil etc.) </option>
        			<option value = "Others" id = "Others" <?php echo ($food_donation_type == 'Others') ? 'selected' : ''; ?>>
        			Others (Salt, Sugar etc.) </option>
        		</select>
        		<br>
        		
        		<p style = "margin-bottom: 15px;"> Food Collection Date: </p>
        		<input type = "date" name = "food_collection_date" id = "food_collection_date" min = "<?php echo date('Y-m-d'); ?>" 
        		value =  "<?php echo $food_collection_date ?>">
        		<div class = "form-group" style = "margin-top:15px;">
        			<label for = "food_donation_location"> Food Collection Location: </label>
        			<textarea id = "food_donation_location" name = "food_donation_location" style = "height: 100px">
        			<?php echo $food_donation_location ?> </textarea> 
        		</div>
        	</div>
        	
        	<div class = "form-group">
        		<button type = "submit" name = "submit" value = "Submit"> DONATE </button>
        	</div>
    	</form>
    </div>
    
    <script>
 		document.querySelectorAll('input[name="type_of_donation"]').forEach(function (radio) {
 			radio.addEventListener('change',function() {
 				document.getElementById('food_donation').style.display = 'none';
 				document.getElementById('money_donation').style.display = 'none';
        		
 				if (this.value === 'Food') {
 					document.getElementById('food_donation').style.display = 'block';
 					document.getElementById('food_donation_type').setAttribute('required','required');
 					document.getElementById('food_collection_date').setAttribute('required','required');
 					document.getElementById('food_donation_location').setAttribute('pattern',"^(?!\s*$).{1, 500}$");
 					document.getElementById('food_donation_location').setAttribute('required','required');
 								
 								document.getElementById('amount').value = '';
 								document.getElementById('card_number').value ='';
 								document.getElementById('cvv').value = '';
 								document.getElementById('card_expiry_date').value = '';
 								document.getElementById('PayPal_Email').value = '';
 								
 								document.getElementById('PayPal_Email').removeAttribute('required');
           						document.getElementById('bank').removeAttribute('required');
           						document.getElementById('card_number').removeAttribute('required');
    							document.getElementById('cvv').removeAttribute('required');
    							document.getElementById('card_expiry_date').removeAttribute('required');
    							document.getElementById('amount').removeAttribute('required');
				
 				}
 				else if (this.value === 'Money') {
 					document.getElementById('money_donation').style.display = 'block';
 					document.getElementById('amount-box').style.display = 'block';
 					document.getElementById('amount').setAttribute('required', 'required');
 					document.getElementById('amount').setAttribute('pattern',"^[0-9]{1,50}\.[0-9]{2}$");
 					document.getElementById('food_donation_type').value = '';
        			document.getElementById('food_collection_date').value = '';
        			document.getElementById('food_donation_location').value = '';
        			document.getElementById('food_donation_type').removeAttribute('required');
        			document.getElementById('food_collection_date').removeAttribute('required');
        			document.getElementById('food_donation_location').removeAttribute('required');
 					document.querySelectorAll('input[name="payment_method"]').forEach(function (radio) {
 						radio.addEventListener('change',function() {
 							document.getElementById('credit-card').style.display = 'none';
 							document.getElementById('bank-transfer').style.display = 'none';
 							document.getElementById('PayPal1').style.display = 'none';
 							
 							if(this.value === 'Credit Card') {
 								document.getElementById('credit-card').style.display = 'block';
 								document.getElementById('amount-box').style.display = 'block';
 								document.getElementById('card_number').setAttribute('required', 'required');
 								document.getElementById('card_number').setAttribute('pattern',"^[0-9]{16}$");
            					document.getElementById('cvv').setAttribute('required', 'required');
            					document.getElementById('cvv').setAttribute('pattern',"^[0-9]{3}$");
           						document.getElementById('card_expiry_date').setAttribute('required', 'required');
           						document.getElementById('card_expiry_date').setAttribute('pattern',"^(0[1-9]|1[0-2])\/(2[3-9]|[3-9][0-9])$");
           						document.getElementById('PayPal_Email').value = '';
           						document.getElementById('PayPal_Email').removeAttribute('required');
           						document.getElementById('bank').removeAttribute('required');
 							}
 							else if(this.value === 'Bank Transfer') {
 								document.getElementById('bank-transfer').style.display = 'block';
 								document.getElementById('amount-box').style.display = 'block';
 								document.getElementById('bank').setAttribute('required', 'required');
 								document.getElementById('PayPal_Email').value = '';		
 								document.getElementById('card_number').value ='';
 								document.getElementById('cvv').value = '';
 								document.getElementById('card_expiry_date').value = '';
 								document.getElementById('card_number').removeAttribute('required');
    							document.getElementById('cvv').removeAttribute('required');
    							document.getElementById('card_expiry_date').removeAttribute('required');
    							document.getElementById('PayPal_Email').removeAttribute('required');
 							}
 							else if(this.value === 'PayPal') {
 								document.getElementById('PayPal1').style.display = 'block';
 								document.getElementById('amount-box').style.display = 'block';
 								document.getElementById('PayPal_Email').setAttribute('required', 'required');	
 								document.getElementById('card_number').value ='';
 								document.getElementById('cvv').value = '';
 								document.getElementById('card_expiry_date').value = '';
 								document.getElementById('card_number').removeAttribute('required');
    							document.getElementById('cvv').removeAttribute('required');
    							document.getElementById('card_expiry_date').removeAttribute('required');
 							}
 							else{
 								$payment_method = 'NA';
 							}
 						});
 					});
 				}
 			});	
 		});
	</script>	
</body>
</html>
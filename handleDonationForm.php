<?php
    // start the session
    session_start();
    
    // connect to the database
    $showAlert = false;
    include 'createHopePlateDatabase.php';
    
    // create the clean versions of the input string
    $donator_name = mysqli_real_escape_string($conn, $_POST['donator_name']);
    $donator_gender = mysqli_real_escape_string($conn,$_POST['donator_gender']);
    $donator_email = mysqli_real_escape_string($conn, $_POST['donator_email']);
    $donator_phone = mysqli_real_escape_string($conn, $_POST['donator_phone']);
    $donation_type = mysqli_real_escape_string($conn, $_POST['type_of_donation']);
    $food_donation_type = mysqli_real_escape_string($conn,$_POST['food_donation_type']);
    $food_collection_date = mysqli_real_escape_string($conn, $_POST['food_collection_date']);
    $location = mysqli_real_escape_string($conn, $_POST['food_donation_location']);
    $location = trim($location);
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
    $amount = mysqli_real_escape_string($conn,$_POST['amount']);
    $card_number = mysqli_real_escape_string($conn,$_POST['card_number']);
    $cvv = mysqli_real_escape_string($conn, $_POST['cvv']);
    $card_expiry_date = mysqli_real_escape_string($conn, $_POST['card_expiry_date']);
    $bank = mysqli_real_escape_string($conn, $_POST['bank']);
    $PayPal_Email = mysqli_real_escape_string($conn, $_POST['PayPal_Email']);
    $reference_id = uniqid("HP");
    
    // declare a current date variable for checking
    $current_date = date('m/y');
    
    // patterns to check
    $name_pattern = "/^[a-zA-Z'-. ]{1,70}$/";
    $gender_pattern = "/^(male|female|other)$/";
    $email_pattern = "/^[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/";
    $phone_pattern = "/^01[012346789]-[0-9]{7,8}$/";
    $donation_type_pattern = "/^(Food|Money)$/";
    $food_donation_type_pattern = "/^(Canned Food|Dry Goods|Packaged Food|Others)$/";
    $food_collection_date_pattern = "/^[12][0-9]{3}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
    $location_pattern = "/^(?!\s*$).{1,500}$/";
    $payment_method_pattern = "/^(Credit Card|Bank Transfer|PayPal)$/";
    $amount_pattern = "/^[0-9]{1,50}\.[0-9]{2}$/";
    $card_pattern = "/^[0-9]{16}$/";
    $cvv_pattern = "/^[0-9]{3}$/";
    $card_expiry_date_pattern = "/^(0[1-9]|1[0-2])\/(2[3-9]|[3-9][0-9])$/";
    $bank_pattern = "/^(Maybank|Public Bank|HSBC Bank|CIMB Bank|RHB Bank|Bank Islam)$/";
    $PayPal_Email_pattern = "/^[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/";
    
    // store the users input before checking
    $_SESSION['donator_name'] = $donator_name;
    $_SESSION['donator_gender'] = $donator_gender;
    $_SESSION['donator_email'] = $donator_email;
    $_SESSION['donator_phone'] = $donator_phone;
    $_SESSION['type_of_donation'] = $donation_type;
    $_SESSION['food_donation_type'] = $food_donation_type;
    $_SESSION['food_collection_date'] = $food_collection_date; 
    $_SESSION['food_donation_location'] = $location;
    $_SESSION['payment_method'] = $payment_method;
    $_SESSION['amount'] = $amount;
    $_SESSION['card_number'] = $card_number;
    $_SESSION['cvv'] = $cvv;
    $_SESSION['card_expiry_date'] = $card_expiry_date;
    $_SESSION['bank'] = $bank;
    $_SESSION['PayPal_Email'] = $PayPal_Email;
    
    // check the patterns
    if (!preg_match($name_pattern, $donator_name)){
        $_SESSION['error_message'] = "(Invalid name)";
        header("Location: HopePlateDonationPage.php");
        exit;
    }
    
    if (!preg_match($gender_pattern, $donator_gender)){
        $_SESSION['error_message'] = "(Invalid gender)";
        header("Location: HopePlateDonationPage.php");
        exit;
    }
    
    if (!preg_match($email_pattern, $donator_email)) {
        $_SESSION['error_message'] = "(Invalid email)";
        header("Location: HopePlateDonationPage.php");
        exit;
    }
    
    if (!preg_match($phone_pattern, $donator_phone)){
        $_SESSION['error_message'] = "(Invalid phone number)";
        header("Location: HopePlateDonationPage.php");
        exit;
    }
    
    if (!preg_match($donation_type_pattern, $donation_type)){
        $_SESSION['error_message'] = "(Invalid donation type)";
        header("Location: HopePlateDonationPage.php");
        exit;
    }
    
    if ($donation_type == "Food"){
        if (!preg_match($food_donation_type_pattern, $food_donation_type)){
            $_SESSION['error_message'] = "(Invalid food donation type)";
            header("Location: HopePlateDonationPage.php");
            exit;
        }
        
        if (!preg_match($food_collection_date_pattern, $food_collection_date)) {
            $_SESSION['error_message'] = "(Invalid collection date)";
            header("Location: HopePlateDonationPage.php");
            exit;
        }
        
        if (!preg_match($location_pattern, $location)){
            $_SESSION['error_message'] = "(Invalid location)";
            header("Location: HopePlateDonationPage.php");
            exit;
        }
    }
    
    else if ($donation_type == "Money"){
        if (!preg_match($payment_method_pattern, $payment_method)){
            $_SESSION['error_message'] = "(Invalid payment method)";
            header("Location: HopePlateDonationPage.php");
            exit;
        }
        
        if ($payment_method == "Credit Card"){
            if (!preg_match($card_pattern, $card_number)){
                $_SESSION['error_message'] = "(Invalid card number)";
                header("Location: HopePlateDonationPage.php");
                exit;
            }
            
            if (!preg_match($cvv_pattern, $cvv)){
                $_SESSION['error_message'] = "(Invalid CVV)";
                header("Location: HopePlateDonationPage.php");
                exit;
            }
            
            if (!preg_match($card_expiry_date_pattern, $card_expiry_date)){
                $_SESSION['error_message'] = "(Invalid expiry date)";
                header("Location: HopePlateDonationPage.php");
                exit;
            }
            
            // Extract the month and year from the card expiry date
            $expire_month = substr($card_expiry_date, 0, 2); // First two characters (month)
            $expire_year = substr($card_expiry_date, 3, 2); // Last two characters (year)
            
            
            // Extract the month and year from the current date
            $current_month = substr($current_date, 0, 2);
            $current_year = substr($current_date, 3, 2);
            
            if ($expire_year < $current_year || ($expire_year == $current_year && $expire_month < $current_month)) {
                $_SESSION['error_message'] = "(Your card already expired)";
                header("Location: HopePlateDonationPage.php");
                exit;
            } 
        }
        
        if ($payment_method == "Bank Transfer") {
            if (!preg_match($bank_pattern, $bank)){
                $_SESSION['error_message'] = "(Invalid bank)";
                header("Location: HopePlateDonationPage.php");
                exit;
            }
        }
        
        if ($payment_method =="PayPal"){
            if (!preg_match($PayPal_Email_pattern, $PayPal_Email)){
                $_SESSION['error_message'] = "(Invalid PayPal email)";
                header("Location: HopePlateDonationPage.php");
                exit;
            }
        }
        
        if (!preg_match($amount_pattern, $amount)){
            $_SESSION['error_message'] = "(Invalid amount)";
            header("Location: HopePlateDonationPage.php");
            exit;
        }
    }
    
    // insert data into database
    if($donation_type == "Food"){
        $sql = "INSERT INTO donation_form (reference_id, name, gender, email, phone, type_of_donation, food_donation_type, food_collection_date,
                food_donation_location, payment_method, amount, card_number, cvv, card_expiry_date, bank, PayPal_Email, form_submission_date)
                VALUES ('$reference_id', '$donator_name', '$donator_gender', '$donator_email', '$donator_phone', '$donation_type', '$food_donation_type',
                '$food_collection_date', '$location', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', NOW())";
    }
    else if ($donation_type == "Money") {
        if ($payment_method == "Credit Card"){
            $sql = "INSERT INTO donation_form (reference_id, name, gender, email, phone, type_of_donation, food_donation_type, food_collection_date,
                    food_donation_location, payment_method, amount, card_number, cvv, card_expiry_date, bank, PayPal_Email, form_submission_date)
                    VALUES ('$reference_id', '$donator_name', '$donator_gender', '$donator_email', '$donator_phone', '$donation_type', 'NA', 'NA', 'NA',
                    '$payment_method', '$amount', '$card_number', '$cvv', '$card_expiry_date', 'NA', 'NA', NOW())";
        }
        else if($payment_method == "Bank Transfer"){
            $sql = "INSERT INTO donation_form (reference_id, name, gender, email, phone, type_of_donation, food_donation_type, food_collection_date,
                    food_donation_location, payment_method, amount, card_number, cvv, card_expiry_date, bank, PayPal_Email, form_submission_date)
                    VALUES ('$reference_id', '$donator_name', '$donator_gender','$donator_email', '$donator_phone', '$donation_type', 'NA', 'NA', 'NA', 
                    '$payment_method', '$amount', 'NA', 'NA', 'NA', '$bank', 'NA', NOW())";
        }
        else if ($payment_method == "PayPal"){
            $sql = "INSERT INTO donation_form (reference_id, name, gender, email, phone, type_of_donation, food_donation_type, food_collection_date,
                    food_donation_location, payment_method, amount, card_number, cvv, card_expiry_date, bank, PayPal_Email, form_submission_date)
                    VALUES ('$reference_id', '$donator_name', '$donator_gender', '$donator_email', '$donator_phone','$donation_type', 'NA', 'NA', 'NA',
                    '$payment_method', '$amount', 'NA', 'NA', 'NA', 'NA', '$PayPal_Email', NOW())";
        }
    }
    
    //set date to Malaysia time
    date_default_timezone_set("Asia/Kuala_Lumpur");
    //set food collection to a printable format so it can show in the email
    $food_collection_date_email = date("F j, Y", strtotime($food_collection_date));
    $submission_date = date("F j, Y, g:i a");
    
    // execute the sql query
    $insert_donation = mysqli_query($conn, $sql);
    
    // handle any errors when inserting
    if (!$insert_donation){
       $_SESSION['error_message'] = "Error inserting record, please try again. We apologize for any inconvenience.";
       header("Location: HopePlateDonationPage.php");
       exit;
    }
    
    $subject = "Donation Received";
    if($donation_type == "Food"){
        $body = wordwrap("Hi $donator_name,\n\nThank you for your generous donation to community in need.\n\nDetails:\nReference ID: $reference_id\nSubmission Date: $submission_date\nName: $donator_name\nEmail: $donator_email\nType of Donation: $donation_type\nFood Type: $food_donation_type\nFood Collection Date: $food_collection_date_email\nFood Collection Location: $location");
    }
    else if ($donation_type == "Money"){
        $body = wordwrap("Hi $donator_name,\n\nThank you for your generous donation to community in need.\n\nDetails:\nReference ID: $reference_id\nSubmission Date: $submission_date\nName: $donator_name\nEmail: $donator_email\nType of Donation: $donation_type\nPayment Method: $payment_method\nPayment Amount: RM $amount", 70);
    }
    
    $sender = "From: lees7340@gmail.com";
    
    //send mail
    if (!mail($donator_email, $subject, $body, $sender)) {  //if email not sent then go back to page to try again
        echo "Your donation was successful, but we could not send a confirmation email.";
        header("Location: HopePlateDonationPage.php");
        exit;
    }
    
    
    // unset all the session variables
    unset($_SESSION['donator_name']);
    unset($_SESSION['donator_gender']);
    unset($_SESSION['donator_email']);
    unset($_SESSION['donator_phone']);
    unset($_SESSION['type_of_donation']);
    unset($_SESSION['food_donation_type']);
    unset($_SESSION['food_collection_date']);
    unset($_SESSION['food_donation_location']);
    unset($_SESSION['payment_method']);
    unset($_SESSION['amount']);
    unset($_SESSION['card_number']);
    unset($_SESSION['cvv']);
    unset($_SESSION['card_expiry_date']);
    unset($_SESSION['bank']);
    unset($_SESSION['PayPal_Email']);
    unset($_SESSION['error_message']);
    
    
    session_unset();
    session_destroy();
    
    // direct to the success message if everything is fine
    header("Location: HopePlateDonationSuccess.php");
    exit;
?>
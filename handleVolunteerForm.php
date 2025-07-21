<?php
    // start the session
    session_start();
    
    // connect to the database
    $showAlert = false;
    $volunteer_gender = '';
    include 'createHopePlateDatabase.php';
    
    // create the clean versions of the input string
    $volunteer_name = mysqli_real_escape_string($conn, $_POST['volunteer_name']);
    $volunteer_gender = mysqli_real_escape_string($conn, $_POST['volunteer_gender']);
    $volunteer_email = mysqli_real_escape_string($conn, $_POST['volunteer_email']);
    $volunteer_phone = mysqli_real_escape_string($conn, $_POST['volunteer_phone']);
    $home_address = mysqli_real_escape_string($conn, $_POST['home_address']);
    $home_address = nl2br($home_address);
    $available_date = mysqli_real_escape_string($conn, $_POST['available_date']);
    $role_preference = mysqli_real_escape_string($conn, $_POST['role_preference']);
    
    // patterns to check
    $name_pattern = "/^[a-zA-Z'-. ]{1,70}$/";
    $gender_pattern = "/^(male|female|other)$/";
    $email_pattern = "/^[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/";
    $phone_pattern = "/^01[012346789]-[0-9]{7,8}$/";
    $address_pattern = "/^(?!\s*$).+/";
    $available_date_pattern = "/^[12][0-9]{3}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
    $role_preference_pattern = "/^(none|transportation|collecting_and_distributing_food|sorting_and_packaging_food|others)$/";
    
    // store the users input before checkinb
    $_SESSION['volunteer_name'] = $volunteer_name;
    $_SESSION['volunteer_gender'] = $volunteer_gender;
    $_SESSION['volunteer_email'] = $volunteer_email;
    $_SESSION['volunteer_phone'] = $volunteer_phone;
    $_SESSION['home_address'] = $home_address;
    $_SESSION['available_date'] = $available_date;
    $_SESSION['role_preference'] = $role_preference;
    
    // check the patterns
    if (!preg_match($name_pattern, $volunteer_name)){
        $_SESSION['error_message'] = "(Invalid name)";
        header("Location: HopePlateVolunteerPage.php");
        exit;
    }
    
    if (!preg_match($gender_pattern, $volunteer_gender)) {
        $_SESSION['error_message'] = "(Invalid gender)";
        header("Location: HopePlateVolunteerPage.php");
        exit;
    }
    
    if (!preg_match($email_pattern, $volunteer_email)){
        $_SESSION['error_message'] = "(Invalid email)";
        header("Location: HopePlateVolunteerPage.php");
        exit;
    }
    
    if (!preg_match($phone_pattern, $volunteer_phone)){
        $_SESSION['error_message'] = "(Invalid phone number)";
        header("Location: HopePlateVolunteerPage.php");
        exit;
    }
    
    if (!preg_match($address_pattern, $home_address)){
        $_SESSION['error_message'] = "(Invalid address)";
        header("Location: HopePlateVolunteerPage.php");
        exit;
    }
    
    if (!preg_match($available_date_pattern, $available_date)) {
        $_SESSION['error_message'] = "(Invalid available date)";
        header("Location: HopePlateVolunteerPage.php");
        exit;
    }
    
    if (!preg_match($role_preference_pattern, $role_preference)) {
        $_SESSION['error_message'] = "(Invalid role preference)";
        header("Location: HopePlateVolunteerPage.php");
        exit;
    }
    
    // insert data into database
    $sql = "INSERT INTO volunteer_form (name, gender, email, phone, home_address, available_date, role_preference, form_submission_date)
            VALUES ('$volunteer_name','$volunteer_gender', '$volunteer_email', '$volunteer_phone', '$home_address','$available_date', '$role_preference',
            NOW())";
    
    // execute the sql query
    $insert_volunteer = mysqli_query($conn, $sql);
    
    // handle any errors when inserting
    if (!$insert_volunteer) {
        $_SESSION['error_message'] = "Error inserting record, please try again. We apologize for any inconvenience.";
        header("Location: HopePlateVolunteerPage.php");
        exit;
    }
    
    // unset all the session variables
    unset($_SESSION['volunteer_name']);
    unset($_SESSION['volunteer_gender']);
    unset($_SESSION['volunteer_email']);
    unset($_SESSION['volunteer_phone']);
    unset($_SESSION['home_address']);
    unset($_SESSION['available_date']);
    unset($_SESSION['role_preference']);
    unset($_SESSION['error_message']);
    
    session_unset();
    session_destroy();
    
    // direct to the success message if everything is fine
    header("Location: HopePlateVolunteerSuccess.php");
    exit;
?>
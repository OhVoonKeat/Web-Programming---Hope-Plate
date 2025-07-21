<?php
    // start the session
    session_start();
    
    // connect to the database
    $showAlert = false;
    include 'createHopePlateDatabase.php';
    
    // create the clean versions of the input string
    $name = mysqli_real_escape_string($conn, $_POST['contact_name']);
    $email = mysqli_real_escape_string($conn, $_POST['contact_email']);
    $phone = mysqli_real_escape_string($conn, trim($_POST['contact_phone']));
    $messages = mysqli_real_escape_string($conn, trim($_POST['contact_messages']));
    
    // patterns to check
    $name_pattern = "/^[a-zA-Z'-. ]{1,50}$/";
    $email_pattern = "/^[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/";
    $phone_pattern = "/^01[012346789]-[0-9]{7,8}$/";
    $message_pattern = "/^(?!\s*$).{1,500}$/";
    
    // store the users input before checking
    $_SESSION['contact_name'] = $name;
    $_SESSION['contact_email'] = $email;
    $_SESSION['contact_phone'] = $phone;
    $_SESSION['contact_messages'] = $messages;
    
    // check the patterns
    if (!preg_match($name_pattern, $name)){
        $_SESSION['error_message'] = "(Invalid name)";
        header("Location: HopePlateContactUs.php");
        exit;
    }
    
    if (!preg_match($email_pattern, $email) || strlen($email) > 40) {
        $_SESSION['error_message'] = "(Invalid email)";
        header("Location: HopePlateContactUs.php");
        exit;
    }
    
    if (!preg_match($phone_pattern, $phone)){
        $_SESSION['error_message'] = "(Invalid phone number)";
        header("Location: HopePlateContactUs.php");
        exit;
    }
    
    if (!preg_match($message_pattern, $messages)){
        $_SESSION['error_message'] = "(Please tell us why you wish to contact us)";
        header("Location: HopePlateContactUs.php");
        exit;
    }
    
    // insert data into database
    $sql = "INSERT INTO contact_form (name, email, phone_num, message, form_submission_date) VALUES ('$name', '$email', '$phone', '$messages', NOW())";
    
    // execute the sql query
    $insert_contact = mysqli_query($conn, $sql);
    
    // handle any errors when inserting
    if (!$insert_contact){
       $_SESSION['error_message'] = "Error inserting record, please try again. We apologize for any inconvenience.";
       header("Location: HopePlateContactUs.php");
       exit;
    }
    
    // unset all the session variables
    unset($_SESSION['contact_name']);
    unset($_SESSION['contact_email']);
    unset($_SESSION['contact_phone']);
    unset($_SESSION['contact_messages']);
    unset($_SESSION['error_message']);
    
    session_unset();
    session_destroy();
    
    // direct to the success message if everything is fine
    header("Location: HopePlateContactSuccess.php");
    exit;
?>
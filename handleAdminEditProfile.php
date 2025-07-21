<?php
    // start the session
    session_start();
    
    // connect to the database
    $showAlert = false;
    include 'createHopePlateDatabase.php';
    require('loginFunctions.php');
    
    // create the clean versions of the input string
    $name = mysqli_real_escape_string($conn, $_POST['updated_name']);
    $email = mysqli_real_escape_string($conn, $_POST['updated_email']);
    $phone = mysqli_real_escape_string($conn, $_POST['updated_phone']);
    $gender = mysqli_real_escape_string($conn, $_POST['updated_gender']);
    $dob = mysqli_real_escape_string($conn, $_POST['updated_DOB']);
    
    // declare a current date variable for checking
    $current_date = date('Y-m-d');
    
    // patterns to check
    $name_pattern = "/^[a-zA-Z'-. ]{1,50}$/";
    $email_pattern = "/^[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/";
    $phone_pattern = "/^01[012346789]-[0-9]{7,8}$/";
    $dob_pattern = "/^[12][0-9]{3}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
    
    // store the users input before checking
    $_SESSION['updated_name'] = $name;
    $_SESSION['updated_email'] = $email;
    $_SESSION['updated_phone'] = $phone;
    $_SESSION['updated_gender'] = $gender;
    $_SESSION['updated_DOB'] = $dob;

    // check the patterns
    if (!preg_match($name_pattern, $name)) {
        $_SESSION['error_message'] = "Invalid name";
        header("Location: HopePlateAdminPanel.php");
        exit;
    }
    
    if (!preg_match($email_pattern, $email) || strlen($email) > 40) {
        $_SESSION['error_message'] = "Invalid email";
        header("Location: HopePlateAdminPanel.php");
        exit;
    }
    
    if (!preg_match($phone_pattern, $phone)) {
        $_SESSION['error_message'] = "Invalid phone number";
        header("Location: HopePlateAdminPanel.php");
        exit;
    }
    
    if (!preg_match($dob_pattern, $dob)) {
        $_SESSION['error_message'] = "Invalid date of birth";
        header("Location: HopePlateAdminPanel.php");
        exit;
    }
    
    if ($dob > $current_date) {
        $_SESSION['error_message'] = "You cannot be here if you are borned in the future";
        header("Location: HopePlateAdminPanel.php");
        exit;
    }
  
    
    // Obtain the id
    $id = $_SESSION['id'];

    $sql = "SELECT user_id FROM user_table WHERE email = '$email' AND user_id != $id";
    $result = @mysqli_query($conn, $sql);
        
        
    if (mysqli_num_rows($result) == 0) {
        // Make the query:
        $sql = "UPDATE user_table SET name = '$name', email = '$email', phone_num = '$phone', gender = '$gender', dob = '$dob'
                WHERE user_id = $id LIMIT 1";
        $result = @mysqli_query($conn, $sql);
     
        if (mysqli_affected_rows($conn) == 1){ // If it ran OK.
            redirect_user('HopePlateEditSuccess.php');
        }
        else { // If it did not run OK.
            $_SESSION['error_message'] = "Some error occured. We apologize for any inconvenience caused.";
            header("Location: HopePlateAdminPanel.php");
            exit;
        }
    }
    else { // Already registered.
        $_SESSION['error_message'] =  "The email address has already been registered.";
        header("Location: HopePlateAdminPanel.php");
        exit;
    }
    
    unset($_SESSION['error_message']);

?>
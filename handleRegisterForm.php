<?php
    // start the session
    session_start();

    // connect to the database
    $showAlert = false;
    include 'createHopePlateDatabase.php';
    
    // create the clean versions of the input string
    $name = mysqli_real_escape_string($conn, $_POST['register_name']);
    $email = mysqli_real_escape_string($conn, $_POST['register_email']);
    $phone = mysqli_real_escape_string($conn, $_POST['register_phone']);
    $gender = mysqli_real_escape_string($conn, $_POST['register_gender']);
    $dob = mysqli_real_escape_string($conn, $_POST['register_DOB']);
    $password = mysqli_real_escape_string($conn, $_POST['register_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['register_confirm_password']);
    
    // declare a current date variable for checking
    $current_date = date('Y-m-d');
    
    // patterns to check
    $name_pattern = "/^[a-zA-Z'-. ]{1,50}$/";
    $email_pattern = "/^[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/";
    $phone_pattern = "/^01[012346789]-[0-9]{7,8}$/";
    $gender_pattern = "/^(male|female|other)$/";
    $dob_pattern = "/^[12][0-9]{3}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
    $password_pattern = "/^[A-Za-z0-9@_#$%^&*!]{8,20}$/";
    
    // store the users input before checking
    $_SESSION['register_name'] = $name;
    $_SESSION['register_email'] = $email;
    $_SESSION['register_phone'] = $phone;
    $_SESSION['register_gender'] = $gender;
    $_SESSION['register_DOB'] = $dob;
    $_SESSION['register_password'] = $password;
    $_SESSION['register_confirm_password'] = $confirm_password;
    
    // check the patterns
    if (!preg_match($name_pattern, $name)) {
        $_SESSION['error_message'] = "(Invalid name)";
        header("Location: HopePlateRegister.php");
        exit;
    }
    
    if (!preg_match($email_pattern, $email) || strlen($email) > 40) {
        $_SESSION['error_message'] = "(Invalid email)";
        header("Location: HopePlateRegister.php");
        exit;
    }
    
    if (!preg_match($phone_pattern, $phone)) {
        $_SESSION['error_message'] = "(Invalid phone number)";
        header("Location: HopePlateRegister.php");
        exit;
    }
    
    if (!preg_match($gender_pattern, $gender)) {
        $_SESSION['error_message'] = "(Invalid gender)";
        header("Location: HopePlateRegister.php");
        exit;
    }
    
    if (!preg_match($dob_pattern, $dob)) {
        $_SESSION['error_message'] = "(Invalid date of birth)";
        header("Location: HopePlateRegister.php");
        exit;
    }
    
    if ($dob > $current_date) {
        $_SESSION['error_message'] = "(You can't be here if you are borned in the future)";
        header("Location: HopePlateRegister.php");
        exit;
    }
    
    if (!preg_match($password_pattern, $password)) {
        $_SESSION['error_message'] = "(Invalid password)";
        header("Location: HopePlateRegister.php");
        exit;
    }
    
    if (!preg_match($password_pattern, $confirm_password)) {
        $_SESSION['error_message'] = "(Invalid confirm password)";
        header("Location: HopePlateRegister.php");
        exit;
    }
    
    if ($password != $confirm_password) {
        $_SESSION['error_message'] = "(Confirm password must be same as the password)";
        header("Location: HopePlateRegister.php");
        exit;
    }
    
    // Check for unique email
    $sql = "SELECT email FROM user_table WHERE email = '$email'";
    $result = @mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 0) {
        // insert data into database
        $sql = "INSERT INTO user_table (name, email, phone_num, gender, dob, pass, register_date) VALUES ('$name', '$email', '$phone', '$gender', '$dob',
                SHA1('$password'), NOW())";
        // execute the query
        $insert_user = @mysqli_query($conn, $sql);
        
        // handle any errors when inserting
        if (!$insert_user){
            $_SESSION['error_message'] = "Error inserting record, please try again. We apologize for any inconvenience.";
            header("Location: HopePlateRegister.php");
            exit;
        }
    }
    else { // Already registered.
        $_SESSION['error_message'] =  "The email address has already been registered. Please try again.";
        header("Location: HopePlateRegister.php");
        exit;
    }
    
    // unset all the session variables
    unset($_SESSION['register_name']);
    unset($_SESSION['register_email']);
    unset($_SESSION['register_phone']);
    unset($_SESSION['register_gender']);
    unset($_SESSION['register_DOB']);
    unset($_SESSION['register_password']);
    unset($_SESSION['register_confirm_password']);
    unset($_SESSION['error_message']);
    
    session_unset();
    session_destroy();
    
    // direct to the success message if everything is fine
    header("Location: HopePlateRegisterSuccess.php");
    exit;
?>
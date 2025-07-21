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
    $ori_password = mysqli_real_escape_string($conn, $_POST['updated_original_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['updated_new_password']);
    $new_confirm_password = mysqli_real_escape_string($conn, $_POST['updated_new_confirm_password']);
    
    // declare a current date variable for checking
    $current_date = date('Y-m-d');
    
    // patterns to check
    $name_pattern = "/^[a-zA-Z'-. ]{1,50}$/";
    $email_pattern = "/^[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/";
    $phone_pattern = "/^01[012346789]-[0-9]{7,8}$/";
    $dob_pattern = "/^[12][0-9]{3}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
    $password_pattern = "/^$|[A-Za-z0-9@_#$%^&*!]{8,20}$/";
    
    // store the users input before checking
    $_SESSION['updated_name'] = $name;
    $_SESSION['updated_email'] = $email;
    $_SESSION['updated_phone'] = $phone;
    $_SESSION['updated_gender'] = $gender;
    $_SESSION['updated_DOB'] = $dob;
    $_SESSION['updated_original_password'] = $ori_password;
    $_SESSION['updated_new_password'] = $new_password;
    $_SESSION['updated_new_confirm_password'] = $new_confirm_password;
    
    // check the patterns
    if (!preg_match($name_pattern, $name)) {
        $_SESSION['error_message'] = "(Invalid name)";
        header("Location: HopePlateEditProfile.php");
        exit;
    }
    
    if (!preg_match($email_pattern, $email) || strlen($email) > 40) {
        $_SESSION['error_message'] = "(Invalid email)";
        header("Location: HopePlateEditProfile.php");
        exit;
    }
    
    if (!preg_match($phone_pattern, $phone)) {
        $_SESSION['error_message'] = "(Invalid phone number)";
        header("Location: HopePlateEditProfile.php");
        exit;
    }
    
    if (!preg_match($dob_pattern, $dob)) {
        $_SESSION['error_message'] = "(Invalid date of birth)";
        header("Location: HopePlateEditProfile.php");
        exit;
    }
    
    if ($dob > $current_date) {
        $_SESSION['error_message'] = "(You can't be here if you are borned in the future)";
        header("Location: HopePlateEditProfile.php");
        exit;
    }
    
    if (!preg_match($password_pattern, $ori_password)) {
        $_SESSION['error_message'] = "(Invalid password)";
        header("Location: HopePlateEditProfile.php");
        exit;
    }
    
    if (!preg_match($password_pattern, $new_password)) {
        $_SESSION['error_message'] = "(Invalid new password)";
        header("Location: HopePlateEditProfile.php");
        exit;
    }
    
    if (!preg_match($password_pattern, $new_confirm_password)) {
        $_SESSION['error_message'] = "(Invalid confirm password)";
        header("Location: HopePlateEditProfile.php");
        exit;
    }
    
    if ($new_password != $new_confirm_password) {
        $_SESSION['error_message'] = "(Confirm password must be same as the password)";
        header("Location: HopePlateEditProfile.php");
        exit;
    }
    
    if (($new_password != '') && ($ori_password == '')) {
        $_SESSION['error_message'] = "(You did not fill in original password)";
        header("Location: HopePlateEditProfile.php");
        exit;
    }
    
    if (($new_password == '') && ($ori_password != '')) {
        $_SESSION['error_message'] = "(You did not fill in new password)";
        header("Location: HopePlateEditProfile.php");
        exit;
    }
    
    if (($new_password == $ori_password) && ($ori_password != '')) {
        $_SESSION['error_message'] = "(The original password are the same as the new password)";
        header("Location: HopePlateEditProfile.php");
        exit;
    }
    
    // Obtain the id
    if ($_SESSION['role'] == 'admin') {
        $id = $_SESSION['admin_id'];
    }
    else if ($_SESSION['role'] == 'user') {
        $id = $_SESSION['user_id'];
    }
    else {
        $_SESSION['error_message'] = "Some error occured. We apologize for any inconvenience caused." . mysqli_error($conn);
        header("Location: HopePlateEditProfile");
    }
    
    // Check if user plan to change password
    if (!empty($_SESSION['updated_original_password']) && !empty($_SESSION['updated_new_password'])){
        $role = $_SESSION['role'];    
        list ($check, $data) = check_login($conn, $role, $email, $ori_password);
        if (!$check) { // Unsuccessful
            $_SESSION['error_message'] = "(Wrong original password)";
            header("Location: HopePlateEditProfile.php");
            exit;
        }
        
        else {
            // Obtain the id
            if ($role == 'admin') {
                $id = $data['admin_id'];
            }
            else if ($role == 'user') {
                $id = $data['user_id'];
            }
            else {
                $_SESSION['error_message'] = "Some error occured. We apologize for any inconvenience caused." . mysqli_error($conn);
                header("Location: HopePlateEditProfile");
            }
        }
    }
    
    //  Test for unique email address:
    if (!empty($_SESSION['updated_original_password']) && !empty($_SESSION['updated_new_password'])){
        if ($_SESSION['role'] == 'admin'){
            $sql = "SELECT admin_id FROM admin_table WHERE email = '$email' AND admin_id != $id";
            $result = @mysqli_query($conn, $sql);
        }
        else {
            $sql = "SELECT user_id FROM user_table WHERE email = '$email' AND user_id != $id";
            $result = @mysqli_query($conn, $sql);
        }
        
        if (mysqli_num_rows($result) == 0) {
            // Make the query:
            if ($_SESSION['role'] == 'admin'){
                $sql = "UPDATE admin_table SET name = '$name', email = '$email', phone_num = '$phone', gender = '$gender', dob = '$dob', pass = SHA1('$new_password')
                        WHERE admin_id = $id LIMIT 1";
                $result = @mysqli_query($conn, $sql);
            }
            else {
                $sql = "UPDATE user_table SET name = '$name', email = '$email', phone_num = '$phone', gender = '$gender', dob = '$dob', pass = SHA1('$new_password')
                        WHERE user_id = $id LIMIT 1";
                $result = @mysqli_query($conn, $sql);
            }
            if (mysqli_affected_rows($conn) == 1){ // If it ran OK.
                redirect_user('HopePlateEditSuccess.php');
            }
            else { // If it did not run OK.
                $_SESSION['error_message'] = "Some error occured. We apologize for any inconvenience caused." . mysqli_error($conn);
                header("Location: HopePlateEditProfile.php");
                exit;        
            }
        }
        else { // Already registered.
            $_SESSION['error_message'] =  "The email address has already been registered.";
            header("Location: HopePlateEditProfile.php");
            exit;
        }
    } 
    
    else if (empty($_SESSION['updated_original_password']) && empty($_SESSION['updated_new_password'])) {
        if ($_SESSION['role'] == 'admin'){
            $sql = "SELECT admin_id FROM admin_table WHERE email = '$email' AND admin_id != $id";
            $result = @mysqli_query($conn, $sql);
        }
        else {
            $sql = "SELECT user_id FROM user_table WHERE email = '$email' AND user_id != $id";
            $result = @mysqli_query($conn, $sql);
        }
        
        if (mysqli_num_rows($result) == 0) {
            // Make the query:
            if ($_SESSION['role'] == 'admin'){
                $sql = "UPDATE admin_table SET name = '$name', email = '$email', phone_num = '$phone', gender = '$gender', dob = '$dob'
                        WHERE admin_id = $id LIMIT 1";
                $result = @mysqli_query($conn, $sql);
            }
            else {
                $sql = "UPDATE user_table SET name = '$name', email = '$email', phone_num = '$phone', gender = '$gender', dob = '$dob'
                        WHERE user_id = $id LIMIT 1";
                $result = @mysqli_query($conn, $sql);
            }
            
            if (mysqli_affected_rows($conn) == 1){ // If it ran OK.
                redirect_user('HopePlateEditSuccess.php');
            }
            else { // If it did not run OK.
                $_SESSION['error_message'] = "Some error occured. We apologize for any inconvenience caused.";
                header("Location: HopePlateEditProfile.php");
                exit;
            }
        }
        else { // Already registered.
            $_SESSION['error_message'] =  "The email address has already been registered.";
            header("Location: HopePlateEditProfile.php");
            exit;
        }
    }
    
    // unset all the sensitive session variables
    unset($_SESSION['updated_original_password']);
    unset($_SESSION['updated_new_password']);
    unset($_SESSION['updated_new_confirm_password']);
    unset($_SESSION['error_message']);
    
   
?>
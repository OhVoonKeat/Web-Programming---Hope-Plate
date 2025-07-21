<?php
    // start the session
    session_start();
    
    // connect to the database
    $showAlert = false;
    require ('createHopePlateDatabase.php');
    require('loginFunctions.php');
    
    // create the clean versions of the input string
    $role = mysqli_real_escape_string($conn, $_POST['login_role']);
    $email = mysqli_real_escape_string($conn, $_POST['login_email']);
    $password = mysqli_real_escape_string($conn, $_POST['login_password']);
    
    // patterns to check
    $role_pattern = "/^(user|admin)$/";
    $email_pattern = "/^[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/";
    $password_pattern = "/^[A-Za-z0-9@_#$%^&*!]{8,20}$/";
    
    // store the users input before checking
    $_SESSION['login_role'] = $role;
    $_SESSION['login_email'] = $email;
    $_SESSION['login_password'] = $password;
    
    // check the patterns
    if (!preg_match($role_pattern, $role)) {
        $_SESSION['error_message'] = "(Invalid role)";
        header("Location: HopePlateLogin.php");
        exit;
    }
    
    if (!preg_match($email_pattern, $email) || strlen($email) > 40) {
        $_SESSION['error_message'] = "(Invalid email)";
        header("Location: HopePlateLogin.php");
        exit;
    }
 
    if (!preg_match($password_pattern, $password)) {
        $_SESSION['error_message'] = "(Invalid password)";
        header("Location: HopePlateLogin.php");
        exit;
    }
   
    // Check the login:
    list ($check, $data) = check_login($conn, $role, $email, $password);
        
    if ($check) { // OK!
        if ($role == 'admin') {
            // Set the session data:
            $_SESSION['role'] = $role;
            $_SESSION['admin_id'] = $data['admin_id'];
            $_SESSION['name'] = $data['name'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['phone_num'] = $data['phone_num'];
            $_SESSION['gender'] = $data['gender'];
            $_SESSION['dob'] = $data['dob'];
            
            // unset sensitive and unnecessary session variables
            unset($_SESSION['login_password']);
            unset($_SESSION['error_message']); 
            
            // Set status to logged in
            $_SESSION['logged_in'] = true;
            
            // Redirect:
            redirect_user('HopePlateProfileAdmin.php');
        }
        
        if ($role == 'user') {
            // Set the session data:
            $_SESSION['role'] = $role;
            $_SESSION['user_id'] = $data['user_id'];
            $_SESSION['name'] = $data['name'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['phone_num'] = $data['phone_num'];
            $_SESSION['gender'] = $data['gender'];
            $_SESSION['dob'] = $data['dob'];
            
            // unset sensitive and unnecessary session variables
            unset($_SESSION['login_password']);
            unset($_SESSION['error_message']); 
            
            // Set the status to logged in
            $_SESSION['logged_in'] = true;
            
            // Redirect:
            redirect_user('HopePlateProfileUser.php');
        }
    } 
    else { // Unsuccessful!
        // Assign $data to $errors
        $errors = $data;
        foreach ($errors as $msg) {
            $_SESSION['error_message'] .= " - $msg\\n";
        }
        redirect_user('HopePlateLogin.php');
    }
    
    // unset sensitive and unnecessary session variables
    unset($_SESSION['login_password']);
    unset($_SESSION['error_message']);   
    
?>
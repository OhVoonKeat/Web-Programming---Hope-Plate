<?php
    // start the session
    session_start();
    
    // connect to the database
    $showAlert = false;
    include 'createHopePlateDatabase.php';
    require ('loginFunctions.php');
    
    // create the clean versions of the input
    $confirmation = mysqli_real_escape_string($conn, $_POST['confirm']);
    
    
    // get the id of the account based on the role
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            $id = $_SESSION['admin_id'];
        }
        
        else if ($_SESSION['role'] == 'user') {
            $id = $_SESSION['user_id'];
        }
    }
    else {
        redirect_user('HopePlateLogin.php');
        exit;
    }
    
    // check for confirmation
    if ($confirmation == 'Yes') {
        if ($_SESSION['role'] == 'admin') {
            // make the query
            $sql = "DELETE FROM admin_table WHERE admin_id = $id LIMIT 1";
            $result = @mysqli_query($conn, $sql);
            
            if (mysqli_affected_rows($conn) == 1) {		 // If it ran OK.
                
                // Print a message:
                redirect_user('HopePlateDeleteAccountSuccess.php');
            }
            else {
                $_SESSION['error_message'] == "Error deleting record, please try again. We apologize for any inconvenience.";
                exit;
            }
        
        }
        else {
            // make the query
            $sql = "DELETE FROM user_table WHERE user_id = $id LIMIT 1";
            $result = @mysqli_query($conn, $sql);
        
            if (mysqli_affected_rows($conn) == 1) {		 // If it ran OK.
            
                // Print a message:
                redirect_user('HopePlateDeleteAccountSuccess.php');
            }
            else {
                $_SESSION['error_message'] == "Error deleting record, please try again. We apologize for any inconvenience.";
            }
        }
    }
    else if ($confirmation == 'No') {
        $_SESSION['error_message'] = "Confirmation rejected: The user has NOT been deleted.";
        redirect_user('HopePlateProfile.php');
        exit;
    }
    
    else {
        $_SESSION['error_message'] = "Error deleting record, please try again. We apologize for any inconvenience.";
        redirect_user('HopePlateProfile.php');
        exit;
    }
    
?>
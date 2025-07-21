<?php
    // start the session
    session_start();
    
    // connect to the database
    $showAlert = false;
    include 'createHopePlateDatabase.php';
    require ('loginFunctions.php');
    
    // create the clean versions of the input
    $confirmation = mysqli_real_escape_string($conn, $_POST['confirm']);
    
    // Obtain the id
    $id = $_SESSION['id'];
    
    // check for confirmation
    if ($confirmation == 'Yes') {
        // make the query
        $sql = "DELETE FROM user_table WHERE user_id = $id LIMIT 1";
        $result = @mysqli_query($conn, $sql);
            
        if (mysqli_affected_rows($conn) == 1) {		 // If it ran OK.
                
            // Print a message:
            redirect_user('HopePlateAdminPanelDeleteSuccess.php');
        }
        else {
            $_SESSION['error_message'] == "Error deleting record, please try again. We apologize for any inconvenience.";
            exit;
        } 
    }
    else if ($confirmation == 'No') {
        $_SESSION['error_message'] = "Confirmation rejected: The user has NOT been deleted.";
        redirect_user('HopePlateAdminPanel.php');
        exit;
    }
    
    else {
        $_SESSION['error_message'] = "Error deleting record, please try again. We apologize for any inconvenience.";
        redirect_user('HopePlateAdminPanel.php');
        exit;
    }

?>
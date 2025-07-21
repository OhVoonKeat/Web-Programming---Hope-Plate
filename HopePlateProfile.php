<?php
    require('loginFunctions.php');
    session_start();
    
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
        if ($_SESSION['role'] == 'admin') {
            redirect_user('HopePlateProfileAdmin.php');
        }
        else if ($_SESSION['role'] == 'user') {
            redirect_user('HopePlateProfileUser.php');
        }
    }
    
    else {
        echo "<script> 
              alert('You are not logged in. Log in to view your profile.'); 
              window.location.href = 'HopePlateLogin.php';
              </script>";

    }
?>

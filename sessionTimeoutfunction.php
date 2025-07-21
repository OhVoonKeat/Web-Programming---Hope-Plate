<?php

// session_timeout_script.php
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    echo "
    <script>
        var timeoutHandle;
        var timeoutDuration = 1800000 //30 minutes
        
        function redirectToLogout() {
            alert('Your session has expired. You will be logged out.');
            window.location.href = 'HopePlateLoggedOut.php';
        }
        
        function resetTimeout() {
            clearTimeout(timeoutHandle);
            timeoutHandle = setTimeout(redirectToLogout, timeoutDuration);
        }
        
        // Moving, scrolling, or clicking the mouse will not be checked as idle
        document.addEventListener('mousemove', resetTimeout);
        document.addEventListener('scroll', resetTimeout);
        document.addEventListener('click', resetTimeout);
        
        // Initialize the timeout when the page loads
        resetTimeout();
    </script>
    ";
}

?>


<?php
    function redirect_user ($page) {
        
        // Start defining the URL...
        // URL is http:// plus the host name plus the current directory:
        $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
        
        // Remove any trailing slashes:
        $url = rtrim($url, '/\\');
        
        // Add the page:
        $url .= '/' . $page;
        
        // Redirect the user:
        header("Location: $url");
        exit(); // Quit the script.
        
    } // End of redirect_user() function.
    
    function check_login($conn, $role = '', $email = '', $password = '') {
        $role = mysqli_real_escape_string($conn, trim($role));
        $email = mysqli_real_escape_string($conn, trim($email));
        $password = mysqli_real_escape_string($conn, trim($password));
        
        // Retrieve the information needed for the email and password combination for admin
        $errors[] = array();
        
        if ($role == 'admin') {
            $sql = "SELECT admin_id, name, email, phone_num, gender, dob FROM admin_table WHERE email='$email' AND pass=SHA1('$password')";
            $result = @mysqli_query($conn, $sql);
            
            // Check the result:
            if (mysqli_num_rows($result) == 1) {
                
                // Fetch the record:
                $row = mysqli_fetch_array ($result, MYSQLI_ASSOC);

                // Return true and the record:
                return array(true, $row);
            }
            else { // Not a match
                $errors[] = 'Cannot find the admin in the database. It is either invalid admin email entered or invalid password entered.';
                return array(false, $errors);
            }
        }
        
        // Retrieve the information needed for that email and password combination for user
        if ($role == 'user') {
            $sql = "SELECT user_id, name, email, phone_num, gender, dob FROM user_table WHERE email='$email' AND pass=SHA1('$password')";
            $result = @mysqli_query ($conn, $sql);
            
            
            
            // Check the result:
            if (mysqli_num_rows($result) == 1) {
                    
                // Fetch the record:
                $row = mysqli_fetch_array ($result, MYSQLI_ASSOC);
                    
                // Return true and the record:
                return array(true, $row);
                    
            } 
            else { // Not a match!
                $errors[] = 'Cannot find the user in the database. It is either invalid user email entered or invalid password entered.';
                return array(false, $errors);
            }
        }
    } // End of check_login() function.
?>
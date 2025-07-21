<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'HopePlateDatabase';
    
    // Create connection to the database
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    
    // Check connection and alert the user if the database is not connected but do not stop them from browsing the website
    if(! $conn){
        if (isset($showAlert) && $showAlert) {
            echo '<script> alert ("Connection failure: Hope Plate database is not connected!"); </script>';
        }
    }
    else {
        if (isset($showAlert) && $showAlert) {
            echo '<script> alert ("Connection success: Welcome to HOPE PLATE!"); </script>';
        }
    }
    
    // Check whether the database exist or not before creating. If it does not exists, create it
    $sql = "SHOW DATABASES LIKE '$dbname'";
    $dbexist = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($dbexist) == 0) {
        $sql = "CREATE DATABASE $dbname";
        
        if (mysqli_query($conn, $sql)) {
            if (isset($showAlert) && $showAlert) {
                echo '<script> alert ("Database created successfully."); </script>';
            }
        }
        else {
            if (isset($showAlert) && $showAlert) {
                echo '<script> alert ("Error creating database: " . mysqli_error($conn)); </script>';
            }
        }
    }
    else {
        if (isset($showAlert) && $showAlert) {
            echo '<script> alert ("Database found!"); </script>';
        }
    }
    
    //Select the database to work with
    mysqli_select_db($conn, $dbname);
    
    // Create tables in the database
    $tables = ["CREATE TABLE IF NOT EXISTS Contact_Form (
                Contact_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                Name VARCHAR(50) NOT NULL,
                Email VARCHAR(40) NOT NULL,
                Phone_num VARCHAR(15) NOT NULL,
                Message VARCHAR(500) NOT NULL,
                Form_submission_date DATETIME NOT NULL)",
        
               "CREATE TABLE IF NOT EXISTS User_Table (
                User_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                Name VARCHAR(50) NOT NULL,
                Email VARCHAR(40) NOT NULL,
                Phone_num VARCHAR(15) NOT NULL,
                Gender ENUM('Male', 'Female', 'Other') NOT NULL,
                DOB DATE NOT NULL,
                Pass VARCHAR(225) NOT NULL,
                Register_date DATETIME NOT NULL)",
        
                "CREATE TABLE IF NOT EXISTS Donation_Form (
                DONATION_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                Reference_ID VARCHAR(20),
                Name VARCHAR(50) NOT NULL,
                Gender ENUM('Male', 'Female', 'Other') NOT NULL,
                Email VARCHAR(40) NOT NULL,
                Phone VARCHAR(15) NOT NULL,
                Type_of_donation VARCHAR(5) NOT NULL,
                Food_donation_type VARCHAR(30),
                Food_collection_date VARCHAR(15),
                Food_donation_location VARCHAR(500),
                Payment_method VARCHAR (13),
                Amount VARCHAR(20),
                Card_number VARCHAR(16),
                CVV VARCHAR(4),
                Card_expiry_date VARCHAR(10),
                Bank VARCHAR(30),
                PayPal_email VARCHAR(40),
                Form_submission_date DATETIME NOT NULL)",
        
                "CREATE TABLE IF NOT EXISTS Volunteer_Form (
                Volunteer_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                Name VARCHAR(50) NOT NULL,
                Gender ENUM('Male', 'Female', 'Other') NOT NULL,
                Email VARCHAR(40) NOT NULL,
                Phone VARCHAR(15) NOT NULL,
                Home_address VARCHAR(500) NOT NULL,
                Available_date DATETIME NOT NULL,
                Role_preference VARCHAR(50) NOT NULL,
                Form_submission_date DATETIME NOT NULL)"
    ];
    
    for ($i = 0, $count = count($tables); $i < $count; $i++) {
        $sql = $tables[$i];
        if (!mysqli_query($conn, $sql)) {
            if (isset($showAlert) && $showAlert) {
                echo '<script> alert ("Error creating table: " . mysqli_error($conn)); </script>';
            }
            exit;
        }
    }
    
    // Create admin table and insert default admins
    $sql = "CREATE TABLE IF NOT EXISTS Admin_Table (
            Admin_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            Name VARCHAR(50) NOT NULL,
            Email VARCHAR(40) NOT NULL,
            Phone_num VARCHAR(15) NOT NULL,
            Gender ENUM('Male', 'Female', 'Other') NOT NULL,
            DOB DATE NOT NULL,
            Pass VARCHAR(225) NOT NULL,
            Register_date DATETIME NOT NULL)";
    
    if (!mysqli_query($conn, $sql)) {
        if(isset($showAlert) && $showAlert) {
            echo '<script> alert ("Error creating table: " . mysqli_error($conn)); </script>';
        }
    }
    
    $sql = "SELECT COUNT(*) AS count FROM Admin_Table";
    $recordexist = mysqli_query($conn, $sql);
    $row  = mysqli_fetch_assoc($recordexist);
    
    if ($row['count'] == 0) {
        $sql = "INSERT INTO Admin_Table (name, email, phone_num, gender, dob, pass, register_date)
                VALUES ('Oh Voon Keat', 'vkoh3128@gmail.com', '017-3210383', 'male', '2004-08-22', SHA1('22064091'), NOW()),
                       ('Lee Seng Wai', 'sengwai@gmail.com', '012-3456789', 'male', '2004-01-01', SHA1('23102627'), NOW()),
                       ('Charis Kwan', 'lecturer_ck@gmail.com', '017-1234567', 'female', '1990-01-01', SHA1('autopass'), NOW())";
        
        if (!mysqli_query($conn, $sql)) {
            if (isset($showAlert) && $showAlert) {
                echo '<script> alert ("Error creating table: " . mysqli_error($conn)); </script>';
            }
            exit;
        }
    }
    
    if (isset($showAlert) && $showAlert) {
        echo '<script> alert ("Disclaimer: Your data will be recorded by Hope Plate\'s database."); </script>';
    }
    
?>
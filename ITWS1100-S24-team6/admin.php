<?php
// Include the file that connects to the database
require 'connect.php';

// Check if the request method is POST
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    // Get username and password from the POST data
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Query to select user with provided username and password
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    
    // Execute the query
    $result = $db->query($query);
    
    // Check if any row is returned
    if ($result->num_rows > 0) {
        // If user is found, redirect to admin page
        header('Location: ./admin/index.php');
    }
    else {
        // If user is not found, display alert and redirect to index.php
        echo '<script language="javascript">';
        echo 'alert("Invalid username/password");';
        echo 'window.location.href="./index.php";';
        echo '</script>';
    }
}
?>

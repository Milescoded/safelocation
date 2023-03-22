<?php
session_start();

if (isset($_POST['submit'])) {
    // Check if the username and password are correct
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to the database
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "newformation";
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the username and password are correct in the database
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Set session variable and redirect to location page if login is successful
        $_SESSION['loggedin'] = true;
        header("Location: location.html");
        exit();
    } else {
        // Display an error message if the login is unsuccessful
        echo "Incorrect username or password.";
    }

    $conn->close();
} else {
    // Display an error message if the page is accessed directly without submitting the form
    echo "Please login first.";
}
?>

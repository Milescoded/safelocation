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
        header("Location: location.php");
        exit();
    } else {
        // Display an error message if the login is unsuccessful
        echo "Incorrect username or password.";
    }

    $conn->close();
} else if (isset($_POST['latitude']) && isset($_POST['longitude'])) {
    // Check if the location is safe
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    // Write your location checking logic here
    if ($latitude > 0 && $longitude > 0) {
        echo "This location is safe.";
    } else {
        echo "This location is not safe.";
    }
} else if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // If the user is already logged in, show the location page
?>
<!DOCTYPE html>
<html>
<head>
    <title>Location Page</title>
</head>
<body>
    <h1>Welcome to the Location Page!</h1>
    <form action="" method="post">
        <label for="latitude">Latitude:</label>
        <input type="number" name="latitude" id="latitude" step="any" required><br><br>
        <label for="longitude">Longitude:</label>
        <input type="number" name="longitude" id="longitude" step="any" required><br><br>
        <input type="submit" value="Check Location">
    </form>
</body>
</html>
<?php
} else {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}
?>

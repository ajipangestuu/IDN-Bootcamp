<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ctf_labs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['search'])) {
    $search = $_GET['search'];

    // Vulnerable SQL Query
    $sql = "SELECT * FROM users WHERE username";
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        echo "User: " . $row['username'] . "<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Users</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container">
        <h1>Search Users</h1>
        <form method="get">
            Search User: <input type="text" name="search" required><br>
            <input type="submit" value="Search">
        </form>
    </div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Search a city</title>
</head>
<body>
    <h2>Enter City</h2>
    <form method="post">
    <input type="text" name="input"><br>
    <input type="submit" value="Submit">
    </form>
    <form action='HomePage.php'>
    <input type='Submit' value='Back to Home'>
    </form>
</body>
</html>

<?php

session_start();

require_once("LoginToDatabase.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST['input'];

    $sql = "SELECT b.name, l.location FROM businesses b
    JOIN location l ON b.location_id = l.id WHERE l.location LIKE '%$input%' 
    ";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo " City: " . $row["location"]. " Businesses: " . $row["name"]. "<br>";
        }
    } else {
        echo "Business not yet in system";
    }
}
$connection->close();
?>
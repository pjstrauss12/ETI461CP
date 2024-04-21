<!DOCTYPE html>
<html>
<head>
    <title>View reviews for a business</title>
</head>
<body>
    <h2>Enter Business Name</h2>
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

    $sql = "SELECT b.name, r.rating, r.review FROM businesses b
    JOIN reviews r ON b.id = r.business_id WHERE b.name LIKE '%$input%' 
    ";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo " Name: " . $row["name"]. " Rating: " . $row["rating"]. " Review: " . $row["review"]. "<br>";
        }
    } else {
        echo "Business not yet in system";
    }
}
$connection->close();
?>
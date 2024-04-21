<!DOCTYPE html>
<html>
<head>
    <title>Submit a Review</title>
</head>
<body>
<form method="post">
    <label>Business Name:</label><br>
    <input type="text" name="business"><br>
    <label>Review:</label><br>
    <input type="text" name="review"><br>
    <input type="submit" value="Submit Review">
</form>
</body>
<?php
    session_start();
    require_once("LoginToDatabase.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $business = $_POST['business'];
        $review = $_POST['review'];
    
        $query = "SELECT id, name, location_id FROM businesses WHERE name LIKE '%$business%'";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("s", $business);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $business_id = $row['id'];
            $location_id = $row['location_id'];
    
            $insert_query = "INSERT INTO reviews (business_id, location_id, review) VALUES (?, ?, ?)";
            $stmt = $connection->prepare($insert_query);
            $stmt->bind_param("iis", $business_id, $location_id, $review);
    
            if ($stmt->execute()) {
                echo "Review submitted successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Business not found!";
        }
    
        $stmt->close();
    }
    ?>
<form action='HomePage.php'>
<input type='Submit' value='Back to Home'>
</form>
<?php
$connection->close();
?>
</html>
<?php
$servername = "us-cdbr-iron-east-05.cleardb.net";
$username = "b5fd7e721a6e84";
$password = "4acba240";
$dbname = "heroku_3a83060270e607d"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



// make a query 
  
$sql = "SELECT deviceId, deviceName, deviceType FROM device";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "department id: ".$row["deviceId"] . ", name: ".$row["deviceName"]. ", college: ".$row["deviceType"]."<br>";
    }
} else {
    echo "0 results";
}

$conn -> close();
?>
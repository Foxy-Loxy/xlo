<head>
<meta charset="UTF-8">
</head>
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "cities";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM mytable";
$result = $conn->query($sql);

$n = 0;

$json;

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$json[$n] = $row;
    	$n++;
    }
} else {
    echo "0 results";
}

//var_dump($json);

$json = json_encode($json);

echo $json;


$conn->close();
?>

<?php
header('Content-Type: application/json');
// php config
$servername= 'localhost';
$username = 'softserv_admin';
$password = 'softserv';
$db = 'softserv';

// create a connection
$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// Set SQL query and input the partial course name
$sql_getstudents    = "SELECT * FROM STUDENTS";

$result_getstudents = mysqli_query($conn, $sql_getstudents);

$frommysql_getstudents = array(); //retrieve from assoc array

// GET students
while ($row_getstudents = mysqli_fetch_assoc($result_getstudents)) {
	$return_getstudents[] = $row_getstudents;
}
$getstudents = array();
for ($i = 0; $i < count($return_getstudents); $i++) {
	$utorid = $return_getstudents[$i]["UTORID"];
	$firstname = $return_getstudents[$i]["FIRSTNAME"];
	$lastname = $return_getstudents[$i]["LASTNAME"];
	$password = $return_getstudents[$i]["PASSWORD"];
	$getstudents["$utorid"] = array("firstname" => $firstname,
								   "lastname" => $lastname,
								   "password" => $password);
}

echo json_encode($getstudents);
mysqli_close($conn);

?>
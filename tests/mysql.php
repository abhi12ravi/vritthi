<?php 
	session_start();
	echo "Php part";

	$servername = getenv('OPENSHIFT_MYSQL_DB_HOST');
	$username = "adminDPUepnP";
	$password = "38E1d5whUcQE";
	$dbname = "vritthi";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "INSERT INTO users (firstname, secondname, email)
	VALUES ('John', 'Doe', 'john@example.com')";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();


?>
<!DOCTYPE html>
<html>
<head>
	<title>Random titlt</title>
</head>
<body>
	<p>HTML paragraph</p>
	<form method="post">
		<input type="text" name="userName" value="random">
		<input type = "submit">
	</form>

</body>
</html>
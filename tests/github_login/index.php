<?php
session_start();
if (isset($_SESSION['github_data'])) {
// Redirection to application home page. 
header("location: home.php");
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Github OAuth Login Demo using PHP </title>
</head>
<body>
	<div style="text-align:center">
	<a href="github_login.php"><img src="images/github_login.png" /></a>
	<br/>
		<a href="http://www.9lessons.info">www.9lessons.info</a>
	</div>
	
</body>
</html>
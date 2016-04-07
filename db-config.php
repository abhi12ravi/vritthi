<?php
define( "DB_SERVER", getenv('OPENSHIFT_MYSQL_DB_HOST'));
//define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'adminDPUepnP');
define('DB_PASSWORD', '38E1d5whUcQE');
define('DB_DATABASE', 'vritthi');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
if($db>0){
	echo "DB connection success!";
}
else{
	echo "DB conn FAIL";
}
?>
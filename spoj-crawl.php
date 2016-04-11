<?php
$url = 'http://www.spoj.com/users/abhi12ravi/';
$output = file_get_contents($url); 

echo "The type of output is: ";
print_r(gettype($output));
echo "<br>";

echo $output;
var_dump($output)

?>
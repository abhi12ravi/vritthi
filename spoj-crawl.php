<?php
$url = 'http://www.spoj.com/users/abhi12ravi/';
$output = file_get_contents($url); 

echo $output;

print_r($output);

?>
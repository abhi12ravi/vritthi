<?php
session_start();
include('db.php'); //Database Connection. 
if (!isset($_SESSION['github_data'])) {
// Redirection to application index page. 
//header("location: index.php");
}
else
{
$userdata=$_SESSION['github_data'];
$email = $userdata->email;
$fullName = $userdata->name;
$company = $userdata->company;
$blog = $userdata->blog;
$location = $userdata->location;
$github_id = $userdata->id;
$github_username = $userdata->login;
$profile_image = $userdata->avatar_url;
$github_url = $userdata->url;

$repos_url = $userdata->repos_url;
$orgs_url = $userdata->organizations_url;

var_dump($userdata);

$q=mysqli_query($connection,"SELECT id FROM github_users WHERE email='$email'");
if(mysqli_num_rows($c) == 0)
{
$count=mysqli_query($connection,"INSERT INTO github_users(email,fullname,company,blog,location,github_id,github_username,profile_image,github_url) VALUES('$email','$fullName','$company','$blog','$location','$github_id','$github_username','$profile_image','$github_url')");
}


echo "<pre>";
//print_r($userdata);
echo "</pre>";

echo "<h1>Welcome to ".$fullName."</h1>";

echo "<br> Repos URL:". $repos_url;
echo "<br> Orgs URL:". $orgs_url;



echo "<a href='logout.php'>Logout</a>";

}
?>
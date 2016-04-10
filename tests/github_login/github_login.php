<?php
require_once('Github_Lib/githubConfig.php');
require_once('Github_Lib/githubApi.php');			
if($_SERVER['REQUEST_METHOD'] == 'GET') 
{
if(isset($_GET['code']))
{
$git = new githubApi($config);
$git->getUserDetails();
$_SESSION['github_data']=$git->getAllUserDetails();
var_dump($_SESSION['github_data']);
header("Location: home.php");
}
else
{
$url = "https://github.com/login/oauth/authorize?client_id=".$config['client_id']."&redirect_uri=".$config['redirect_url']."&scope=user";
header("Location: $url");
}
}
?>
<?php	
	session_start();
	include('config.php');
	include('hybridauth/Hybrid/Auth.php');
	if(isset($_GET['provider']))
	{
		// init hybridauth
		$hybridauth = new Hybrid_Auth( $config );
		
		// try to authenticate with twitter
		$adapter = $hybridauth->authenticate( "Github" );
		
		// return Hybrid_User_Profile object intance
		//$user_profile = $adapter->getUserProfile();
		
		//echo "Hi there! " . $user_profile->displayName;
	}
 ?>
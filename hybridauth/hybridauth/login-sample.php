<?php
        session_start();
        include('config.php');
        include('hybridauth/Hybrid/Auth.php');
        if(isset($_GET['provider']))
        {
        	$provider = $_GET['provider'];
        	
        	try{
        	
        	$hybridauth = new Hybrid_Auth( $config );
        	
        	$authProvider = $hybridauth->authenticate($provider);

                $user_timeline = $authProvider->getUserActivity( "timeline" );

	        $user_profile = $authProvider->getUserProfile();
	        
			if($user_profile && isset($user_profile->identifier))
	        {
	        	echo "<div align='center'>
                <h1>Login with Twitter</h1>   <a href='login-sample.php?provider=Twitter'><img src='twitter.png'></img></a> <img src='http://vritthi-abhi12ravi.rhcloud.com/img/tick_16.png'></img><br><br>
                </div>";

                define( "DB_SERVER", getenv('OPENSHIFT_MYSQL_DB_HOST'));
                //define('DB_SERVER', 'localhost');
                define('DB_USERNAME', 'adminDPUepnP');
                define('DB_PASSWORD', '38E1d5whUcQE');
                define('DB_DATABASE', 'vritthi');

                $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
                if($db){
                    echo "DB connection success!";

                    $query = mysqli_query($db,"SELECT * FROM `users` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'");
                    $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
                    if (!empty($result)) {
                        # User is already present
                    } else {
                        #user not present. Insert a new Record
                        $query = mysqli_query($db,"INSERT INTO `users` (oauth_provider, oauth_uid, username,email,twitter_oauth_token,twitter_oauth_token_secret) VALUES ('$oauth_provider', $uid, '$username','$email')");
                        $query = mysqli_query($db,"SELECT * FROM `users` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'");
                        $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
                        return $result;
                    }
                    return $result;  
                }
                else{
                    echo "DB conn FAIL";
                }



	        }	        

			}
			catch( Exception $e )
			{ 
			
				 switch( $e->getCode() )
				 {
                        case 0 : echo "Unspecified error."; break;
                        case 1 : echo "Hybridauth configuration error."; break;
                        case 2 : echo "Provider not properly configured."; break;
                        case 3 : echo "Unknown or disabled provider."; break;
                        case 4 : echo "Missing provider application credentials."; break;
                        case 5 : echo "Authentication failed. "
                                         . "The user has canceled the authentication or the provider refused the connection.";
                                 break;
                        case 6 : echo "User profile request failed. Most likely the user is not connected "
                                         . "to the provider and he should to authenticate again.";
                                 $twitter->logout();
                                 break;
                        case 7 : echo "User not connected to the provider.";
                                 $twitter->logout();
                                 break;
                        case 8 : echo "Provider does not support this feature."; break;
                }

                // well, basically your should not display this to the end user, just give him a hint and move on..
                echo "<br /><br /><b>Original error message:</b> " . $e->getMessage();

                echo "<hr /><h3>Trace</h3> <pre>" . $e->getTraceAsString() . "</pre>";

			}
        
        }
?>
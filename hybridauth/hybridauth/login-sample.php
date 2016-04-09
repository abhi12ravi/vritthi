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

                    $screenName = $user_profile->displayName;

                    //$response1 = $authProvider->api()->get('users/show.json?screen_name=$screenName');

                    $response = $authProvider->api()->get('statuses/user_timeline.json');

                    echo "User statuses:".$response."<br>";

                    //print_r($response);
                    echo "Type of response variable:";
                    print_r(gettype($response));


                    foreach ($response as $value) {
                            # code...
                            echo $value;
                    }



                    // echo $response1;

                    // $responseObj = json_decode($response1);

                    // print_r($responseObj);

                    echo "<b>Name</b> :".$user_profile->displayName."<br>";
                    echo "<b>Profile URL</b> :".$user_profile->profileURL."<br>";
                    echo "<b>Image</b> :".$user_profile->photoURL."<br> ";
                    echo "<img src='".$user_profile->photoURL."'/><br>";
                    echo "<b>Email</b> :".$userEmail."<br>";  
                            //echo "<b>User profile variable:".$user_profile."<br>";                                        
                    echo "<br> <a href='logout.php'>Logout</a>";



                   

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

                   $fetchExisting = "SELECT * from users WHERE email = '$userEmail'";
                   $resultFetch = $conn->query($fetchExisting);

                   // if ($resultFetch == TRUE) {
                   //      echo "Fetch query ran successfully";
                   // } else {
                   //      echo "Fetch query Error: " . $sql . "<br>" . $conn->error;
                   // }

                   if (!empty($resultFetch)) {
                        //user already exists
                       $row = $result->fetch_array(MYSQLI_ASSOC);
                       printf ("%s (%s)\n", $row["firstname"], $row["email"]);

                   } else {
                        #user not present. Insert a new Record
                        $insertNewUser = "INSERT INTO `users` (firstname, email) VALUES ('$userName', '$userEmail')";
                        $resultNewUser = $conn->query($insertNewUser);
                        if ($resultNewUser === TRUE) {
                             echo "New record created successfully";
                        } else {
                             echo "Insert new user Error: " . $sql . "<br>" . $conn->error;
                        }

                   }
                   

                   // $sql = "INSERT INTO users (firstname, secondname, email)
                   // VALUES ('John', 'Doe', 'john@example.com')";

                   // if ($conn->query($sql) === TRUE) {
                   //     echo "New record created successfully";
                   // } else {
                   //     echo "Error: " . $sql . "<br>" . $conn->error;
                   // }

                   $conn->close();

                    // $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
                    // if($db){
                    //     echo "DB connection success! DB value=".$db;

                    //     $query = mysqli_query($db,"SELECT * FROM `users` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'");
                    //     $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
                    //     if (!empty($result)) {
                    //         # User is already present
                    //         echo "Result value=".$result;

                    //     } else {
                    //         #user not present. Insert a new Record
                    //         $query = mysqli_query($db,"INSERT INTO `users` (oauth_provider, oauth_uid, username,email,twitter_oauth_token,twitter_oauth_token_secret) VALUES ('$oauth_provider', $uid, '$username','$email')");
                    //         echo "Query value INSERT =".$query;                        
                    //         $query = mysqli_query($db,"SELECT * FROM `users` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'");
                    //         echo "Query value SELECT =".$query;
                    //         $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
                    //         echo "Result FETCH_ARRAY value=".$result;

                    //         return $result;
                    //     }
                    //     return $result;  
                    // }
                    // else{
                    //     echo "DB conn FAIL";
                    // }
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
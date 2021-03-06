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


                //$user_timeline = $authProvider->getUserActivity( "timeline" );

    	        $user_profile = $authProvider->getUserProfile();
    	        
    			if($user_profile && isset($user_profile->identifier))
    	        {
    	        	echo "<div align='center'>
                    <h1>Login with Twitter</h1>   <a href='login-sample.php?provider=Twitter'><img src='twitter.png'></img></a> <img src='http://vritthi-abhi12ravi.rhcloud.com/img/tick_16.png'></img><br><br>
                    </div>";

                    $screenName = $user_profile->displayName;

                    //$response1 = $authProvider->api()->get('users/show.json?screen_name=$screenName');

                    echo "<br>Var type of $screenName = ";
                    print_r(gettype($screenName));
                    echo "<br>";

                    var_dump($user_profile);


                    // echo $response1;

                    // $responseObj = json_decode($response1);

                    // print_r($responseObj);

                    echo "<b>Name</b> :".$user_profile->firstName."<br>";
                    echo "<b>Profile URL</b> :".$user_profile->profileURL."<br>";
                    echo "<b>Image</b> :".$user_profile->photoURL."<br> ";
                    echo "<img src='".$user_profile->photoURL."'/><br>";
                    echo "<b>Email</b> :".$userEmail."<br>";  
                            //echo "<b>User profile variable:".$user_profile."<br>";                                        
                    echo "<br> <a href='logout.php'>Logout</a>";

                    $userStatuses = $authProvider->api()->get( 'statuses/user_timeline.json?screen_name='.$screenName.'&count=199' );

                    echo "<br>Var type of $userStatuses = ";
                    print_r(gettype($userStatuses));
                    echo "<br>";

                     echo "Twitter texts = ";                 

                     $allStatuses = ""; //a string that contains all statuses


                    echo "<br> Running FOREACH loop <br>";

                    foreach ($userStatuses as $key => $object) {
                        echo $object->text;
                        $allStatuses .= $object->text; // concatenates statuses to one string
                        echo "<hr>";
                    }

                    echo "<b> Displaying size of concatenated string = <b>";                 

                    echo strlen($allStatuses);

                    //print_r($userStatuses);

                    //API request to get user email ID

                    $verifyUser = $authProvider->api()->get('account/verify_credentials.json?include_email=true');

                    echo "<br>Var type of verifyUser = ";
                    print_r(gettype($verifyUser));
                    echo "<br>";

                    //print_r($verifyUser);

                    $arrayObj = get_object_vars($verifyUser);

                    echo "<br>Printing arry of objects, email string = <br>";
                    //print_r($arrayObj);
                    print_r($arrayObj["email"]);
                                    

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

                   $twitterUserHandle = $user_profile->displayName;
                   $twitterFirstName = $user_profile->firstName;
                   $twitterEmailId = $arrayObj["email"];
                   //removing quotes in all the tweets to ensure they go into the db
                   $remove[] = "'";
                   $remove[] = '"';
                   $remove[] = "-"; // just as another example

                   $allStatusesFinal = str_replace( $remove, "", $allStatuses);
                   $_SESSION['user_tweet_text'] = $allStatusesFinal;


                   $fetchQuery = "SELECT id FROM `users` WHERE email='$twitterEmailId'";
                   $resultFetchQuery = $conn->query($fetchQuery);

                   if(mysqli_num_rows($resultFetchQuery) == 0){ // new user
                    $insertNewUser = "INSERT INTO `users` (firstname, email, handle, text_tweet) VALUES ('$twitterFirstName', '$twitterEmailId','$twitterUserHandle', '$allStatusesFinal')";
                    $resultNewUser = $conn->query($insertNewUser);
                    if ($resultNewUser == TRUE) {
                      echo "New record created successfully";
                    } else {
                            echo "Insert new user Error: " . $sql . "<br>" . $conn->error;
                         }
                   }
                   else{ //user already exists 
                    $updateQuery = "UPDATE `users` SET text_tweet='$allStatusesFinal' WHERE email='$twitterEmailId'";
                    $resultUpdateQuery = $conn->query($updateQuery);
                    if ($resultUpdateQuery == TRUE) {
                      echo "<br>Record updated successfully! <br>";
                    } else {
                            echo "<br> Update query Error: " . $sql . "<br>" . $conn->error;
                         }
                   }    

                   $conn->close();
                   header("location: ../../index1.php");
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
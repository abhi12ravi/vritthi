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

		//var_dump($userdata);

		$q=mysqli_query($connection,"SELECT id FROM github_users WHERE email='$email'");
		if(mysqli_num_rows($c) == 0)
		{
			$count=mysqli_query($connection,"INSERT INTO github_users(email,fullname,company,blog,location,github_id,github_username,profile_image,github_url) VALUES('$email','$fullName','$company','$blog','$location','$github_id','$github_username','$profile_image','$github_url')");
		}

		function get_remote_data($url, $post_paramtrs = false) {
		    $c = curl_init();
		    curl_setopt($c, CURLOPT_URL, $url);
		    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		    if ($post_paramtrs) {
		        curl_setopt($c, CURLOPT_POST, TRUE);
		        curl_setopt($c, CURLOPT_POSTFIELDS, "var1=bla&" . $post_paramtrs);
		    } curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
		    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
		    curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0");
		    curl_setopt($c, CURLOPT_COOKIE, 'CookieName1=Value;');
		    curl_setopt($c, CURLOPT_MAXREDIRS, 10);
		    $follow_allowed = ( ini_get('open_basedir') || ini_get('safe_mode')) ? false : true;
		    if ($follow_allowed) {
		        curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
		    }curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 9);
		    curl_setopt($c, CURLOPT_REFERER, $url);
		    curl_setopt($c, CURLOPT_TIMEOUT, 60);
		    curl_setopt($c, CURLOPT_AUTOREFERER, true);
		    curl_setopt($c, CURLOPT_ENCODING, 'gzip,deflate');
		    $data = curl_exec($c);
		    $status = curl_getinfo($c);
		    curl_close($c);
		    preg_match('/(http(|s)):\/\/(.*?)\/(.*\/|)/si', $status['url'], $link);
		    $data = preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/|\/)).*?)(\'|\")/si', '$1=$2' . $link[0] . '$3$4$5', $data);
		    $data = preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/)).*?)(\'|\")/si', '$1=$2' . $link[1] . '://' . $link[3] . '$3$4$5', $data);
		    if ($status['http_code'] == 200) {
		        return $data;
		    } elseif ($status['http_code'] == 301 || $status['http_code'] == 302) {
		        if (!$follow_allowed) {
		            if (empty($redirURL)) {
		                if (!empty($status['redirect_url'])) {
		                    $redirURL = $status['redirect_url'];
		                }
		            } if (empty($redirURL)) {
		                preg_match('/(Location:|URI:)(.*?)(\r|\n)/si', $data, $m);
		                if (!empty($m[2])) {
		                    $redirURL = $m[2];
		                }
		            } if (empty($redirURL)) {
		                preg_match('/href\=\"(.*?)\"(.*?)here\<\/a\>/si', $data, $m);
		                if (!empty($m[1])) {
		                    $redirURL = $m[1];
		                }
		            } if (!empty($redirURL)) {
		                $t = debug_backtrace();
		                return call_user_func($t[0]["function"], trim($redirURL), $post_paramtrs);
		            }
		        }
		    } return "ERRORCODE22 with $url!!<br/>Last status codes<b/>:" . json_encode($status) . "<br/><br/>Last data got<br/>:$data";
		}




		echo "<pre>";
		//print_r($userdata);
		echo "</pre>";

		echo "<h1>Welcome to ".$fullName."</h1>";

		echo "<br> Repos URL:". $repos_url;
		echo "<br> Orgs URL:". $orgs_url;

		//echo get_remote_data($repos_url);                                // GET request 


		$repoData = get_remote_data($repos_url);
		
		echo "<br>Var type of repoData = ";
		print_r(gettype($repoData));
		echo "<br>";

		$arrayRepoData = json_decode($repoData, true);

		echo "<br>Var type of arrayRepoData = ";
		print_r(gettype($arrayRepoData));
		echo "<br>";

		// echo "<br> JSON Decoded string:";
		// var_dump($arrayRepoData);
		// echo "<br>";


		echo "<br> Listing repos <br>";

		print_r($arrayRepoData[0]['name']);


		echo "<br> Listing Prog langs <br>";

		print_r($arrayRepoData[0]['language']);

		// foreach ($arrayRepoData as $key => $object) {
		//     echo "<br> Repo name: ".$object->name;
		//     echo "<hr>";
		// }

		$allLanguagesCount = array();


		echo "<br> Looping through: <br>";

		for ($i=0; $i <count($arrayRepoData) ; $i++) { 

			$progLang = $arrayRepoData[$i]['language']; 

			if (!empty($progLang)) { //checking NULL cases

				if(array_key_exists ($progLang, $allLanguagesCount)){
					echo "Prog lang exists, so incrementing value! <br>";
					$allLanguagesCount[$progLang]+=1;

				} else{
					echo "Adding new prog lang to array <br>";
					$allLanguagesCount[$progLang]=1;
				}

				print_r($progLang);
				
			}			

			echo "<br>";

		}

		echo "<br> <b> Total repo count = ". count($arrayRepoData). "<b>" ;

		print_r($allLanguagesCount);

		$_SESSION['user_prog_langs_count']=$allLanguagesCount;

		echo "<br> <a href='logout.php'>Logout</a>";

		if (!empty($allLanguagesCount)) {
			# code...
			//header("location: ../../index1.php");
		}

	}
?>
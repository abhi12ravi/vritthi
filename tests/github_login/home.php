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


		$urlFetch = file_get_contents($repos_url);

		echo "<br>Var type of urlFetch = ";
		print_r(gettype($urlFetch));
		echo "<br>";

		echo $urlFetch;

		echo "<a href='logout.php'>Logout</a>";

	}
?>
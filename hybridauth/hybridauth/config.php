<?php
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------
$config =array(
		"base_url" => "http://vritthi-abhi12ravi.rhcloud.com/hybridauth/hybridauth/hybridauth/index.php", 
		"providers" => array ( 

			"Google" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "XXXXXXXXXXXX", "secret" => "XXXXXXXX" ), 
			),

			"Github" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "814d73883b6f03e84fd1", "secret" => "2aa5f1769d14bfb8b693aaddf836cf3e99434670" ), 
			),

			"Twitter" => array ( 
				"enabled" => true,
				"keys"    => array ( "key" => "2WiquT7nJqNy5cJjpRGeLthYB", "secret" => "h2TUkP8k8q41jwQDpYISZnGMFTEwI8e1hhRD13Iz0HD3Fh1pxS" ) 
			),
		),
		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => false,
		"debug_file" => "",
	);

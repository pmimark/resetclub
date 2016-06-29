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
		"base_url" => "resetclub.stagingdevsite.com/dev/hybridauth/hybridauth/index.php", 
		"providers" => array (   

			"Google" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "282573492769-24739fkl1mi3nu3scqiu1guu9spjle10.apps.googleusercontent.com", "secret" => "rlbFA1Xh4M8YaXUIdjDKToEX" ), 
			),

			"Facebook" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "1706820956201572", "secret" => "bc958bb454e292b56e73903ff847e278" ), 
			),  

			"Twitter" => array ( 
				"enabled" => true,
				"keys"    => array ( "key" => "XXXXXXXX", "secret" => "XXXXXXX" ) 
			),
		),
		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => false,
		"debug_file" => "",
	);

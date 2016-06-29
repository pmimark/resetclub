<?php
include_once("inc/facebook.php"); //include facebook SDK
######### Facebook API Configuration ##########
$appId = '1706820956201572'; //Facebook App ID
$appSecret = 'bc958bb454e292b56e73903ff847e278'; // Facebook App Secret
$homeurl = 'http://resetclub.stagingdevsite.com/dev/fb/';  //return to home
$fbPermissions = 'email';  //Required facebook permissions

//Call Facebook API
$facebook = new Facebook(array(  
  'appId'  => $appId,
  'secret' => $appSecret

));
$fbuser = $facebook->getUser();
?>
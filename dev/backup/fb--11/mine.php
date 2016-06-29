<?php
 
$server = "oscuz.com";
 
$username = "oscuz_alluser";
 
$password = "Avis@123avis";
 
$database = "oscuz_fac";
 
$connId = mysql_connect($server,$username,$password) or die("Cannot connect to server");
 
$selectDb = mysql_select_db($database,$connId) or die("Cannot connect to database");
 
?>
<a href="https://www.facebook.com/dialog/oauth?client_id=250632871769042&redirect_uri=http://oscuz.com/wp/infinity/&scope=publish_stream,email" title="Signup with facebook">
 
<button>Signup with facebook</button>
 
</a>

<?php

$app_id = "250632871769042";
 
$app_secret = "b21ebdcfb8b0154e4f87ae49353e4cd8";
 
$my_url = "http://oscuz.com/wp/infinity/";
 
$token_url = "https://graph.facebook.com/oauth/access_token?"
 
. "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
 
. "&client_secret=" . $app_secret . "&code=" . $code . "&scope=publish_stream,email";
 
$response = @file_get_contents($token_url);
 
$params = null;
 
parse_str($response, $params);

$graph_url = "https://graph.facebook.com/me?access_token="
 
. $params['access_token'];

 
$user = json_decode(file_get_contents($graph_url));
 
$username = $user->username;
 
$email = $user->email;
 
$facebook_id = $user->id;

// check if user in db => login
 
$result = mysql_query("select * from `YOUR_TABLE_NAME` where `facebook_id`='$facebook_id'");
 
if (mysql_num_rows($result) == 1)
 
{
 
$usr = mysql_fetch_array($result);
 
$_SESSION['username'] = $usr['username'];
 
$_SESSION['uid'] = $usr['id'];
 
$_SESSION['access_token'] = $params['access_token'];
 
?>
 
<script>
 
top.location.href='home.php'
 
</script>
 
<?php
 
}
 
else // if user not in db
 
{
 
$join_date  = date('Y-m-d h:i:s');
 
$query = mysql_query("INSERT INTO `YOUR_TABLE_NAME` (username, email, facebook_id, join_date)
 
VALUES ('$username', '$email', '$facebook_id', '$join_date')");
 
$_SESSION['uid'] = mysql_insert_id();
 
$_SESSION['username'] = $username;
 
$_SESSION['access_token'] = $params['access_token'];
 
?>
 
<script>
 
top.location.href='welcome.php'
 
</script>
 
<?php
 
}

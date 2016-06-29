<?php
// Include config file
require_once('includes/config.php');

// Store request params in an array
$request_params = array
					(
					'METHOD' => 'DoDirectPayment', 
					'USER' => $api_username, 
					'PWD' => $api_password, 
					'SIGNATURE' => $api_signature, 
					'VERSION' => $api_version, 
					'PAYMENTACTION' => 'Sale', 					
					'IPADDRESS' => $_SERVER['REMOTE_ADDR'],
					'CREDITCARDTYPE' => 'Visa', 
					'ACCT' => '4357089604369011', 						
					'EXPDATE' => '022020',  			
					'CVV2' => '901', 
					
									
					'COUNTRYCODE' => 'US', 
					'ZIP' => '33770', 
					'AMT' => '100.00', 
					'CURRENCYCODE' => 'USD', 
					'DESC' => 'Testing Payments Pro' 
					);
					
// Loop through $request_params array to generate the NVP string.
$nvp_string = '';
foreach($request_params as $var=>$val)
{
	$nvp_string .= '&'.$var.'='.urlencode($val);	
}

// Send NVP string to PayPal and store response
$curl = curl_init();
		curl_setopt($curl, CURLOPT_VERBOSE, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_URL, $api_endpoint);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);

$result = curl_exec($curl);
//echo $result.'<br /><br />';
curl_close($curl);

// Parse the API response
$result_array = NVPToArray($result);

echo "<pre>";
print_r($result_array);
echo "</pre>";

echo "Ack=".$result_array['ACK']."<br>";
echo "AMT=".$result_array['AMT']."<br>";
echo "TRANSACTIONID=".$result_array['TRANSACTIONID']."<br>";
echo "L_LONGMESSAGE0=".$result_array['L_LONGMESSAGE0']."<br>";

if($result_array['ACK']=="Success")
{
	echo "Ack=".$result_array['ACK']."<br>";
	echo "AMT=".$result_array['AMT']."<br>";
	echo "TRANSACTIONID=".$result_array['TRANSACTIONID']."<br>";
	echo "TIMESTAMP=".$result_array['TIMESTAMP']."<br>";
}
if($result_array['ACK']=="Failure")
{
	echo "Ack=".$result_array['ACK']."<br>";
	echo "AMT=".$result_array['AMT']."<br>";
	echo "L_LONGMESSAGE=".$result_array['L_LONGMESSAGE0']."<br>";
	echo "TIMESTAMP=".$result_array['TIMESTAMP']."<br>";
}	

// Function to convert NTP string to an array
function NVPToArray($NVPString)
{
	$proArray = array();
	while(strlen($NVPString))
	{
		// name
		$keypos= strpos($NVPString,'=');
		$keyval = substr($NVPString,0,$keypos);
		// value
		$valuepos = strpos($NVPString,'&') ? strpos($NVPString,'&'): strlen($NVPString);
		$valval = substr($NVPString,$keypos+1,$valuepos-$keypos-1);
		// decoding the respose
		$proArray[$keyval] = urldecode($valval);
		$NVPString = substr($NVPString,$valuepos+1,strlen($NVPString));
	}
	return $proArray;
}
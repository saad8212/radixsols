<?php
require_once('dbclass.php');
/*
Read POST data
reading posted data directly from $_POST causes serialization
issues with array data in POST.
Reading raw POST data from input stream instead.
*/
define("IPN_LOG_FILE", "ipn.log");
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
	$keyval = explode ('=', $keyval);
	if (count($keyval) == 2)
		$myPost[$keyval[0]] = urldecode($keyval[1]);
}

// Build the body of the verification post request, 
// adding the _notify-validate command.
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
	$get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
	if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
		$value = urlencode(stripslashes($value));
	} else {
		$value = urlencode($value);
	}
	$req .= "&$key=$value";
}

 
$ch = curl_init(PAYPAL_URL);
if ($ch == FALSE) {
	return FALSE;
}
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSLVERSION, 6);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

/*
This is often required if the server is missing a global cert
bundle, or is using an outdated one.
Please download the latest 'cacert.pem' from 
http://curl.haxx.se/docs/caextract.html
*/
if (LOCAL_CERTIFICATE == TRUE) {
	curl_setopt($ch, CURLOPT_CAINFO, __DIR__ . "/cert/cacert.pem");
}

// Set TCP timeout to 30 seconds
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Connection: Close',
	'User-Agent: PHP-IPN-Verification-Script'
));

$res = curl_exec($ch);

// cURL error
if (curl_errno($ch) != 0){
	curl_close($ch);
	exit;
} else {
	curl_close($ch);
}

/* 
 * Inspect IPN validation result and act accordingly 
 * Split response headers and payload, a better way for strcmp 
 */
$tokens = explode("\r\n\r\n", trim($res));
$res = trim(end($tokens));
if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) {
	// assign posted variables to local variables
	$name = $_POST['name'];
	 
	 
	$price = $_POST['price'];
	$total_price = $_POST['total_price'];
	 // $payer_email = $_POST['payer_email'];

	// check that receiver_email is your PayPal business email
	if (strtolower($receiver_email) != strtolower(PAYPAL_EMAIL)) {
		error_log(date('[Y-m-d H:i e] ').
			"Invalid Business Email: $req" . PHP_EOL, 3, IPN_LOG_FILE);
		exit();
	}

	// check that payment currency is correct
	if (strtolower($currency) != strtolower(CURRENCY)) {
		error_log(date('[Y-m-d H:i e] '). 
			"Invalid Currency: $req" . PHP_EOL, 3, IPN_LOG_FILE);
		exit();
	}

	//Check Unique Transcation ID
	$db = new DB;
	
		$db->query("INSERT INTO `payment`
			(`name`, `price`,
				 `total_price`)
			VALUES
			(:name, :price, 
				:total_price)");
		$db->bind(":name", $name);
	 
		$db->bind(":price", $price);
		$db->bind(":total_price", $total_price);
		 
		$db->execute();
		/* error_log(date('[Y-m-d H:i e] '). 
		"Verified IPN: $req ". PHP_EOL, 3, IPN_LOG_FILE);
		*/
	} 
	$db->close();
	
} else if (strcmp($res, "INVALID") == 0) {
	//Log invalid IPN messages for investigation
	error_log(date('[Y-m-d H:i e] '). 
		"Invalid IPN: $req" . PHP_EOL, 3, IPN_LOG_FILE);
}
?>
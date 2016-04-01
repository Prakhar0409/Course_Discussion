<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
	session_start();
	require_once __DIR__.'./facebook-php-sdk-v4-5.0.0/src/Facebook/autoload.php';


	$fb = new Facebook\Facebook([
	  'app_id' => '996700463749753',
	  'app_secret' => '256eb1462ea537c24989a2f2190e3a1b',
	  'default_graph_version' => 'v2.5',
	]);




//	$fb = new Facebook\Facebook([/* */]);

	$jsHelper = $fb->getJavaScriptHelper();

	$signedRequest = $jsHelper->getSignedRequest();

	if ($signedRequest) {
	  $payload = $signedRequest->getPayload();
	  var_dump($payload);
	}

$helper = $fb->getJavaScriptHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  echo 'No cookie set or no OAuth data could be obtained from cookie.';
  exit;
}

// Logged in
echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());

$_SESSION['fb_access_token'] = (string) $accessToken;

// User is logged in!
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');





	foreach (getallheaders() as $name => $value) {
		echo "$name: $value <br/>";
	}
	?>


</body>
</html>
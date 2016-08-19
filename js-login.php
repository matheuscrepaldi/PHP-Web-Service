<?php


    require_once('autoload.php');
    require_once('src/Facebook/Facebook.php');
//use Facebook\Facebook;
# /js-login.php
$fb = new Facebook\Facebook([
  'app_id' => '1120295274701582',
  'app_secret' => '7c972e119a08b83e112b7ac76cc0f84c',
  'default_graph_version' => 'v2.7',
  ]);


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


?>
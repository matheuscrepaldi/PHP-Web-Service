<?php
session_start();
require_once __DIR__ . '/src/Facebook/autoload.php';
require_once('../class.user.php');

$fb = new Facebook\Facebook([
  'app_id' => '1120295274701582',
  'app_secret' => '7c972e119a08b83e112b7ac76cc0f84c',
  'default_graph_version' => 'v2.5'
]);

$helper = $fb->getJavaScriptHelper();

try {
  $accessToken = $helper->getAccessToken();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
}

if (isset($accessToken)) {
   $fb->setDefaultAccessToken($accessToken);

  try {
  
    $requestProfile = $fb->get("/me?fields=name,email");
    $profile = $requestProfile->getGraphNode()->asArray();
      
    $usuario = new USER();
    $usuario->register($profile['name'], $profile['email'], $profile['id']);
    $usuario->doLogin($profile['name'],$profile['email'],$profile['id']);  
    
      
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
  }
    echo "cade?";
  //$_SESSION['user_session'] = $profile['name'];
  //print_r($profile);
  header('Location: ../index2.php');
  exit;
} else {
    echo "Unauthorized access!!!";
    exit;
}

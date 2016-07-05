<?php
require 'facebook/autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;

FacebookSession::setDefaultApplication('APP_ID', 'APP_SECRET');

$helper = new FacebookRedirectLoginHelper('D:\TCC\sistema\arquivo2.php');
$loginUrl = $helper->getLoginUrl();
echo "login via php";
?>


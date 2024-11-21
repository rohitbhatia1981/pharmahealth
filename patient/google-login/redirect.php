<?php
require_once 'vendor/autoload.php';
 
// init configuration
$clientID = '583365414058-bdhl4c5svtorn2td4n3p8ba6n2jqg0kk.apps.googleusercontent.com';
$clientSecret = 'RYDLwLGoVUAAPwvMmZ5b53yh';
$redirectUri = 'https://www.aifinrecruits.com/member/google-login/redirect.php';
  
// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");
 
// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);
  
  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
$email =  $google_account_info->email;
$name =  $google_account_info->name;
 
  // now you can use this profile info to create account in your website and make user logged in.
} else {
  echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
}
?>
<?php

require_once 'vendor/autoload.php';



// init configuration
$clientID = '22397442668-7qapk9qm4gqspl2bdanpt7eud4b556mu.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/Iskawt/app/welcome.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");


include('db.php');

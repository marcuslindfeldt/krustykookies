<?php
require '../vendor/autoload.php';

$app = new \Slim\Slim();

// Define the index route
$app->get('/', function () {
	echo "This is the index page";
});

// Define a HTTP GET route, access from /hello/world
$app->get('/hello/:name', function ($name) {
	echo "Hello, $name";
});

$app->run();
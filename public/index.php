<?php
require '../config/config.php';
require '../vendor/autoload.php';

use \Slim\Slim,
	\Slim\Extras\Views\Mustache,
	\Krusty\Service\OrderService;

// Set dir for template engine
Mustache::$mustacheDirectory = __DIR__ . '/../vendor/mustache/mustache/src/Mustache/';

// Init framework
$app = new Slim([
	'view' => new Mustache(),
	'templates.path' => TEMPLATE_DIR
]);


// Init services
$orderService = new OrderService();
//...


// Define the index route
$app->get('/', function () use ($app) {
	$app->render('index.tpl');
});

// List all orders
$app->get('/orders', function() use ($app, $orderService) {
	// get orders from order service
	if( ($orders = $orderService->fetchOrders()) != null ){
	var_dump($orders);
	}
});

// List information about a specific order
$app->get('/orders/:id', function($id) use ($app, $orderService) {
	// get orders from order service
	if( ($order = $orderService->fetchOrders($id)) != null ){
	var_dump($order);
	}
});

// Define more routes
// ...

$app->run();
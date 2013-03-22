<?php
require '../config/config.php';
require '../vendor/autoload.php';

use \Slim\Slim,
	\Slim\Extras\Views\Mustache,
	\Krusty\Service\OrderService,
	\Krusty\Service\CustomerService,
	\Krusty\Service\RecipieService,
	\Krusty\Service\CookieService;

// Set dir for template engine
Mustache::$mustacheDirectory = __DIR__ . '/../vendor/mustache/mustache/src/Mustache/';

// Init framework
$appArray=array();
$appArray['view']=new Mustache();
$appArray['templates.path']=TEMPLATE_DIR;
$app = new Slim($appArray);

// Init services
$orderService = new OrderService();
$customerService = new CustomerService();
$recipieService = new RecipieService();
$cookieService = new CookieService();
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

// List all customers
$app->get('/customers', function() use ($app, $customerService) {
	// get orders from order service
	if( ($customers = $customerService->fetchCustomers()) != null ){
	var_dump($customers);
	}
});

// List a recipie
$app->get('/recipies/:cookie', function ($cookie) use ($app, $recipieService) {
	if( ($recipie = $recipieService->fetchRecipie($cookie)) != null ){
	var_dump($recipie);
	}else{
		print 'Recipie not found!';
	}
});

//List all Cookies

$app->get('/cookies', function() use ($app, $cookieService){
	//get cookie from cookie service
	if(($cookies = $cookieService-> fetchCookies()) != null){
		var_dump($cookies);	
	}
});

$app->get('/cookies/:cookie', function($cookie) use ($app, $cookieService){
	
	//get cookie from cookie service
	if(($cookies = $cookieService->fetchCookies($cookie)) != null){	
		var_dump($cookies);	
	}
});

// Define more routes
// ...

$app->run();

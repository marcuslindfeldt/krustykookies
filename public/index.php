<?php
require '../config/config.php';
require '../vendor/autoload.php';

use \Slim\Slim,
	\Slim\Extras\Views\Mustache,
	\Slim\Middleware\SessionCookie,
	\Krusty\Service\OrderService,
	\Krusty\Service\CustomerService,
	\Krusty\Service\RecipieService,
	\Krusty\Service\CookieService,
	\Krusty\Service\IngredientService,
	\Krusty\Service\PalletService,
	\Krusty\Service\BlockedService;

// Set dir for template engine
Mustache::$mustacheDirectory = __DIR__ . '/../vendor/mustache/mustache/src/Mustache/';

// Init framework
$appArray=array();
$appArray['view']=new Mustache();
$appArray['templates.path']=TEMPLATE_DIR;
$app = new Slim($appArray);
$app->add(new SessionCookie());

// Init services
$orderService = new OrderService();
$customerService = new CustomerService();
$recipieService = new RecipieService();
$palletService = new PalletService();
$cookieService = new CookieService();
$ingredientService = new IngredientService();
$blockedService = new BlockedService();
//...

// Define the index route
$app->get('/', function () use ($app) {
	$app->render('header.tpl');
	$app->render('index.tpl');
	$app->render('footer.tpl');
});

// List all orders
$app->get('/orders', function() use ($app, $orderService) {
	$orders = $orderService->fetchOrders();
	$app->render('header.tpl', array(
		'heading' => "Orders",
		'subheading' => "administrate & track orders"
    ));
	$app->render('orders.tpl', array('orders' => $orders));
	$app->render('footer.tpl');
});

// List information about a specific order
$app->get('/orders/:id', function($id) use ($app, $orderService, $palletService) {
	if( ($order = $orderService->fetchOrders($id)) == null ){
		//Not found, redirect to 404
		$app->notFound();
	}
	$orderedPallets = $palletService->fetchOrderedPallets($order);
	$app->render('header.tpl', array(
		'heading' => "Order Details",
		'subheading' => "#{$order->order_id}, {$order->customer}"
    ));
	$app->render('order_details.tpl', 
			array('order' => $order,
  				  'pallets' => $orderedPallets));
	$app->render('footer.tpl');	
});

//List all Cookies
$app->get('/cookies', function() use ($app, $cookieService, $ingredientService, $blockedService){
	//get cookie array from cookie service
	$cookies = $cookieService-> fetchCookies();
	$ingredients = $ingredientService->fetchIngredients();
	$blocked = $blockedService->fetchBlocked();
	$app->render('header.tpl', array(
		'heading' => "Products",
		'subheading' => "Mmm, yummy KrustyKookies"
    ));
	$app->render('cookies.tpl', array(
		'cookies' => $cookies,
		'ingredients' => $ingredients,
		'cookies' => $cookies,
		'blocked' => $blocked
	));
	$app->render('footer.tpl');	

});

// List recipie for a cookie
$app->get('/cookies/:id', function ($id) use ($app, $recipieService) {
	$cookie = urldecode($id);
	if( ($recipie = $recipieService->fetchRecipie($cookie)) == null ){
		//Not found, redirect to 404
		$app->notFound();
	}
	$app->render('header.tpl', array(
		'heading' => "Recipie",
		'subheading' => $recipie->name
    ));
	$app->render('cookie_details.tpl', 
			array('recipie' => $recipie));
	$app->render('footer.tpl');	
});

$app->post('/cookies', function() use ($app, $recipieService) {
	// Get the post data
	$data = $app->request()->post();
	// Add cookie, create flash message
	if($recipieService->addRecipie($data)){
		$app->flash('success', 'You successfully added a new cookie!');
	}else{
		// maybe catch exception instead and show more
		// descriptive message to the user
		$app->flash('error', 'Oops, something went wrong. Please try again!');
	$app->redirect('/cookies');
	}
	// redirect to show flash message
});

// Block cookie
$app->post('/blocked', function() use ($app, $blockedService){
	$req = $app->request()->post();
	try{
		$result = $blockedService->block($req);
		$app->flash('success', "{$result->cookie} has been blocked until {$result->end}.");
	}catch(\Exception $e){
		$app->flash('error',"{$e->getMessage()}");
	}
	$app->redirect('/cookies');
	
});

// Unblock cookie
$app->delete('/blocked/:id', function($id) use ($app){
	$app->flash('error', 'Not implemented!');
	$app->redirect('/cookies');
});

// List all customers
$app->get('/customers', function() use ($app, $customerService) {
	$customers = $customerService->fetchCustomers();
	$app->render('header.tpl', array(
		'heading' => "Customers"
    ));
	$app->render('customers.tpl', 
			array('customers' => $customers));
	$app->render('footer.tpl');	
});

// List all ingredients
$app->get('/ingredients', function() use ($app, $ingredientService) {
	$ingredients = $ingredientService->fetchIngredients();
	$app->render('header.tpl', array(
		'heading' => "Ingredients"
    ));
	$app->render('ingredients.tpl', array('ingredients' => $ingredients));
	$app->render('footer.tpl');
});

// List all pallets in storage, and their status
$app->get('/pallets', function() use ($app, $palletService, $cookieService)
{
	$pallets = $palletService->fetchProducedPallets();
	$cookies = $cookieService->fetchCookies();
	$app->render('header.tpl', array(
		'heading' => "Pallets",
		'subheading' => "view & track produced cookie pallets"
     ));
	$app->render('pallets.tpl', array(
		'pallets' => $pallets,
		'cookies' => $cookies
	));
	$app->render('footer.tpl');
});

// Simulate pallet production
$app->post('/pallets', function () use ($app, $palletService)
{
	$data = $app->request()->post();
	try{
		$palletService->producePallets($data);
		$plural = ($data['amount'] > 1) ? 's' : '';
		$app->flash('success', "Produced {$data['amount']} pallet{$plural} of {$data['cookies']} cookies.");
	}catch(Exception $e){
		$app->flash('error', "{$e->getMessage()}");
	}
	$app->redirect('/pallets');
});
		
// Define more routes
// ...

$app->run();

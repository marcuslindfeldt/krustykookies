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
	// get orders from order service
	$orders = $orderService->fetchOrders();
	$app->render('header.tpl');
	$app->render('orders.tpl', array('orders' => $orders));
	$app->render('footer.tpl');
});

// List information about a specific order
$app->get('/orders/:id', function($id) use ($app, $orderService, $palletService) {
	// get orders from order service
	if( ($order = $orderService->fetchOrders($id)) == null ){
		//Not found, redirect to 404
		$app->notFound();
	}
	$orderedPallets = $palletService->fetchOrderedPallets($order);

	$app->render('header.tpl');
	$app->render('order_details.tpl', 
			array('order' => $order,
  				  'pallets' => $orderedPallets));
	$app->render('footer.tpl');	
});

// List all customers
$app->get('/customers', function() use ($app, $customerService) {
	// fetch customers
	$customers = $customerService->fetchCustomers();
	// render customer page
	$app->render('header.tpl');
	$app->render('customers.tpl', 
			array('customers' => $customers));
	$app->render('footer.tpl');	
});


//List all Cookies
$app->get('/cookies', function() use ($app, $cookieService, $ingredientService){
	//get cookie array from cookie service
	$cookies = $cookieService-> fetchCookies();
	$ingredients = $ingredientService->fetchIngredients();
	// var_dump($ingredients);	
	$app->render('header.tpl');
	$app->render('cookies.tpl', 
			array('cookies' => $cookies,
				  'ingredients' => $ingredients));
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
	}
	// redirect to show flash message
	$app->redirect('/cookies');
});


// List a recipie
$app->get('/cookies/:id', function ($id) use ($app, $recipieService) {
	$cookie = urldecode($id);
	if( ($recipie = $recipieService->fetchRecipie($cookie)) == null ){
		//Not found, redirect to 404
		$app->notFound();
	}

	$app->render('header.tpl');
	$app->render('cookie_details.tpl', 
			array('recipie' => $recipie));
	$app->render('footer.tpl');	
});

// List all pallets in storage, and their status
$app->get('/pallets', function() use ($app, $palletService){
	$app->render('header.tpl');
	//get cookie from cookie service
	if(($pallets = $palletService->fetchProducedPallets()) != null){
		$app->render('pallets.tpl', array('pallets' => $pallets));
	}
	$app->render('footer.tpl');
});
$app->get('/pallets/:blocked', function($blocked) use ($app, $blockedService, $palletService){
	$app->render('header.tpl');
	$blockedc=$blockedService->fetchBlocked($blocked);
	$blockingObj=$blockedc[0]; //this is the <Blocked> object
	
	//get cookie from cookie service
	if(($pallets = $palletService->fetchProducedPallets($blockingObj->start, $blockingObj->end, $blockingObj->cookie)) != null){
			$app->render('pallets.tpl', array('pallets' => $pallets));
	}else{
		echo "no pallets concerend by that blocking";
	}
	$app->render('footer.tpl');
});

// List all ingredients
$app->get('/ingredients', function() use ($app, $ingredientService) {
	$app->render('header.tpl');
	// get ingredients from ingredient service
	if( ($ingredients = $ingredientService->fetchIngredients()) != null){
		$app->render('ingredient_details.tpl', array('ingredients' => $ingredients));
	}
	$app->render('footer.tpl');
});
		
$app->get('/blocked', function() use ($app, $blockedService){
	$app->render('header.tpl');
	if(($blocked = $blockedService->fetchBlocked()) != null){
		$app->render('block_list.tpl', 
			array('blocks' => $blocked));
	}
	$app->render('block_cookie.tpl');
});

$app->post('/unblock', function() use ($app, $blockedService){ 	
	if($app->request()->post("ub")!=null){
		$blockedService->unblock($app->request()->post("blocked_id"));
		$app->redirect('/blocked');
	}else if($app->request()->post("vp")!=null){
		
		$app->redirect('/pallets/'.$app->request()->post("blocked_id"));
		//$blockedService->unblock($app->request()->post("blocked_id"));
	}
	
		
	
});

$app->post('/blocked', function() use ($app, $blockedService){

	$cookie=$app->request()->post('cookie');
	$end= $app->request()->post('end');
		if(($blocked = $blockedService->block($cookie, $end)) != null){
			$app->redirect('/blocked');
			//print "blocking ".$cookie." until ".$end;
		}else{
			print "block failed!";
		}
	
});

// Define more routes
// ...

$app->run();

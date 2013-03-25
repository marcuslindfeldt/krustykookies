<?php
require '../config/config.php';
require '../vendor/autoload.php';

use \Slim\Slim,
	\Slim\Extras\Views\Mustache,
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
$app->get('/orders/:id', function($id) use ($app, $orderService, $palletService) {
	// get orders from order service
	if( ($order = $orderService->fetchOrders($id)) != null ){
		$orderedPallets = $palletService->fetchOrderedPallets($order);

		var_dump($order);
		if(count($orderedPallets) <= 0){
			print "Woops, an order for nothing";
		}else{
			var_dump($orderedPallets);
		}

	}else{
		print "Could not find order with order id: " . $id;
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


// List produced pallets
$app->get('/pallets', function() use ($app, $palletService){
	//get cookie from cookie service
	if(($pallets = $palletService->fetchProducedPallets()) != null){
		var_dump($pallets);	
	}
});

$app->get('/cookies/:cookie', function($cookie) use ($app, $cookieService){
	
	//get cookie from cookie service
	if(($cookies = $cookieService->fetchCookies($cookie)) != null){	
		var_dump($cookies);	
	}
});

// List all ingredients
$app->get('/ingredients', function() use ($app, $ingredientService) {
	// get ingredients from ingredient service
	if( ($ingredients = $ingredientService->fetchIngredients()) != null){
		var_dump($ingredients);
	}
});
		
$app->get('/blocked', function() use ($app, $blockedService){
	print "<p>Block cookies:</p><hr>";
	if(($blocked = $blockedService->fetchBlocked()) != null){
		for($i=0;$i<count($blocked);$i++){
			echo "<p><dd>";
			echo  $blocked[$i]->cookie."<br>";
			echo "from: ".$blocked[$i]->start."<br>";
			echo "until: ".$blocked[$i]->end."<br>"; 
			echo "</p></dd><hr>";
		}
	}
	$app->render('block.tpl');
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

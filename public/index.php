<?php
require '../vendor/autoload.php';

use \Slim\Slim,
	\Slim\Middleware\SessionCookie,
	\Slim\Extras\Middleware\StrongAuth,
	\Krusty\Config,
	\Krusty\KrustyView;	

define("APPLICATION_PATH", __DIR__ . '/..');

$config = Config::instance();
// Initialize framework
$app = new Slim(array(
    'templates.path' => $config->template_dir,
    'view' => new KrustyView()
));

// Add session cookie for flash messages
$app->add(new SessionCookie());
// Add basic authentication (user = admin, pass = password)/opa
$app->add(new StrongAuth($config->auth));

// Init services

$serviceLocator = function ($name, array $options = null) {

	$class = '\\Krusty\\Service\\' . ucfirst($name) . 'Service';
	if(class_exists($class)){
		return new $class($options);
	} 
};

// Define the index route
$app->get('/', function () use ($app) {
	$app->render('index.tpl');
});

$app->get('/login', function () use ($app) {
	$app->render('login.tpl');
});

$app->post('/login', function () use ($app) {
	$auth = \Strong\Strong::getInstance();
	$user = $app->request()->post('username');
	$pass = $app->request()->post('password');

    if ($auth->login($user, $pass)) {
        $app->flash('info', "Successfully logged in as {$user}.");
        $app->redirect('/orders');
    }

    $app->redirect('/login');
});

$app->get('/logout', function () use ($app) {
	$auth = \Strong\Strong::getInstance();
    if ($auth->logout()){
        $app->flash('info', "You're now logged out. Have a nice day!");
    }
    $app->redirect('/');
});

// List all orders
$app->get('/orders', function() use ($app, $serviceLocator) {
	$orders = $serviceLocator('order')->fetchOrders();
	$cookies = $serviceLocator('cookie')-> fetchCookies();
	$customers = $serviceLocator('customer')-> fetchCustomers();
	$app->render('orders.tpl', array(
		'heading' => "Orders",
		'subheading' => "administrate & track orders",
		'orders' => $orders,
		'customers' => $customers,
		'cookies' => $cookies
	));
});

// Add a new order
$app->post('/orders', function() use ($app, $serviceLocator) {
	$data = $app->request()->post();
	try{
		$serviceLocator('order')->putOrder($data);
		$app->flash('success', 'You successfully added a new order!');
	}catch (\Exception $e){
		$app->flash('error', $e->getMessage());
	}
	$app->redirect('/orders');
});

// List information about a specific order
$app->get('/orders/:id', function($id) use ($app, $serviceLocator) {
	if( ($order = $serviceLocator('order')->fetchOrders($id)) == null ){
		//Not found, redirect to 404
		$app->notFound();
	}

	$orderedPallets = $serviceLocator('pallet')
		->fetchPalletsForOrder($order);

	$app->render('order_details.tpl', array(
		'order' => $order,
		'heading' => "Order Details",
		'subheading' => "#{$order->order_id}, {$order->customer}",
		'pallets' => $orderedPallets
	));
});

// Deliver order
$app->post('/orders/:id', function($id) use ($app, $serviceLocator) {
	try{
		
		$serviceLocator('order')->deliverOrder($id);
		$app->flash('success', 'Order has been delivered');
	}catch (\Exception $e){
		$app->flash('error', $e->getMessage());
	}
	$app->redirect('/orders/' . $id);
});

//List all Cookies
$app->get('/cookies', function() use ($app, $serviceLocator){
	//get cookie array from cookie service
	$cookies = $serviceLocator('cookie')-> fetchCookies();
	$ingredients = $serviceLocator('ingredient')->fetchIngredients()->getAdapter()->getArray();
	$blockService = $serviceLocator('blocked'); 
	$app->render('cookies.tpl', array(
		'heading' => "Products",
		'cookies' => $cookies,
		'ingredients' => $ingredients,
		'blocks' => $blockService->fetchActiveBlocks(),
		'prev_blocks' => $blockService->fetchPreviousBlocks(),
		'next_blocks' => $blockService->fetchUpcomingBlocks()
	));
});

// List recipe for a cookie
$app->get('/cookies/:id', function ($id) use ($app, $serviceLocator) {
	$cookie = urldecode($id);
	if( ($recipe = $serviceLocator('recipe')->fetchRecipe($cookie)) == null ){
		//Not found, redirect to 404
		$app->notFound();
	}
	$app->render('cookie_details.tpl', array(
		'heading' => "Recipe",
		'subheading' => $recipe->name,
		'recipe' => $recipe
	));
});

$app->post('/cookies', function() use ($app, $serviceLocator) {
	$data = $app->request()->post();
	try{
		$serviceLocator('recipe')->addRecipe($data);
		$app->flash('success', 'You successfully added a new cookie!');
	}catch (\Exception $e){
		$app->flash('error', $e->getMessage());
	}
	$app->redirect('/cookies');
});

// Block cookie
$app->post('/blocked', function() use ($app, $serviceLocator) {
	$req = $app->request()->post();
	try{
		$result = $serviceLocator('blocked')->block($req);
		$app->flash('success', "{$result->cookie} has been blocked until {$result->end}.");
	}catch(\Exception $e){
		$app->flash('error',"{$e->getMessage()}");
	}
	$app->redirect('/cookies');
	
});

// Unblock cookie
$app->delete('/blocked/:id', function($id) use ($app, $serviceLocator) {
	$app->flash('error', 'Not implemented!');
	$app->redirect('/cookies');
});

// List all customers
$app->get('/customers', function() use ($app, $serviceLocator) {
	$customers = $serviceLocator('customer')->fetchCustomers();
	$app->render('customers.tpl', array(
		'heading' => "Customers",
		'customers' => $customers
	));
});

// List all ingredients
$app->get('/ingredients', function() use ($app, $serviceLocator) {
	$options = $app->request()->get();
	$ingredients = $serviceLocator('ingredient', $options)
		->fetchIngredients();
	$app->render('ingredients.tpl', array(
		'heading' => "Ingredients",
		'ingredients' => $ingredients,
		'paginate' => array('ingredients')
	));
});

// Refill ingredient
$app->post('/ingredients', function() use ($app, $serviceLocator) {
	try{
		$post = $app->request()->post();
		$ingredient = $serviceLocator('ingredient')
			->refillIngredient($post);
		$app->flash('success', "{$ingredient->ingredient} has been refilled");
	}catch (Exception $e){
		$app->flash('error', "{$e->getMessage()}");
	}
	$app->redirect('/ingredients');
});

// List all pallets in storage, and their status
$app->get('/pallets', function() use ($app, $serviceLocator)
{
	$filters = $app->request()->get();
	$pallets = $serviceLocator('pallet', $filters)
		->fetchProducedPallets($filters);

	$cookies = $serviceLocator('cookie')->fetchCookies();

	// Repopulate cookie filter
	foreach ($cookies as $cookie) {
		if(isset($filters['cookie']) 
		   && $filters['cookie'] == $cookie->name){
			$cookie->selected = 'selected';
			break;
		}
	}
	$app->render('pallets.tpl', array(
		'heading' => "Pallets",
		'subheading' => "view & track cookie pallets",
		'pallets' => $pallets,
		'cookies' => $cookies,
		'filters' => $filters,
		'paginate' => array('pallets')
	));
});

// List all pallets in storage, and their status
$app->get('/pallets/:id', function($id) use ($app, $serviceLocator)
{
	$pallet = $serviceLocator('pallet')
		->fetchPalletDetails($id);
	$prev = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/pallets';
	$app->render('pallet_details.tpl', array(
		'heading' => "Pallet details",
		'pallet' => $pallet,
		'prev_page' => $prev,
		'subheading' => ""
	));
});

// Simulate pallet production
$app->post('/pallets', function () use ($app, $serviceLocator)
{
	try{
		$data = $app->request()->post();
		$serviceLocator('pallet')->producePallets($data);
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

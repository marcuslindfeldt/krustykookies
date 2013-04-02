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
// Add basic authentication (user = admin, pass = password)
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
	$app->render('orders.tpl', array(
		'heading' => "Orders",
		'subheading' => "administrate & track orders",
		'orders' => $orders));
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

//List all Cookies
$app->get('/cookies', function() use ($app, $serviceLocator){
	//get cookie array from cookie service
	$cookies = $serviceLocator('cookie')-> fetchCookies();
	$ingredients = $serviceLocator('ingredient')->fetchIngredients()->getAdapter()->getArray();
	$blocked = $serviceLocator('blocked')->fetchBlocked();
	$app->render('cookies.tpl', array(
		'heading' => "Products",
		'cookies' => $cookies,
		'ingredients' => $ingredients,
		'blocked' => $blocked
	));
});

// List recipie for a cookie
$app->get('/cookies/:id', function ($id) use ($app, $serviceLocator) {
	$cookie = urldecode($id);
	if( ($recipie = $serviceLocator('recipie')->fetchRecipie($cookie)) == null ){
		//Not found, redirect to 404
		$app->notFound();
	}
	$app->render('cookie_details.tpl', array(
		'heading' => "Recipie",
		'subheading' => $recipie->name,
		'recipie' => $recipie
	));
});

$app->post('/cookies', function() use ($app, $serviceLocator) {
	$data = $app->request()->post();
	try{
		$serviceLocator('recipie')->addRecipie($data);
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
		->fetchIngredients($options);
	$app->render('ingredients.tpl', array(
		'heading' => "Ingredients",
		'ingredients' => $ingredients,
		'paginate' => array('ingredients')
	));
});

// List all pallets in storage, and their status
$app->get('/pallets', function() use ($app, $serviceLocator)
{
	$options = $app->request()->get();
	$pallets = $serviceLocator('pallet', $options)
		->fetchProducedPallets();

	$cookies = $serviceLocator('cookie')->fetchCookies();
	$app->render('pallets.tpl', array(
		'heading' => "Pallets",
		'subheading' => "view & track produced cookie pallets",
		'pallets' => $pallets,
		'cookies' => $cookies,
		'paginate' => array('pallets')
	));
});

// Simulate pallet production
$app->post('/pallets', function () use ($app, $serviceLocator)
{
	$data = $app->request()->post();
	try{
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

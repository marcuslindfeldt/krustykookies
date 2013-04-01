<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="ISO-8859-1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Krusty Kookies</title>
	<!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="/css/style.css">
    <link href="/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
<!-- 	<link rel="stylesheet" href="/css/reset.css">
	<link rel="stylesheet" href="/css/style.css" type="text/css" media="screen" />
 --></head>
<body>
	<div id="wrap">
		<div class="navbar navbar-inverse navbar-fixed-top">
			<nav class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
         			 </button>
					<a href="/" class="brand"><strong>KrustyKookies</strong></a>
					{{#logged_in}}
					<a class="btn btn-primary pull-right" href="/logout"><i class="icon-user icon-white"></i> Logout</a>
					{{/logged_in}}
					{{^logged_in}}
					<a class="btn btn-primary pull-right" href="/login"><i class="icon-user icon-white"></i> Login</a>
					{{/logged_in}}
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li><a id="orders" href="/orders">Orders</a></li>
							<li><a id="cookies" href="/cookies">Cookies</a></li>
							<li><a id="customers" href="/customers">Customers</a></li>
							<li><a id="ingredients" href="/ingredients">Ingredients</a></li>
							<li><a id="pallets" href="/pallets">Pallets</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<div class="container">
		{{#heading}}
		<header class="page-header">
		  <h1>{{heading}} {{#subheading}}<small>{{subheading}}</small>{{/subheading}}</h1>
		</header>
		{{/heading}}
		{{#flash.getMessages}}
			{{#success}}
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Success!</strong> {{success}}
			</div>
			{{/success}}
			{{#info}}
			<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				{{info}}
			</div>
			{{/info}}
			{{#error}}
			<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error!</strong> {{error}}
			</div>
			{{/error}}
		{{/flash.getMessages}}


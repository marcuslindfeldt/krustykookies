<?php

namespace Krusty;

use \Slim\Extras\Views\Mustache,
\Pagerfanta\View\TwitterBootstrapView;

class KrustyView extends \Slim\Extras\Views\Mustache
{
	protected $paginatorView;

	public function __construct()
	{
		Mustache::$mustacheDirectory = APPLICATION_PATH . '/vendor/mustache/mustache/src/Mustache/';
		$this->paginatorView = new TwitterBootstrapView();
	}
	public function render($template)
	{
		// Breadcrumbs
		$url = parse_url($_SERVER["REQUEST_URI"]);
		$path = $url["path"];
		$options=null;
		if(isset($url["query"])){
			parse_str($url["query"], $options);
		}
		$crumbs = array_values(array_filter(explode("/",$path)));

		array_walk($crumbs, function(&$val,$key) use ($crumbs){
			$crumb = new \stdClass();
			$crumb->active = false;
			$crumb->uri = implode('/',array_slice($crumbs, 0, $key+1));
			$crumb->title = ucfirst(trim($val));
			$val = $crumb;
		});

		if(!empty($crumbs))
		end($crumbs)->active = true;

		$this->appendData(array('breadcrumbs' => $crumbs));

		// Paginator
		$pagerfantas = $this->getData('paginate');
		$routeGenerator = function($page) use ($path, $options) {
			if(isset($options["page"])){
				unset($options["page"]);
			}
			if(!empty($options)){
				return $path."?".http_build_query($options).'&page='.$page;
			}
			return $path .'?page='.$page;
		};
		if(is_array($pagerfantas)){
			$paginators = array();
			foreach ($pagerfantas as $value) {
				$data = $this->getData($value);
				if(!($data instanceof \Pagerfanta\PagerfantaInterface)){
					continue;
				}
				$paginators[$value.'_paginator'] = $this->paginatorView
				->render($data,
				$routeGenerator,
				array('css_container_class' => 'pagination',
                                   'prev_message' => '&laquo;',
                                   'next_message' => '&raquo;')
				);
			}
			$this->appendData($paginators);
		}

		// Authentication
		$auth = \Strong\Strong::getInstance();
		$this->appendData(array('logged_in' => $auth->loggedIn()));

		// Render
		$document  = parent::render('_header.tpl');
		$document .= parent::render($template);
		$document .= parent::render('_footer.tpl');
        return $document;
    }

}
<?php

namespace Krusty;

use \Slim\Extras\Views\Mustache;

class KrustyView extends \Slim\Extras\Views\Mustache
{	
	public function __construct()
	{
		Mustache::$mustacheDirectory = APPLICATION_PATH . '/vendor/mustache/mustache/src/Mustache/';

	}
    public function render($template)
    {
        $auth = \Strong\Strong::getInstance();
        $this->appendData(array('logged_in' => $auth->loggedIn()));
    	$document  = parent::render('_header.tpl'); 
    	$document .= parent::render($template);
    	$document .= parent::render('_footer.tpl'); 
    	return $document;
    }
}
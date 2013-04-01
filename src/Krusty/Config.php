<?php

namespace Krusty;

class Config
{
	private static $instance;
	private $config;

	private function __construct()
	{

      	$this->config = parse_ini_file(
			APPLICATION_PATH . '/config/application.ini', true);

      	// parse fix for auth array
      	foreach($this->config['auth']['security.urls'] as $key => $value){
      		$this->config['auth']['security.urls'][$key] = array('path' => $value);
      	}
	}

	public static function instance()
	{
		if(is_null(self::$instance)){
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function __get($name) {
	if (!isset($this->config[$name]))
	   throw new \Exception('Unknown setting '.$name);
	return $this->config[$name];
	}

	public function __set($name, $value) {
		$this->config[$name] = $value;
	}

}
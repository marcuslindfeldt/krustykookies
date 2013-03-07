<?php
namespace Krusty\Model;

/**
 * Singleton DbAdapter
 */
class DbAdapter
{
	private static $instance;

	private $db;

	private function __construct()
	{
		$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';';
		$db = new \PDO($dsn, DB_USER, DB_PASS);
	    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	    $db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
    	$this->db = $db;
	}

	public static function instance()	
	{
		if(!self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function getAdapter()
	{
		return $this->db;
	}
}
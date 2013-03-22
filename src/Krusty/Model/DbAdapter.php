<?php
namespace Krusty\Model;

/**
 * Singleton DbAdapter
 *
 */
class DbAdapter
{
	private static $instance;

	private $db;

	/**
	 * Create a connection to the database
	 * and store it in the global space.
	 */
	private function __construct()
	{
		$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';';
		$db = new \PDO($dsn, DB_USER, DB_PASS);
	    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	    $db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
    	$this->db = $db;
	}

	/**
	 * Retrieve DbAdapter instance
	 * @return [type] [description]
	 */
	public static function instance()	
	{
		if(!self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * 
	 * Fetch the DAO (Data access object)
	 * @return \PDO The pdo object
	 */
	public function getAdapter()
	{
		return $this->db;
	}
}
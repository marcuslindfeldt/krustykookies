<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\Cookie,
	\Krusty\Model\Mapper\AbstractMapper;

class CookieMapper extends AbstractMapper
{
	public function save(Cookie $cookie)
	{
		$sql  = 'INSERT INTO cookies ';
		$sql .= 'VALUES(:name, :description)';

		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);

		return $stmt->execute(array(
			'name' => $cookie->name,
			'description' => $cookie->description
		));
	}
	
	public function delete(Cookie $cookie)
	{
		$sql = 'DELETE FROM cookies WHERE name = :name';

		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);

		return $stmt->execute(array(
			'name' => $cookie->name
		));
	}

	public function fetchAll()
	{
		// $sql  = 'SELECT name, description, count(*) AS in_store, block_id ';
		// $sql .= 'FROM cookies LEFT JOIN produced_pallets p ON name = p.cookie ';
		// $sql .= 'LEFT JOIN blocked b ON name = b.cookie AND ';
		// $sql .= 'CURDATE() BETWEEN start AND end WHERE order_id IS NULL ';
		// $sql .= 'GROUP BY name ORDER BY name';

		$sql = 'SELECT name, description, block_id, in_store FROM Cookies LEFT JOIN Blocked ON (name = cookie AND CURDATE() BETWEEN start AND end) LEFT JOIN (SELECT name, count(*) AS in_store FROM Cookies INNER JOIN Produced_Pallets ON(name = cookie) WHERE order_id IS NULL GROUP BY name) B USING(name)';

		$stmt = $this->getAdapter()->query($sql);
		return $stmt->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Cookie");	
	}

	public function fetch($cookie)
	{
		$sql  = 'SELECT * FROM cookies ';
		$sql .= 'WHERE name = :name';

		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);

		$stmt->execute(array(
			'name' => $cookie
		));

		return $stmt->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Cookie");
	}
}
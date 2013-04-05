<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\Cookie,
	\Krusty\Model\Mapper\AbstractMapper;

class CookieMapper extends AbstractMapper
{
	public function save(Cookie $cookie)
	{
		$sql  = 'INSERT INTO Cookies ';
		$sql .= 'VALUES(:cookie, :description)';

		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);

		return $stmt->execute(array(
			'cookie' => $cookie->cookie,
			'description' => $cookie->description
		));
	}
	
	public function delete(Cookie $cookie)
	{
		$sql = 'DELETE FROM Cookies WHERE cookie = :cookie';

		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);

		return $stmt->execute(array(
			'cookie' => $cookie->cookie
		));
	}

	public function fetchAll()
	{
		$sql  = 'SELECT c.cookie, description, count(*) AS in_store, block_id ';
		$sql .= 'FROM Cookies c INNER JOIN ProducedPallets USING(cookie) ';
		$sql .= 'LEFT JOIN Blocked b ON b.cookie = c.cookie AND ';
		$sql .= 'CURDATE() BETWEEN start AND end WHERE order_id IS NULL ';
		$sql .= 'GROUP BY cookie ORDER BY c.cookie';

		
		$stmt = $this->getAdapter()->query($sql);
		return $stmt->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Cookie");	
	}

	public function fetch($cookie)
	{
		$sql  = 'SELECT * FROM Cookies ';
		$sql .= 'WHERE cookie = :cookie';

		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);

		$stmt->execute(array(
			'cookie' => $cookie
		));

		return $stmt->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Cookie");
	}
}
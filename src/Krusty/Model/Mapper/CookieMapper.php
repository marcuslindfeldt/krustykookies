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
		
		$sql  = 'SELECT * FROM Cookies ';
		$sql .= 'LEFT JOIN Blocked USING (cookie) ';
		$sql .= 'LEFT JOIN (SELECT cookie, count(*) AS in_store FROM Cookies ';
		$sql .= 'NATURAL JOIN ProducedPallets ';
		$sql .= 'WHERE order_id IS NULL ';
		$sql .= 'GROUP BY cookie) B USING (cookie)';
		

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
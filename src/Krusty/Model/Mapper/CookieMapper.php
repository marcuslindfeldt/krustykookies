<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\Cookie,
\Krusty\Model\Mapper\AbstractMapper;

class CookieMapper extends AbstractMapper
{
	//Adds a new order, does not check for foregin key constraint or check the input
	public function save(Cookie $cookie)
	{
		try {
			$db = $this->getAdapter();
			$stmt = $db->prepare('INSERT INTO Cookies VALUES(:cookie, :description)');
			$stmt->execute(array('cookie' => $cookie->cookie, 'description' => $cookie->description));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
	
	//Deletes an order with the specific id
	public function delete($cookie)
	{
		try {
			$db = $this->getAdapter();
			$stmt = $db->prepare('DELETE FROM Cookies WHERE cookie = :cookie');
			$stmt->execute(array('cookie' => $cookie));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	// Should return an cookie object that contains a Cookie object
	public function fetch($cookie = null)
	{
		$db = $this->getAdapter();
		$sql = 'SELECT * FROM Cookies';
		if($cookie === null) {
			return $db->query($sql)->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Cookie");
		}
		$stmt = $db->prepare($sql . ' WHERE cookie = :cookie');
		$stmt->execute(array('cookie' => $cookie));
		return $stmt->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Cookie");

	}
}
<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\Order,
	\Krusty\Model\Mapper\AbstractMapper;

class OrderMapper extends AbstractMapper
{
	public function save($id)
	{
		# code...
	}

	public function delete($id)
	{
		# code...
	}

	// Should return an order object that contains a Customer object
	public function fetch($id = null)
	{
		$db = $this->getAdapter();
		$sql = 'SELECT * FROM Orders';
		if($id === null) {
			return $db->query($sql)->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Order");
		}
		$stmt = $db->prepare($sql . ' WHERE order_id = :id');
		$stmt->execute(['id' => $id]);
		return $stmt->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Order");
	}
}
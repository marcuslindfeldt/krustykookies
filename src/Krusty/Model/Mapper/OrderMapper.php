<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\Order,
\Krusty\Model\Mapper\AbstractMapper;

class OrderMapper extends AbstractMapper
{
	public function save(Order $order)
	{
		$sql  = 'INSERT INTO Orders ';
		$sql .= 'VALUES(:order_id, :customer, :deadline, null)';

		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);

		return $stmt->execute(array(
            'order_id' => $order->order_id,
			'customer' => $order->customer,
			'deadline' => $order->deadline
		));
	}

	public function delete(Order $order)
	{
		$sql = 'DELETE FROM Orders WHERE order_id = :order_id';

		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);

		return $stmt->execute(array(
      		'order_id' => $order->order_id
		));
	}

	public function fetch($id)
	{
		$sql  = 'SELECT * FROM Orders ';
		$sql .= 'WHERE order_id = :order_id';

		$db = $this->getAdapter();

		$stmt = $db->prepare($sql);
		$stmt->execute(array(
		   'order_id' => $id
        ));
		$stmt->setFetchMode(\PDO::FETCH_CLASS, "\Krusty\Model\Order");

		return $stmt->fetch();
	}
	
	public function fetchAll()
	{
		$sql  = 'SELECT * FROM Orders';

		$db = $this->getAdapter();

		$stmt = $db->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Order");
	}

}
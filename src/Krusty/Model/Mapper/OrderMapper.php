<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\Order,
\Krusty\Model\Mapper\AbstractMapper;

class OrderMapper extends AbstractMapper
{
	public function save(Order $order)
	{
		$order_query  = 'INSERT INTO Orders ';
		$order_query .= 'VALUES(NULL, :customer, NOW(), :deadline, null)';
		$pallet_query  = 'INSERT INTO OrderedPallets ';
		$pallet_query .= 'VALUES (:order_id, :cookie, :quantity)';

		$db = $this->getAdapter();

		try{
			$db->beginTransaction();

			$stmt = $db->prepare($order_query);
			$stmt->execute($order->toArray(
               array('customer', 'deadline')));

			$order_id = $db->lastInsertId();

			$stmt = $db->prepare($pallet_query);
			foreach ($order->orderedPallets as $pallet) {

				$stmt->execute(array(
					'order_id' => $order_id,
					'cookie' => $pallet->cookie,
					'quantity' => $pallet->quantity
				));
			}

			return $db->commit();
		}catch(\PDOException $e){
			$db->rollBack();
			throw new \Exception($e->getMessage());
		}
	}

	public function deliver(Order $order)
	{
		$sql  = 'UPDATE Orders ';
		$sql .= 'SET delivered = NOW()';
		$sql .= 'WHERE order_id = :order_id';

		// TODO: 
		// start transaction,
		// check if there are enough pallets in storage
		// assign pallets to order
		
		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);

		return $stmt->execute($order->toArray(array('order_id')));		
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
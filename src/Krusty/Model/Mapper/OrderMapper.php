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
		try{
			$db = $this->getAdapter();

			// start transaction
			$sql= 'start transaction';
			$stmt = $db->prepare($sql);
			$stmt->execute();

			//Get order info
			$sql  = 'SELECT * FROM OrderedPallets ';
			$sql .= 'WHERE order_id = :order_id';

			$stmt = $db->prepare($sql);
			$stmt->execute(array('order_id' => $order->order_id));
			$order->orderedPallets = $stmt->fetchAll(\PDO::FETCH_CLASS, '\Krusty\Model\OrderedPallet');

			//get produced pallets not assigned to an order grouped by cookies  and there count

			$sql = 'SELECT cookie, count(*) FROM ProducedPallets WHERE order_id IS NULL GROUP BY cookie FOR UPDATE';
			$stmt = $db->prepare($sql);
			$stmt->execute();

			//Check resultset to se that there is enough products in storage
			$cookieChecked=0;
			while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
				$db_cookie=$row[0];
				$db_quantity=$row[1];

				foreach($order->orderedPallets as $orderedPallet){
					$o_cookie=$orderedPallet->cookie;
					$o_quantity=$orderedPallet->quantity;
					if($o_cookie==$db_cookie){//this is a cookie that is in the order
						$cookieChecked++;
						if($db_quantity<$o_quantity){
							throw new \Excetion;
						}
					}

				}
			}
			if($cookieChecked!=count($order->orderedPallets)){
				throw new \Excetion;
			}

			//assign pallets to order
			//UPDATE ProducedPallets SET order_id=1 WHERE pallet_id IN (SELECT * FROM ( SELECT pallet_id FROM ProducedPallets WHERE cookie='Tango' ORDER BY pallet_id asc limit 0, 2) as tmp);
			

			foreach($order->orderedPallets as $orderedPallet){
				$o_cookie=$orderedPallet->cookie;
				$o_quantity=$orderedPallet->quantity;
				$sql = 'UPDATE ProducedPallets SET order_id=:order_id WHERE pallet_id IN (SELECT * FROM ( SELECT pallet_id FROM ProducedPallets WHERE cookie=:cookie ORDER BY pallet_id asc limit 0, :limit) as tmp)';
				$stmt = $db->prepare($sql);
				$stmt->execute(array('order_id' => $order->order_id,
					'cookie' => $o_cookie,
					'limit' => $o_quantity));

			}
			// update order status

			$sql  = 'UPDATE Orders ';
			$sql .= 'SET delivered = NOW()';
			$sql .= 'WHERE order_id = :order_id';

			$db = $this->getAdapter();
			$stmt = $db->prepare($sql);
			
			//commit changes
			$sql= 'commit';
			$stmt = $db->prepare($sql);
			$stmt->execute();
			return $stmt->execute($order->toArray(array('order_id')));
		}catch(\Exception $e){//if there is not enough cookies, make rollback
			$sql= 'rollback';
			$stmt = $db->prepare($sql);
			$stmt->execute();
		}		
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
<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\Order,
\Krusty\Model\Mapper\AbstractMapper;

class OrderMapper extends AbstractMapper
{
	public function save(Order $order)
	{
		$order_query  = 'INSERT INTO orders ';
		$order_query .= 'VALUES(NULL, :customer, NOW(), :deadline, null)';
		$pallet_query  = 'INSERT INTO ordered_pallets ';
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
			$db->beginTransaction();

			//Get order info
			$sql  = 'SELECT order_id, o.cookie, quantity, block_id ';
			$sql .= 'FROM ordered_pallets o ';
			$sql .= 'LEFT JOIN blocked b ON(o.cookie = b.cookie AND ';
            $sql .= 'CURDATE() BETWEEN start AND end) ';
			$sql .= 'WHERE order_id = :order_id';


			$stmt = $db->prepare($sql);
			$stmt->execute(array('order_id' => $order->order_id));
			$order->orderedPallets = $stmt->fetchAll(\PDO::FETCH_CLASS, '\Krusty\Model\OrderedPallet');

			//get produced pallets not assigned to an order grouped by cookies  and there count

			$sql = 'SELECT cookie, count(*) FROM produced_pallets WHERE order_id IS NULL GROUP BY cookie FOR UPDATE';
			$stmt = $db->prepare($sql);
			$stmt->execute();

			//Check resultset to se that there is enough products in storage
			$cookieChecked=0;
			while ($row = $stmt->fetch(\PDO::FETCH_NUM)) {

				$db_cookie=$row[0];
				$db_quantity=$row[1];

				foreach($order->orderedPallets as $orderedPallet){
					$o_cookie=$orderedPallet->cookie;
					$o_quantity=$orderedPallet->quantity;
					if($orderedPallet->block_id){
						throw new \Exception('Can\'t deliver blocked products');
					}
					if($o_cookie==$db_cookie){//this is a cookie that is in the order

						$cookieChecked++;
						if($db_quantity<$o_quantity){
							throw new \Exception('Not enough pallets in-storage');
						}
					}

				}
			}
			if($cookieChecked!=count($order->orderedPallets)){
				throw new \Exception('Not enough pallets in-storage');
			}

			//assign pallets to order
			//UPDATE ProducedPallets SET order_id=1 WHERE pallet_id IN (SELECT * FROM ( SELECT pallet_id FROM ProducedPallets WHERE cookie='Tango' ORDER BY pallet_id asc limit 0, 2) as tmp);
			

			foreach($order->orderedPallets as $orderedPallet){
				$o_cookie=$orderedPallet->cookie;
				$o_quantity=$orderedPallet->quantity;
				$sql = 'UPDATE produced_pallets SET order_id=:order_id WHERE pallet_id IN (SELECT * FROM ( SELECT pallet_id FROM produced_pallets WHERE cookie=:cookie ORDER BY pallet_id asc limit 0, :limit) as tmp)';
				$stmt = $db->prepare($sql);
				$stmt->execute(array('order_id' => $order->order_id,
					'cookie' => $o_cookie,
					'limit' => $o_quantity));

			}
			// update order status

			$sql  = 'UPDATE orders ';
			$sql .= 'SET delivered = NOW()';
			$sql .= 'WHERE order_id = :order_id';

			$stmt = $db->prepare($sql);
			
			$result=$stmt->execute($order->toArray(array('order_id')));

			//commit changes
			$db->commit();
			return $result;
		}catch(\Exception $e){//if there is not enough cookies, make rollback
			$db->rollBack();
			throw new \Exception($e->getMessage());
		}		
	}

	public function delete(Order $order)
	{
		$sql = 'DELETE FROM orders WHERE order_id = :order_id';

		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);

		return $stmt->execute(array(
      		'order_id' => $order->order_id
		));
	}

	public function fetch($id)
	{
		$sql  = 'SELECT * FROM orders ';
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
		$sql  = 'SELECT * FROM orders';

		$db = $this->getAdapter();

		$stmt = $db->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Order");
	}

}

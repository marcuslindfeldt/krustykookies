<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\ProducedPallet,
\Krusty\Model\Order,
\Krusty\Model\Mapper\AbstractMapper;

class PalletMapper extends AbstractMapper
{
	protected $start;
	protected $end;

	public function fetchPalletsForOrder(Order $order)
	{
		$sql  = 'SELECT * FROM ordered_pallets ';
		$sql .= 'WHERE order_id = :order_id ';

		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);
		$stmt->execute(array(
		               'order_id' => $order->order_id
		               ));

		return $stmt->fetchAll(\PDO::FETCH_CLASS, '\Krusty\Model\OrderedPallet');
	}

	public function fetch($id)
	{
		$sql  = 'SELECT * FROM produced_pallets ';
		$sql .= 'LEFT JOIN orders USING(order_id) ';
		$sql .= 'WHERE pallet_id = :id';
		
		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);
		$stmt->execute(array(
		               'id' => $id
		               ));

		return $stmt->fetchObject('\Krusty\Model\ProducedPallet');
	}

	public function fetchProducedPallets(array $filters=null)
	{

		$db = $this->getAdapter();
		$sql  = 'SELECT pp.cookie, order_id, pallet_id, produced, ';
		$sql .= 'delivered, block_id, start, end FROM produced_pallets pp ';
		$sql .= 'LEFT JOIN Orders USING(order_id) ';
		$sql .= 'LEFT JOIN Blocked b ON(pp.cookie = b.cookie ';
		                                $sql .= 'AND CURDATE() BETWEEN b.start AND b.end ';
		                                $sql .= 'AND order_id IS NULL)';
	$params = array();
	$criteria = array();

	if(!empty($filters['start'])){
		$params['start'] = $filters['start'];
		array_push($criteria, 'DATE(produced) >= :start');
	}
	if(!empty($filters['end'])){
		$params['end'] = $filters['end'];
		array_push($criteria, 'DATE(produced) <= :end');
	}
	if(!empty($filters['cookie'])){
		$params['cookie'] = $filters['cookie'];
		array_push($criteria, 'pp.cookie = :cookie');
	}
	if(!empty($filters['order_id'])){
		$params['order_id'] = $filters['order_id'];
		array_push($criteria, 'order_id = :order_id');
	}
	if(!empty($filters['status'])){
		switch ($filters['status']) {
			case 'blocked':
			array_push($criteria, 'block_id IS NOT NULL');
			break;
			case 'delivered':
			array_push($criteria, 'order_id IS NOT NULL');
			break;
			case 'in-storage':
			array_push($criteria, 'order_id IS NULL AND block_id IS NULL');
		}
	}
	if(!empty($criteria)){
		$sql .= ' WHERE ' . implode(' AND ', $criteria);
	}
	$sql .= ' ORDER BY produced DESC';
	$stmt = $db->prepare($sql);
	$stmt->execute($params);

	return $stmt->fetchAll(\PDO::FETCH_CLASS, '\Krusty\Model\ProducedPallet');
}

	// simulate production of new pallets
public function createPallets(array $data)
{

	$db = $this->getAdapter();
	try{
			//trans
		$db->beginTransaction();

			//kolla antalet ingridienter som saknas, 0 som returvärde innebär att allt finns
		$sql = "select count(*) from recipes r LEFT JOIN ingredients i USING(ingredient) where cookie=:cookie and i.quantity < r.quantity*:amount FOR UPDATE";
		$stmt = $db->prepare($sql);
		$stmt->execute(array('cookie' => $data['cookies'], 'amount' => $data			['amount']));
		$result = $stmt->fetch(\PDO::FETCH_NUM);
			if($result[0]!=0){//om det inte finns tillräckligt med stuff
				throw new \Exception('Short on ingredients, please refill!');
			}
			//om det finns, uppdatera ingridients
			$sql="update ingredients i LEFT JOIN recipes r USING(ingredient) SET i.quantity=i.quantity-:amount*r.quantity, latest_withdrawal=:amount_dup*r.quantity, modified=NOW() where cookie=:cookie";
			$stmt = $db->prepare($sql);
			$stmt->execute(array(
			               'cookie' => $data['cookies'], 
			               'amount' => $data['amount'],
			               'amount_dup' => $data['amount']
			               ));
			//lägg till pallts

			$query  = "INSERT INTO produced_pallets (cookie, produced)";
			$query .= "VALUES (:cookie, NOW())";
			$stmt = $db->prepare($query);
			for($i = 0; $i < $data['amount']; $i++){
				$stmt->execute(array(
				               'cookie' => $data['cookies']
				               ));
			}
			return $db->commit();
		}catch(\PDOException $e){
			//annars, rollback
			$db->rollBack();
			throw new \Exception($e->getMessage());
		}
	}
}

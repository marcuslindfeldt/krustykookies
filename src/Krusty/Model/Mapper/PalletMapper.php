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
		$sql  = 'SELECT * FROM OrderedPallets ';
		$sql .= 'WHERE order_id = :order_id ';

		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);
		$stmt->execute(array(
			'order_id' => $order->order_id
		));

		return $stmt->fetchAll(\PDO::FETCH_CLASS, '\Krusty\Model\OrderedPallet');
	}

	public function fetchProducedPallets(array $filters=null)
	{

		$db = $this->getAdapter();
		$sql  = 'SELECT pp.cookie, order_id, pallet_id, produced, ';
		$sql .= 'delivered, block_id, start, end FROM ProducedPallets pp ';
		$sql .= 'LEFT JOIN Orders USING(order_id) ';
		$sql .= 'LEFT JOIN Blocked b ON(pp.cookie = b.cookie ';
		$sql .= 'AND DATE(produced) BETWEEN b.start AND b.end ';
		$sql .= 'AND order_id IS NULL)';


		$params = array();
		$criteria = array();

		// var_dump($filters);
		
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
			// var_dump($sql);
			$stmt = $db->prepare($sql);
			$stmt->execute($params);
		// if(isset($options['start'])&&isset($options['end'])){
		// 	$sql.=' where produced>=:start and produced<=:end';
		// 	$stmt = $db->prepare($sql);
		// 	$stmt->execute(array('start' => $options['start'], 'end' => $options['end']));
		// }else if(isset($options['cookie'])){
		// 	$sql.=' where cookie=:cookie';
		// 	$stmt = $db->prepare($sql);
		// 	$stmt->execute(array('cookie' => $options['cookie']));
		// }else if(isset($options['blocked'])){
		// 	$sql.=' where block_id=:blocked';
		// 	$stmt = $db->prepare($sql);
		// 	$stmt->execute(array('blocked' => $options['blocked']));
		// }else{
		// 	$stmt = $db->prepare($sql);
		// 	$stmt->execute();
		// }	
		return $stmt->fetchAll(\PDO::FETCH_CLASS, '\Krusty\Model\ProducedPallet');
	}







	// simulate production of new pallets
	public function createPallets(array $data)
	{
		$query  = "INSERT INTO ProducedPallets (cookie, produced)";
		$query .= "VALUES (:cookie, NOW())";

		$db = $this->getAdapter();
		try{
			$db->beginTransaction();

			$stmt = $db->prepare($query);
			for($i = 0; $i < $data['amount']; $i++){
				$stmt->execute(array(
					'cookie' => $data['cookies']
				));
			}
			return $db->commit();
		}catch(\PDOException $e){
			$db->rollBack();
			throw new \Exception($e->getMessage());
		}
	}

	protected function producedBetween()
	{
		if(isset($this->start) && isset($this->end)){
			return "WHERE produced BETWEEN '{$this->start}' AND '{$this->end}' ";
		}
	}
}